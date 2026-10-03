<?php
/**
 * Form Handler
 * Processes POST submissions from Visit, Connect, and Volunteer forms.
 * Stores data in the form_submissions table and redirects to a Thank You page.
 */
require_once __DIR__ . '/../../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method Not Allowed');
}

// Rate Limiting (60 seconds per IP)
$ip_address = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
$pdo = getDbConnection();

$stmt = $pdo->prepare('SELECT last_submitted_at FROM rate_limits WHERE ip_address = ?');
$stmt->execute([$ip_address]);
$rate_limit = $stmt->fetch();

if ($rate_limit) {
    $last_submitted = strtotime($rate_limit['last_submitted_at']);
    if (time() - $last_submitted < 60) {
        http_response_code(429); // Too Many Requests
        exit('Rate limit exceeded. Please wait 60 seconds before submitting again.');
    }
    // Update timestamp
    $stmt = $pdo->prepare('UPDATE rate_limits SET last_submitted_at = CURRENT_TIMESTAMP WHERE ip_address = ?');
    $stmt->execute([$ip_address]);
} else {
    // Insert new IP
    $stmt = $pdo->prepare('INSERT INTO rate_limits (ip_address) VALUES (?)');
    $stmt->execute([$ip_address]);
}

// Determine form type from the route
global $api_route;
$form_type = trim($api_route, '/');

// Sanitize inputs
$firstName = trim($_POST['firstName'] ?? '');
$lastName  = trim($_POST['lastName'] ?? '');
$email     = trim($_POST['email'] ?? '');
$phone     = trim($_POST['phone'] ?? '');
$message   = trim($_POST['message'] ?? '');

// Collect any extra fields into a JSON blob
$knownFields = ['firstName', 'lastName', 'email', 'phone', 'message'];
$extra = [];
foreach ($_POST as $key => $value) {
    if (!in_array($key, $knownFields)) {
        $extra[$key] = trim($value);
    }
}
$extraJson = !empty($extra) ? json_encode($extra) : null;

// Basic server-side validation
if (empty($firstName) || empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // Redirect back with an error
    global $base_path;
    header('Location: ' . $base_path . '/' . $form_type . '?error=invalid_input');
    exit;
}

// Store in database
$pdo = getDbConnection();
$stmt = $pdo->prepare('INSERT INTO form_submissions (form_type, first_name, last_name, email, phone, message, extra_data) VALUES (?, ?, ?, ?, ?, ?, ?)');
$stmt->execute([$form_type, $firstName, $lastName, $email, $phone, $message, $extraJson]);

// Redirect to thank you page
global $base_path;
header('Location: ' . $base_path . '/thankyou?form=' . urlencode($form_type));
exit;

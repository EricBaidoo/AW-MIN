<?php
require_once __DIR__ . '/../../includes/db.php';
$pdo = getDbConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $stmt = $pdo->prepare('DELETE FROM form_submissions WHERE id = ?');
    $stmt->execute([$_POST['id']]);
}

global $base_path;
header('Location: ' . $base_path . '/admin/submissions');
exit;

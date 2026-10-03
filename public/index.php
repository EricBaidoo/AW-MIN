<?php
// Front Controller for AWM PHP Website

// Start session with secure cookie settings
session_set_cookie_params([
    'httponly' => true,
    'samesite' => 'Lax',
    'secure' => isset($_SERVER['HTTPS']),
]);
session_start();

// Application Configuration and Production Settings
require_once __DIR__ . '/../config.php';
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/../logs/error.log');
error_reporting(E_ALL);
// Get the base path and requested route
$base_path = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$route = $request_uri;
if ($base_path !== '' && strpos($route, $base_path) === 0) {
    $route = substr($route, strlen($base_path));
}
if ($route === '') {
    $route = '/';
}

// Admin Router
if (strpos($route, '/admin') === 0) {
    require_once __DIR__ . '/../views/admin/auth.php';
    
    $admin_route = substr($route, 6);
    if ($admin_route === '' || $admin_route === '/') {
        $admin_page = 'dashboard.php';
        $page_title = 'Admin Dashboard';
    } else {
        $admin_page = ltrim($admin_route, '/') . '.php';
        $admin_page = str_replace('/', '_', $admin_page);
        $page_title = 'Admin - ' . ucfirst(str_replace('_', ' ', str_replace('.php', '', $admin_page)));
    }
    
    $view_path = __DIR__ . '/../views/admin/' . $admin_page;
    if (!file_exists($view_path)) {
        http_response_code(404);
        $view_path = __DIR__ . '/../views/pages/404.php';
        $page_title = 'Page Not Found';
    }

    ob_start();
    if ($admin_page === 'login.php') {
        require_once $view_path;
    } else {
        requireAdmin();
        require_once __DIR__ . '/../views/layouts/admin_layout.php';
    }
    
    $html = ob_get_clean();
    $html = preg_replace('/(href|src)="\/(?!\/)/i', '$1="' . $base_path . '/', $html);
    echo $html;
    exit;
}

// API Router (Form Submissions)
if (strpos($route, '/api/') === 0) {
    $api_route = substr($route, 4);
    require_once __DIR__ . '/../views/api/form_handler.php';
    exit;
}

// Basic Router
switch ($route) {
    case '/':
    case '/index.php':
        $page = 'home.php';
        $page_title = 'Welcome';
        break;
    case '/about':
        $page = 'about.php';
        $page_title = 'About Us';
        break;
    case '/visit':
        $page = 'visit.php';
        $page_title = 'Plan Your Visit';
        break;
    case '/connect':
        $page = 'connect.php';
        $page_title = 'Contact Us';
        break;
    case '/give':
        $page = 'give.php';
        $page_title = 'Supporting the Mission';
        break;
    case '/sermons':
        $page = 'sermons.php';
        $page_title = 'Sermons';
        break;
    case '/stream':
        $page = 'stream.php';
        $page_title = 'Live Stream';
        break;
    case '/leadership':
        $page = 'leadership.php';
        $page_title = 'Leadership';
        break;
    case '/groups':
        $page = 'groups.php';
        $page_title = 'Life Groups';
        break;
    case '/volunteer':
        $page = 'volunteer.php';
        $page_title = 'Volunteer';
        break;
    case '/events':
        $page = 'events.php';
        $page_title = 'Events';
        break;
    case '/ministries':
        $page = 'ministries.php';
        $page_title = 'Ministries';
        break;
    case '/gallery':
        $page = 'gallery.php';
        $page_title = 'Gallery';
        break;
    case '/thankyou':
        $page = 'thankyou.php';
        $page_title = 'Thank You';
        break;
    default:
        http_response_code(404);
        $page = '404.php';
        $page_title = 'Page Not Found';
        break;
}

// Check if page view exists
$view_path = __DIR__ . '/../views/pages/' . $page;
if (!file_exists($view_path)) {
    http_response_code(404);
    $view_path = __DIR__ . '/../views/pages/404.php';
}

// Output buffering to rewrite absolute URLs to include the base path
ob_start();

// Include the main layout wrapper
require_once __DIR__ . '/../views/layouts/main.php';

$html = ob_get_clean();
// Rewrite absolute URLs (href="/..." or src="/...") to include base path, ignoring double slashes
$html = preg_replace('/(href|src)="\/(?!\/)/i', '$1="' . $base_path . '/', $html);

echo $html;

<?php
// Simple hardcoded authentication for the admin panel

// Authentication configuration removed, using database 'admin_users' table instead.

function requireAdmin() {
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        $base_path = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
        header('Location: ' . $base_path . '/admin/login');
        exit;
    }
}

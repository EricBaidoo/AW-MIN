<?php
require_once __DIR__ . '/../../includes/db.php';

$file = $_GET['file'] ?? '';
$backupDir = __DIR__ . '/../../db/backups/';

if (!empty($file)) {
    // Basic security check to ensure they aren't trying to download files outside the directory
    if (strpos($file, '..') !== false || strpos($file, '/') !== false || strpos($file, '\\') !== false) {
        die("Invalid file name.");
    }
    
    $filePath = $backupDir . $file;
    if (file_exists($filePath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($filePath).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);
        exit;
    }
}
die("Backup file not found.");

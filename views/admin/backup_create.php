<?php
require_once __DIR__ . '/../../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dbPath = __DIR__ . '/../../db/database.sqlite';
    $backupDir = __DIR__ . '/../../db/backups/';
    
    if (file_exists($dbPath)) {
        $timestamp = date('Y-m-d_H-i-s');
        $backupName = 'database_backup_' . $timestamp . '.sqlite';
        $backupPath = $backupDir . $backupName;
        
        if (copy($dbPath, $backupPath)) {
            $success = true;
        }
    }
}

global $base_path;
header('Location: ' . $base_path . '/admin/backup');
exit;

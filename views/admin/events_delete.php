<?php
require_once __DIR__ . '/../../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $pdo = getDbConnection();
    $stmt = $pdo->prepare('DELETE FROM events WHERE id = ?');
    $stmt->execute([$_POST['id']]);
}

global $base_path;
header('Location: ' . $base_path . '/admin/events');
exit;

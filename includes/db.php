<?php
/**
 * Database Helper
 * Handles secure PDO connection to SQLite database.
 */

require_once __DIR__ . '/../config.php';

function getDbConnection() {
    try {
        $pdo = new PDO('sqlite:' . DB_PATH);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Set fetch mode to associative arrays by default
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    } catch (PDOException $e) {
        die("Database Connection Error: " . $e->getMessage());
    }
}

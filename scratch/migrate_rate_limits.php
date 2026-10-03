<?php
$db = new PDO('sqlite:c:/xampp/htdocs/awm-php/db/database.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$db->exec("
CREATE TABLE IF NOT EXISTS rate_limits (
    ip_address TEXT PRIMARY KEY,
    last_submitted_at DATETIME DEFAULT CURRENT_TIMESTAMP
)
");

echo "rate_limits table created successfully.\n";

<?php
$pdo = new PDO('sqlite:db/database.sqlite');
$stmt = $pdo->query("SELECT sql FROM sqlite_master WHERE type='table'");
$tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach($tables as $t) {
    echo $t['sql'] . "\n\n";
}

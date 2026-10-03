<?php
$pdo = new PDO('sqlite:db/database.sqlite');
$stmt = $pdo->query("SELECT sql FROM sqlite_master WHERE type='table'");
$tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
$out = '';
foreach($tables as $t) {
    $out .= $t['sql'] . "\n\n";
}
file_put_contents('schema.txt', $out);

<?php
$zip = new ZipArchive();
$filename = 'awm-php_' . date('Ymd_His') . '.zip';
if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
    exit("Cannot open <$filename>\n");
}
$dir = new RecursiveDirectoryIterator('.');
$iterator = new RecursiveIteratorIterator($dir);
foreach ($iterator as $file) {
    $path = $file->getPathname();
    if (strpos($path, '.git') !== false || strpos($path, 'node_modules') !== false || strpos($path, '.zip') !== false) continue;
    if ($file->isDir()) continue;
    $relativePath = str_replace('\\', '/', ltrim(str_replace('.\\', '', $path), '\\/'));
    $zip->addFile($path, $relativePath);
}
$zip->close();
echo "Created: " . realpath($filename);

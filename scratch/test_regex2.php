<?php
$script = '/awm-php/public/index.php';
// dirname behavior on windows
$base_path = rtrim(dirname($script), '/\\');
echo "Base path from dirname: " . $base_path . "\n";
// Let's force backslash
$base_path = '\\awm-php\\public';
$html = '<link href="/css/style.css">';
$html = preg_replace('/(href|src)="\/(?!\/)/i', '$1="' . str_replace('\\', '/', $base_path) . '/', $html);
echo $html;

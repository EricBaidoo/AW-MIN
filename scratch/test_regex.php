<?php
$html = '<link href="/css/style.css?v=2.0" rel="stylesheet"><img src="/images/brand/logo.png">';
$base_path = '/awm-php/public';
$html = preg_replace('/(href|src)="\/(?!\/)/i', '$1="' . $base_path . '/', $html);
echo $html;

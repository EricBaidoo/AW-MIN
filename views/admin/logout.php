<?php
session_destroy();
global $base_path;
header('Location: ' . $base_path . '/');
exit;

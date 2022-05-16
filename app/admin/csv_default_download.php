<?php
require_once __DIR__ . '/../../libs/function.php';

if (is_login()) {
    $file_path = '../../csv/admin_inport_default.csv';
    $file_name = 'admin_inport_default.csv';
    $media_type = (new finfo())->file($file_path, FILEINFO_MIME) ?? 'application/octet-stream';
    header('content-Type: ' . $media_type);
    header('X-Content-Type-Options: nosniff');
    header('Content-Length: ' . filesize($file_path));
    header('Content-Disposition: attachment; filename=' . $file_name);
    readfile($file_path);
    exit();
}
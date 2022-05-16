<?php

use Libs\adminDAO;

require_once __DIR__ . '/../../libs/function.php';
require __DIR__ . '/../../vendor/autoload.php';

try {
    $pdo = new_PDO();
    $admin_dao = new adminDAO($pdo);
    $admins = $admin_dao->getAllAdmins();
} catch (PDOException $e) {
    set_message("PDOException: " . $e->getMessage());
    header("Location: index.php");
    exit();
}

$file_path = __DIR__ . '/../../csv/admins.csv';
$file_name = 'admins.csv';
$export_csv_title = ["管理ID", "氏名", "メールアドレス", "年齢", "電話番号", "部署"];

foreach ($export_csv_title as $key => $value) {
    $export_header[] = $value;
}

if(touch($file_path)) {
    $file = new SplFileObject($file_path, "w");
    $file->fputcsv($export_header);
    foreach ($admins as $admin) {
        $file->fputcsv($admin);
    }
    $pdo = null;
}

if (!is_readable($file_path)) {
    die('file read error.');
}

$media_type = (new finfo())->file($file_path, FILEINFO_MIME) ?? 'application/octet-stream';
header('content-Type: ' . $media_type);
header('X-Content-Type-Options: nosniff');
header('Content-Length: ' . filesize($file_path));
header('Content-Disposition: attachment; filename=' . $file_name);
readfile($file_path);
unlink($file_path);

exit;
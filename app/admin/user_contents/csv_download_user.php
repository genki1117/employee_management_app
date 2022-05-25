<pre>
<?php
require_once __DIR__ . '/../../../libs/function.php';
require __DIR__ . '/../../../vendor/autoload.php';

use Libs\UserDAO;

if (is_login()) {

    $pdo = new_PDO();
    $user_dao = new UserDAO($pdo);
    $users = $user_dao->UserSelectAll();
    //var_dump($users);

    $file_path = '../../../csv/user.csv';
    $file_name = 'user.csv';
    $export_csv_header = ["管理ID", "氏名", "メールアドレス", "年齢", "電話番号", "部署"];

    foreach ($export_csv_header as $key => $value) {
        // $export_header = mb_convert_encoding($value, 'SJIS-win', 'UTF-8');
        $export_header[] = $value;
    }

    if (touch($file_path)) {
        $file = new SplFileObject($file_path, "w");
        $file->fputcsv($export_header);
        foreach ($users as $user) {
            $file->fputcsv($user);
        }
        $pdo = null;
    }

    $media_type = (new finfo())->file($file_path, FILEINFO_MIME) ?? 'application/octet-stream';
    header('content-Type: ' . $media_type);
    header('X-Content-Type-Options: nosniff');
    header('Content-Length: ' . filesize($file_path));
    header('Content-Disposition: attachment; filename=' . $file_name);
    readfile($file_path);
    unlink($file_path);

    exit;

} else {
    header("Location: ../login.php");
    exit();
}
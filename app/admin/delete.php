<?php
require_once __DIR__ . '/../../libs/function.php';
require __DIR__ . '/../../vendor/autoload.php';

use Libs\adminDAO;
use Libs\Validation;

if (is_login()) {
    // $csrf_token = (string)filter_input(INPUT_POST, "csrf_token");
    // if ($csrf_token === '') {
    //     set_message("Validate: csrf_token is required.");
    //     header("Location: index.php");
    //     exit();
    // }
    // if (verify_csrf_token($csrf_token) === false) {
    //     set_message("Validate: csrf_token is Invalid.");
    //     header("Location: index.php");
    //     exit();
    // }

    $id = (string)filter_input(INPUT_POST, "id");
    if ($id === '') {
        set_message("Validate: id is required.");
        header("Location: index.php");
        exit();
    }
    if (filter_var($id, FILTER_VALIDATE_INT) === false) {
        set_message("Validate: id is Invalid.");
        header("Location: index.php");
        exit();
    }

    $pdo = new_PDO();
    $admin_dao = new adminDAO($pdo);
    $admin = $admin_dao ->selectByAdminId($id);

    $file_path = '../../img/';
    $file_name = $admin['file_name'];
    deleteFile($file_path, $file_name);

    $admin_dao->adminDelete($id);
    set_message("管理者を削除しました。");
    header("Location: index.php");

}


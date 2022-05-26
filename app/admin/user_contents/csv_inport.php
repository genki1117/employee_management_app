<?php
require_once __DIR__ . '/../../../libs/function.php';
require __DIR__ . '/../../../vendor/autoload.php';

use Libs\TestValidation;
use Libs\UserDAO;

if (is_login()) {
    $erros = [];
    $validation = new TestValidation();

    $csrf_token = (string)filter_input(INPUT_POST, 'csrf_token');
    $errors['csrf_token'] = $validation->csrfTokenValidate($csrf_token);
    if (isset($errors['csrf_token'])) {
        header("Location: register.php");
        exit();
    }

    if (!is_uploaded_file($_FILES['inport_csv']['tmp_name'])) {
        set_message('csvファイルが選択されていません。');
        header("Location: register.php");
        exit();
    }

    $file_name = $_FILES['inport_csv']['name'];
    $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
    $file_path = '../../../csv/';

    if ($file_extension != 'csv') {
        set_message('拡張子がcsvではありません。');
        header("Location: register.php");
        exit();
    }

    if (!move_uploaded_file($_FILES['inport_csv']['tmp_name'], $file_path . $file_name)) {
        set_message('csvファイルが正常にアップロードされませんでした。');
        header("Location: register.php");
        exit();
    }

    $uploaded_csv_file = $file_path . $file_name;

    $file = new SplFileObject($uploaded_csv_file);
    $file->setFlags(SplFileObject::READ_CSV | SplFileObject::READ_AHEAD | SplFileObject::SKIP_EMPTY | SplFileObject::DROP_NEW_LINE);

    $pdo = new_PDO();
    $user_dao = new UserDAO($pdo);
    $user_dao->userCsvInport($file);

    deleteFile($file_path, $file_name);

} else {
    header("location: register.php");
    exit();
}



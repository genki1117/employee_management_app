<?php
require __DIR__ . '/../../libs/function.php';
require __DIR__ . '/../../vendor/autoload.php';

use Libs\adminDAO;

if (is_login()) {
    $csrf_token = (string)filter_input(INPUT_POST, "csrf_token");
    if (verify_csrf_token($csrf_token) === false) {
        error_log("Validate: Invalid csrf token.");
        $_SESSION[SESSION_MESSAGE] = "Validate: Invalid csrf token.";
        header("Location: error.php");
        exit();
    }

    $id = (string)filter_input(INPUT_POST, "id");
    if ($id === '') {
        error_log("Validate: required is id.");
        set_message("Validate: required is id.");
        header("Location: index.php");
        exit();
    }

    $name = (string)filter_input(INPUT_POST, "name");
    if ($name === '') {
        error_log("Validate: required is name.");
        set_message("Validate: required is name.");
        header("Location: index.php");
        exit();
    }


    $email = (string)filter_input(INPUT_POST, "email");
    if ($email === '') {
        error_log("Validate: required is email.");
        set_message("Validate: required is email.");
        header("Location: index.php");
        exit();
    }
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        error_log("Validate: Invalid is email.");
        set_message("Validate: Invalid is email.");
        header("Location: index.php");
        exit();
    }


    $age = (string)filter_input(INPUT_POST, "age");
    if ($age === '') {
        error_log("Validate: required is age.");
        set_message("Validate: required is age.");
        header("Location: index.php");
        exit();
    }
    if (filter_var($age, FILTER_VALIDATE_INT) === false) {
        error_log("Validate: Invalid is age.");
        set_message("Validate: Invalid is age.");
        header("Location: index.php");
        exit();
    }


    $tell_number = (string)filter_input(INPUT_POST, "tell_number");
    $pattern = '/^0[789]0\d{8}$/u';
    if ($tell_number === '') {
        error_log("Validate: required is tellnumber.");
        set_message("Validate: required is tellnumber.");
        header("Location: index.php");
        exit();
    }
    if (preg_match($pattern, $tell_number) === 0) {
        error_log("Validate: Invalid tellnumber.");
        set_message("Validate: Invalid tellnumber.");
        header("Location: index.php");
        exit();
    }


    $department_id = (string)filter_input(INPUT_POST, "department_id");
    $department_name = (string)filter_input(INPUT_POST, "department_name");
    if ($department_id === '') {
        error_log("Validate: required is department_id.");
        set_message("Validate: required is department_id.");
        header("Location: index.php");
        exit();
    }
    if (filter_var($department_id, FILTER_VALIDATE_INT) === false) {
        error_log("Validate: Invalid is department_id.");
        set_message("Validate: Invalid is department_id.");
        header("Location: index.php");
        exit();
    }

    $password = (string)filter_input(INPUT_POST, "password");
    if ($password === '') {
        error_log("Validate: required is password.");
        set_message("Validate: required is password.");
        header("Location: index.php");
        exit();
    }
    //要変更
    if (mb_strlen($password) < 3) {
        //3文字未満
        error_log("Validate: password is 3str.");
        set_message("Validate: password is 3str.");
        header("Location: index.php");
        exit();
    }

    //画像アップロード処理
    //ファイルがアップロードされていたら
    if (is_uploaded_file($_FILES['image_file']['tmp_name'])) {
        //拡張子判定
        //拡張子取得
        $extension = pathinfo($_FILES['image_file']['name'], PATHINFO_EXTENSION);
        if ($extension != 'jpeg' && $extension != 'jpg' && $extension != 'png') {
            set_message("Validate: Invalid is extension.");
            header("Location: index.php");
            exit();
        }
        //path指定
        $file_path = "../../img/";
        //ファイル名を一意のファイル名に変換
        $image_file_name = uniqid() . '_' . $_FILES['image_file']['name'];
        /**
         * move_uploa_fileで第一引数に移動するパス、第二引数に移動後のパス
         */
        move_uploaded_file($_FILES['image_file']['tmp_name'], $file_path . $image_file_name);
    }
    $csrf_toke_regenerate = generate_csrf_token();

    try {
        $pdo = new_PDO();
        $admin_dao = new adminDAO($pdo);
        $admin = $admin_dao->selectByAdminId($id);
        $filename = $admin['file_name'];
        $filepath = '../../img/';
        unlink($filepath . $filename);

    } catch (PDOException $e) {
        error_log("Validate: error.php");
        set_message("Validate: error.php");
        header("Location: index.php");
        exit();
    }
    require __DIR__ . '/../../views/admin/update_confirm_view.php';

}


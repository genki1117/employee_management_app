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

    $name = (string)filter_input(INPUT_POST, "name");
    if ($name === '') {
        error_log("Validate: required is name.");
        set_message("Validate: required is name.");
        header("Location: register.php");
        exit();
    }


    $email = (string)filter_input(INPUT_POST, "email");
    if ($email === '') {
        error_log("Validate: required is email.");
        set_message("Validate: required is email.");
        header("Location: register.php");
        exit();
    }
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        error_log("Validate: Invalid is email.");
        set_message("Validate: Invalid is email.");
        header("Location: register.php");
        exit();
    }


    $age = (string)filter_input(INPUT_POST, "age");
    if ($age === '') {
        error_log("Validate: required is age.");
        set_message("Validate: required is age.");
        header("Location: register.php");
        exit();
    }
    if (filter_var($age, FILTER_VALIDATE_INT) === false) {
        error_log("Validate: Invalid is age.");
        set_message("Validate: Invalid is age.");
        header("Location: register.php");
        exit();
    }


    $tell_number = (string)filter_input(INPUT_POST, "tell_number");
    $pattern = '/^0[789]0\d{8}$/u';
    if ($tell_number === '') {
        error_log("Validate: required is tellnumber.");
        set_message("Validate: required is tellnumber.");
        header("Location: register.php");
        exit();
    }
    if (preg_match($pattern, $tell_number) === 0) {
        error_log("Validate: Invalid tellnumber.");
        set_message("Validate: Invalid tellnumber.");
        header("Location: register.php");
        exit();
    }


    $department_id = (string)filter_input(INPUT_POST, "department_id");
    if ($department_id === '') {
        error_log("Validate: required is department_id.");
        set_message("Validate: required is department_id.");
        header("Location: register.php");
        exit();
    }
    if (filter_var($department_id, FILTER_VALIDATE_INT) === false) {
        error_log("Validate: Invalid is department_id.");
        set_message("Validate: Invalid is department_id.");
        header("Location: register.php");
        exit();
    }


    $file_name = filter_input(INPUT_POST, "image_file");
    if ($file_name === '') {
        error_log("Validate: required is file_name.");
        set_message("Validate: required is file_name.");
        header("Location: register.php");
        exit();
    }


    $password = (string)filter_input(INPUT_POST, "password");
    if ($password === '') {
        error_log("Validate: required is password.");
        set_message("Validate: required is password.");
        header("Location: register.php");
        exit();
    }
    //要変更
    if (mb_strlen($password) < 3) {
        //3文字未満
        error_log("Validate: password is 3str.");
        set_message("Validate: password is 3str.");
        header("Location: register.php");
        exit();
    }
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $created_at = date('Y-m-d');



    try {
        $pdo = new_PDO();
        $admin_dao = new adminDAO($pdo);
        $admin_dao->createAdmin($name, $email, $age, $tell_number, $department_id, $hashed_password, $created_at, $file_name);
        header("Location: index.php");
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            set_message("入力されたメールアドレスは登録済みです。");
            header("Location: register.php");
            exit();
        }
    }
}



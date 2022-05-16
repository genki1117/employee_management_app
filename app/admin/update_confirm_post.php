<?php
require_once __DIR__ . '/../../libs/function.php';
require __DIR__ . '/../../vendor/autoload.php';

use Libs\adminDAO;

if (is_login()) {
    $filepath = '../../img/';
    $image_file_name = (string)filter_input(INPUT_POST, "image_file_name");

    $csrf_token = (string)filter_input(INPUT_POST, "csrf_token");
    if (verify_csrf_token($csrf_token) === false) {
        error_log("Validate: Invalid csrf token.");
        set_message("Validate: Invalid csrf token.");
        header("Location: error.php");
        exit();
    }

    $id = (string)filter_input(INPUT_POST, "id");
    if ($id === '') {
        error_log("Validate: required is id.");
        set_message("Validate: required is id.");
        deleteFile($filepath, $image_file_name);
        header("Location: index.php");
        exit();
    }
    if (filter_var($id, FILTER_VALIDATE_INT) === false) {
        error_log("Validate: Invalid is id.");
        set_message("Validate: Invalid is id.");
        deleteFile($filepath, $image_file_name);
        deleteFile($filepath, $image_file_name);
        header("Location: index.php");
        exit();
    }

    $name = (string)filter_input(INPUT_POST, "name");
    if ($name === '') {
        error_log("Validate: required is name.");
        set_message("Validate: required is name.");
        deleteFile($filepath, $image_file_name);
        header("Location: index.php");
        exit();
    }

    $email = (string)filter_input(INPUT_POST, "email");
    if ($email === '') {
        error_log("Validate: required is email.");
        set_message("Validate: required is email.");
        deleteFile($filepath, $image_file_name);
        header("Location: index.php");
        exit();
    }
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        error_log("Validate: Invalid is email.");
        set_message("Validate: Invalid is email.");
        deleteFile($filepath, $image_file_name);
        header("Location: index.php");
        exit();
    }

    $age = (string)filter_input(INPUT_POST, "age");
    if ($age === '') {
        error_log("Validate: required is age.");
        set_message("Validate: required is age.");
        deleteFile($filepath, $image_file_name);
        header("Location: index.php");
        exit();
    }
    if (filter_var($age, FILTER_VALIDATE_INT) === false) {
        error_log("Validate: Invalid is age.");
        set_message("Validate: Invalid is age.");
        deleteFile($filepath, $image_file_name);
        header("Location: index.php");
        exit();
    }
    $tell_number = (string)filter_input(INPUT_POST, "tell_number");
    $pattern = '/^0[789]0\d{8}$/u';
    if ($tell_number === '') {
        error_log("Validate: required is tell_number.");
        set_message("Validate: required is tell_number.");
        deleteFile($filepath, $image_file_name);
        header("Location: index.php");
        exit();
    }
    if (preg_match($pattern, $tell_number) === 0) {
        error_log("Validate: Invalid is tell_number");
        set_message("Validate: Invalid is tell_number");
        deleteFile($filepath, $image_file_name);
        header("Location: index.php");
        exit();
    }

    $department_id = (string)filter_input(INPUT_POST, "department_id");
    if ($department_id === '') {
        error_log("Validate: required is department_id.");
        set_message("Validate: required is department_id.");
        deleteFile($filepath, $image_file_name);
        header("Location: index.php");
        exit();
    }
    if (filter_var($department_id, FILTER_VALIDATE_INT) === false) {
        error_log("Validate: Invalid is department_id.");
        set_message("Validate: Invalid is department_id.");
        deleteFile($filepath, $image_file_name);
        header("Location: index.php");
        exit();
    }

    $password = (string)filter_input(INPUT_POST, "password");
    if ($password === '') {
        error_log("Validate: required is password.");
        set_message("Validate: required is password.");
        deleteFile($filepath, $image_file_name);
        header("Location: index.php");
        exit();
    }
    if ($password < 3) {
        error_log("Validate: password is min.");
        set_message("Validate: password is min.");
        deleteFile($filepath, $image_file_name);
        header("Location: index.php");
    }
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        $pdo = new_PDO();
        $admin_dao = new adminDAO($pdo);
        $admin_dao->adminUpdate($id, $name, $email, $hashed_password, $age, $tell_number, $department_id, $image_file_name);
        log_out();
        set_message("Update is success");
        header("Location: login.php");
    }catch (PDOException $e) {
        set_message($e->getMessage());
        deleteFile($filepath, $image_file_name);
        header("Location: error.php");
    }

}
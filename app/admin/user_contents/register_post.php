<?php

use Libs\TestValidation;
use Libs\UserDAO;

require_once __DIR__ . '/../../../libs/function.php';
require __DIR__ . '/../../../vendor/autoload.php';

if (is_login()) {
    $errors = [];
    $validation = new TestValidation();


    $csrf_token = (string)filter_input(INPUT_POST, 'csrf_token');
    $errors['csrf_token'] = $validation->csrfTokenValidate($csrf_token);
    if (isset($errors['csrf_token'])) {
        header("Location: register.php");
        exit;
    }

    $name = (string)filter_input(INPUT_POST, 'name');
    $errors['name'] = $validation->nameValidate($name);
    if (isset($errors['name'])) {
        header("Location: register.php");
        exit;
    }

    $email = (string)filter_input(INPUT_POST, 'email');
    $errors['email'] = $validation->emailValidate($email);
    if (isset($errors['email'])) {
        header("Location: register.php");
        exit;
    }

    $age = (string)filter_input(INPUT_POST, 'age');
    $errors['age'] = $validation->ageValidate($age);
    if (isset($errors['age'])) {
        header("Location: register.php");
        exit;
    }

    $tell_number = (string)filter_input(INPUT_POST, 'tell_number');
    $errors['tell_number'] = $validation->tellNumberValidate($tell_number);
    if (isset($errors['tell_number'])) {
        header("Location: register.php");
        exit;
    }

    $department_id = (string)filter_input(INPUT_POST, 'department_id');
    $errors['department_id'] = $validation->departmentIdValidate($department_id);
    if (isset($errors['department_id'])) {
        header("Location: register.php");
        exit;
    }

    $file_name = (string)filter_input(INPUT_POST, 'image_file');

    $password = (string)filter_input(INPUT_POST, 'password');
    $errors['password'] = $validation->passwordValidate($password);
    if (isset($errors['password'])) {
        header("Location: register.php");
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $created_at = date('Y-m-d');

    try {
        $pdo = new_PDO();
        $user_dao = new UserDAO($pdo);
        $user_dao->insertUser($name, $email, $hashed_password, $age, $tell_number, $department_id, $created_at, $file_name);
        set_message("ユーザー登録完了");
        header("Location: index.php");
        exit();

    } catch (PDOException $e) {
        get_message("PDOException: " . $e->getMessage());
        header("Location: register.php");
        exit();
    }
} else {
    header("Location: login.php");
}
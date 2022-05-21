<?php
require __DIR__ . '/../../libs/function.php';
require __DIR__ . '/../../vendor/autoload.php';

use Libs\departmentDAO;
use Libs\TestValidation;

if (is_login()) {
    $errors = [];
    $validation = new TestValidation();

    $errors['csrf_token'] = $validation->csrfTokenValidate($_POST['csrf_token']);
    if (isset($errors['csrf_token'])) {
        set_message($errors['csrf_token']);
        header("Location: register.php");
        exit();
    }

    $errors['name'] = $validation->nameValidate($_POST['name']);
    if (isset($errors['name'])) {
        set_message($errors['name']);
        header("Location: register.php");
        exit();
    }

    $errors['email'] = $validation->emailValidate($_POST['email']);
    if (isset($errors['email'])) {
        set_message($errors['email']);
        header("Location: register.php");
        exit();
    }

    $errors['age'] = $validation->ageValidate($_POST['age']);
    if (isset($errors['age'])) {
        set_message($errors['age']);
        header("Location: register.php");
        exit();
    }

    $errors['tell_number'] = $validation->tellNumberValidate($_POST['tell_number']);
    if (isset($errors['tell_number'])) {
        set_message($errors['tell_number']);
        header("Location: register.php");
        exit();
    }

    $file_path = '../../img/';
    $file_name = '_' . $_FILES['image_file']['name'];
    $errors['image_file'] = $validation->fileUpload($_FILES, $file_path);

    $errors['password'] = $validation->passwordValidate($_POST['password']);
    if (isset($errors['password'])) {
        set_message($errors['password']);
        header("Location: register.php");
        exit();
    }


    $file_path = '../../img/';
    $file_name = '_' . $_FILES['image_file']['name'];

    if (!count(array_filter($errors)) == 0) {
        deleteFile($file_path, $file_name);
        header("Location: register.php");
        exit();
    }

    $csrf_token_regenerate = generate_csrf_token();

    $pdo = new_PDO();
    $department_dao = new departmentDAO($pdo);
    $department_id = filter_input(INPUT_POST, 'department_id');
    $department = $department_dao->selectNameById($department_id);

    require __DIR__ . '/../../views/admin/register_confirm_view.php';
}



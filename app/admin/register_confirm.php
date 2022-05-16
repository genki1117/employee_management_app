<?php
require __DIR__ . '/../../libs/function.php';
require __DIR__ . '/../../vendor/autoload.php';

use Libs\departmentDao;
use Libs\Validation;

if (is_login()) {
    $name = (string)filter_input(INPUT_POST, "name");
    $email = (string)filter_input(INPUT_POST, "email");
    $age = (string)filter_input(INPUT_POST, "age");
    $tell_number = (string)filter_input(INPUT_POST, "tell_number");
    $department_id = (string)filter_input(INPUT_POST, "department_id");
    $password = (string)filter_input(INPUT_POST, "password");

    $errors = [];
    $validation = new Validation();
    $errors['name'] = $validation->nameValidate($name);
    $errors['email'] = $validation->emailValidate($email);
    $errors['age'] = $validation->ageValidate($age);
    $errors['tell_number'] = $validation->tellNumberValidate($tell_number);
    $errors['image_file'] = $validation->fileUpload($_FILES);
    $errors['password'] = $validation->passwordValidate($password);

    $file_path = '../../img/';
    $file_name = '_' . $_FILES['image_file']['name'];

    if (!count(array_filter($errors)) == 0) {
        set_message("Validate: register Failure");
        deleteFile($file_path, $file_name);
        header("Location: index.php");
        exit();
    }

    $csrf_token_regenerate = generate_csrf_token();

    $pdo = new_PDO();
    $department_dao = new departmentDao($pdo);
    $department = $department_dao->selectNameById($department_id);

    require __DIR__ . '/../../views/admin/register_confirm_view.php';
}



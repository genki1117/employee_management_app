<?php
require_once __DIR__ . '/../../../libs/function.php';
require __DIR__ . '/../../../vendor/autoload.php';

use Libs\departmentDao;
use Libs\TestValidation;

if (is_login()) {
    $errors = [];
    $validation = new TestValidation();

    $csrf_token = (string)filter_input(INPUT_POST, 'csrf_token');
    $errors['csrf_token'] = $validation->csrfTokenValidate($csrf_token);
    if (isset($errors['csrf_token'])) {
        header("Location: register.php");
        exit();
    }

    $name = (string)filter_input(INPUT_POST, 'name');
    $errors['name'] = $validation->nameValidate($name);
    if (isset($errors['name'])) {
        header("Location: register.php");
        exit();
    }

    $email = (string)filter_input(INPUT_POST, 'email');
    $errors['email'] = $validation->emailValidate($email);
    if (isset($errors['email'])) {
        header("Location: register.php");
        exit();
    }

    $age = (string)filter_input(INPUT_POST, 'age');
    $errors['email'] = $validation->ageValidate($age);
    if (isset($errors['age'])) {
        header("Location: register.php");
        exit();
    }

    $tell_number = (string)filter_input(INPUT_POST, 'tell_number');
    $errors['tell_number'] = $validation->tellNumberValidate($tell_number);
    if (isset($errors['tell_number'])) {
        header("Location: register.php");
        exit();
    }

    $department_id = (string)filter_input(INPUT_POST, 'department_id');
    $errors['department_id'] = $validation->departmentIdValidate($department_id);
    if (isset($errors['department_id'])) {
        header("Location: register.php");
        exit();
    }

    $password = (string)filter_input(INPUT_POST, 'password');
    $errors['password'] = $validation->passwordValidate($password);
    if (isset($errors['password'])) {
        header("Location: register.php");
        exit();
    }
    if (is_uploaded_file($_FILES['image_file']['tmp_name'])) {
        $file_path = '../../../img/';
        $file_name = $validation->fileUpload($_FILES, $file_path);
    }

    $csrf_token = generate_csrf_token();

    try {
        $pdo = new_PDO();
        $department_dao = new departmentDao($pdo);
        $department = $department_dao->selectNameById($department_id);

        require __DIR__ . '/../../../views/admin/user_contents_views/register_confirm_view.php';

    } catch (PDOException $e) {
        set_message("PDOException: " . $e->getMessage());
        header("Location: register.php");
        exit;
    }
}




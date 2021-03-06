<?php
require_once __DIR__ . '/../../../libs/function.php';
require __DIR__ . '/../../../vendor/autoload.php';

use Libs\departmentDao;
use Libs\TestValidation;
use Libs\UserDAO;

if (is_login()) {
    $errors = [];
    $validation = new TestValidation();

    $id = (string)filter_input(INPUT_POST, 'id');

    $errors['csrf_token'] = $validation->csrfTokenValidate($_POST['csrf_token']);
    if (isset($errors['csrf_token'])) {
        header("Location: update.php?id={$id}");
        exit();
    }

    $errors['name'] = $validation->nameValidate($_POST['name']);
    if (isset($errors['name'])) {
        header("Location: update.php?id={$id}");
        exit();
    }

    $errors['email'] = $validation->emailValidate($_POST['email']);
    if (isset($errors['email'])) {
        header("Location: update.php?id={$id}");
        exit();
    }

    $errors['tell_number'] = $validation->tellNumberValidate($_POST['tell_number']);
    if (isset($errors['tell_number'])) {
        header("Location: update.php?id={$id}");
        exit();
    }

    $errors['department_id'] = $validation->departmentIdValidate($_POST['department_id']);
    if (isset($errors['department_id'])) {
        header("Location: update.php?id={$id}");
        exit();
    }

    $errors['password'] = $validation->passwordValidate($_POST['password']);
    if (isset($errors['password'])) {
        header("Location: update.php?id={$id}");
        exit();
    }

    $file_path = '../../../img/';
    deleteFile($file_path, $_POST['past_image']);
    $validation->fileUpload($_FILES, $file_path);

    $name = (string)filter_input(INPUT_POST, 'name');
    $email = (string)filter_input(INPUT_POST, 'email');
    $age = (string)filter_input(INPUT_POST, 'age');
    $tell_number = (string)filter_input(INPUT_POST, 'tell_number');
    $department_id = (string)filter_input(INPUT_POST, 'department_id');
    $password = (string)filter_input(INPUT_POST, 'password');
    $file_name = '_' . $_FILES['image_file']['name'];

    $csrf_token = generate_csrf_token();

    try {
        $pdo = new_PDO();
        $department_dao = new departmentDao($pdo);
        $departmentNameId = $department_dao->selectNameById($department_id);


        require __DIR__ . '/../../../views/admin/user_contents_views/update_confrim_view.php';
    } catch (PDOException $e) {
        set_message("PDOexception: " . $e->getMessage());
        header("Location: index.php");
    }
} else {
    header("Location: login.php");
}









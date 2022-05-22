<?php
require_once __DIR__ . '/../../../libs/function.php';
require __DIR__ . '/../../../vendor/autoload.php';

use Libs\TestValidation;
use Libs\UserDAO;

var_dump($_POST);

$errors = [];
$validation = new TestValidation();

$id = (string)filter_input(INPUT_POST, 'id');

// $errors['csrf_token'] = $validation->csrfTokenValidate($_POST['csrf_token']);
// if (isset($errors['csrf_token'])) {
//     header("Location: update.php?id={$id}");
//     exit();
// }

$errors['name'] = $validation->nameValidate($_POST['name']);
if (isset($errors['name'])) {
    header("Location: update.php?id={$id}");
    exit();
}

$errors['email'] = $validation->emailValidate($_POST['email']);
if(isset($errors['email'])) {
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

$file_path = '../../../img/';
$validation->fileUpload($_FILES, $file_path);

$errors['password'] = $validation->passwordValidate($_POST['password']);
if (isset($errors['password'])) {
    header("Location: update.php?id={$id}");
    exit();
}

$name = (string)filter_input(INPUT_POST, 'name');
$email = (string)filter_input(INPUT_POST, 'email');
$age = (string)filter_input(INPUT_POST, 'age');
$tell_number = (string)filter_input(INPUT_POST, 'tell_number');
$department_id = (string)filter_input(INPUT_POST, 'department_id');
$file_name = '_' . $_FILES['image_file']['name'];
$password = (string)filter_input(INPUT_POST, 'password');

$hashed_password = password_hash($password, PASSWORD_DEFAULT);


try {
    $pdo = new_PDO();
    $user_dao = new UserDAO($pdo);
    $user_dao->updateUser($id, $name, $email, $hashed_password, $age, $tell_number, $department_id, $file_name);

    require __DIR__ . '/../../../app/admin/user_contents/index.php';

} catch (PDOException $e) {
    set_message("PDOException: " . $e->getMessage());
    exit();
}



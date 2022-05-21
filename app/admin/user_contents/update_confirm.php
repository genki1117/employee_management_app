<pre>
<?php
require_once __DIR__ . '/../../../libs/function.php';
require __DIR__ . '/../../../vendor/autoload.php';

use Libs\TestValidation;

var_dump($_POST);

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

var_dump($errors);
exit;



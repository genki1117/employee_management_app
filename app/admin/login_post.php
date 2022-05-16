<?php

require_once __DIR__ . '/../../libs/function.php';
require __DIR__ . '/../../vendor/autoload.php';

use Libs\adminDAO;


$csrf_token = (string)filter_input(INPUT_POST, 'csrf_token');
if (verify_csrf_token($csrf_token) === false) {
    error_log('Validate: Invalid csrf tokne.');
    $_SESSION[SESSION_MESSAGE] = 'Validate: Invalid csrf tokne.';
    header("Location: login.php");
    exit();
}
echo $csrf_token;

$email = (string)filter_input(INPUT_POST, 'email');
if ($email === '') {
    error_log('Validate: required is email.');
    $_SESSION[SESSION_MESSAGE] = 'Validate: required is email.';
    header("Location: login.php");
    exit();
}
if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    error_log("Validate: email is Invalid.");
    $_SESSION[SESSION_MESSAGE] = "Validate: email is Invalid.";
    header("Location: login.php");
    exit();
}
echo $email;

$password = (string)filter_input(INPUT_POST, 'password');
echo $password;
if ($password === '') {
    error_log("Validate: required is password.");
    $_SESSION[SESSION_MESSAGE] = "Validate: required is password.";
    // header("Location: login.php");
    echo 'v1';
    exit();
}
if (mb_strlen($password) > 20) {
    error_log("Validate: password is 20row.");
    $_SESSION[SESSION_MESSAGE] = "Validate: password is 20row.";
    // header("Location: login.php");
    echo 'v2';
    exit();
}
echo 'password555';

try {
    $pdo = new_PDO();
    $admin_dao = new adminDAO($pdo);
    $admin = $admin_dao->selectByEmail($email);
    var_dump($admin);
    if ($admin === false) {
        error_log("Validate: admin is Invalid.");
        set_message("admin is Invalid.");
        header("Location: login.php");
        exit();
    }
    if (password_verify($password, $admin['hashed_password']) === false) {
        error_log("Validate: password is Disagreement.");
        set_message("Validate: password is Disagreement.");
        header("Location: login.php");
        exit();
    }

    sign_in($admin);

    header("Location: index.php");
} catch (PDOException $e) {
    error_log($e->getMessage());
    header("Location: error.php");
    exit();
}

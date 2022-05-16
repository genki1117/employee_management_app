<?php
require_once __DIR__ . '/../../libs/function.php';
require __DIR__ . '/../../vendor/autoload.php';

use Libs\adminDAO;

if (is_login()) {
    $id = (string)filter_input(INPUT_GET, "admin_id");
    if ($id === '') {
        set_message("Validate: id is required.");
        header("Location: index.php");
        exit();
    }
    if (filter_var($id, FILTER_VALIDATE_INT) === false) {
        set_message("Validate: id is Invalid.");
        header("Location: index.php");
        exit();
    }
    $csrf_token = generate_csrf_token();

    try {
        $pdo = new_PDO();
        $admin_dao = new adminDAO($pdo);
        $admin = $admin_dao->selectByAdminId($id);
        $account_email = get_account_email();
        require __DIR__ . '/../../views/admin/mail_view.php';
    } catch (PDOException $e) {

    }
}
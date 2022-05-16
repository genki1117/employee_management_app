<?php
require_once __DIR__ . '/../../libs/function.php';
require __DIR__ . '/../../vendor/autoload.php';

use Libs\adminDAO;

if (is_login()) {
    $admin_id = filter_input(INPUT_GET, "admin_id");
    if ($admin_id === '') {
        error_log("Validate: required is admin_id");
        header("Location: error.php");
        exit();
    }
    if (filter_var($admin_id, FILTER_VALIDATE_INT) === false) {
        error_log("Validate: error.php");
        header("Location: error.php");
        exit();
    }

    $csrf_token = generate_csrf_token();

    try {
        $pdo = new_PDO();
        $admin_dao = new adminDAO($pdo);
        $admin = $admin_dao->selectByAdminId($admin_id);
        require __DIR__ . '/../../views/admin/detail_view.php';
    } catch (PDOException $e) {
        error_log("PDOException" . $e->getMessage());
        header("Location: error.php");
        exit();
    }
} else {
    header("Location: login.php");
}



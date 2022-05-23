<?php

require_once __DIR__ . '/../../libs/function.php';
require __DIR__ . '/../../vendor/autoload.php';

use Libs\adminDAO;
use Libs\departmentDAO;

$csrf_token = generate_csrf_token();

if (is_login()) {
    $id = (string)filter_input(INPUT_GET, "admin_id");
    if ($id === '') {
        set_message("Validate: required is id.");
        header("Location: error.php");
        exit();
    }
    if (filter_var($id, FILTER_VALIDATE_INT) === false) {
        set_message("Validation: Invalid is id");
        header("Location: error.php");
        exit();
    }

    try {
        $pdo = new_PDO();
        $admin_dao = new adminDAO($pdo);
        $department_dao = new departmentDao($pdo);
        $admin = $admin_dao->selectByAdminId($id);
        $departments = $department_dao->selectAll();
        require __DIR__ . '/../../views/admin/update_view.php';

    } catch(PDOException $e) {
        set_message("PDOException" . $e->getMessage());
        header("Location: error.php");
    }
}

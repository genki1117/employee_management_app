<?php
require_once __DIR__ . '/../../../libs/function.php';
require __DIR__ . '/../../../vendor/autoload.php';

use Libs\UserDAO;
use Libs\departmentDAO;

if (is_login()) {
    $csrf_token = generate_csrf_token();

    try {
        $pdo = new_PDO();
        $department_dao = new departmentDAO($pdo);
        $departments = $department_dao->selectAll();

        require __DIR__ . '/../../../views/admin/user_contents_views/register_view.php';
    } catch (PDOException $e) {
        set_message("PDOException: " . $e->getMessage());
        header("Location: error.php");
        exit();
    }
}

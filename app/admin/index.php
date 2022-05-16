<?php

require_once __DIR__ . '/../../libs/function.php';
require __DIR__ . '/../../vendor/autoload.php';

use Libs\adminDAO;

// if (is_login()) {
    try {
        $pdo = new_PDO();
        $admin_dao = new adminDAO($pdo);
        $admins = $admin_dao->getAllAdmins();
        require __DIR__ . '/../../views/admin/index_view.php';
    } catch (PDOException $e) {
        error_log("Validate: PDOException" . $e->getMessage());
        header("Location: error.php");
    }
// }else {
//     header("Location: login.php");
// }





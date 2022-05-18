<?php
require_once __DIR__ . '/../../../libs/function.php';
require __DIR__ . '/../../../vendor/autoload.php';

use Libs\UserDAO;

if (is_login()) {
    try {
        $pdo = new_PDO();
        $user_dao = new UserDAO($pdo);
        $users = $user_dao->UserSelectAll();
        require __DIR__ . '/../../../views/admin/user_contents_views/index_view.php';

    } catch (PDOException $e) {
        set_message("PDOException: " . $e->getMessage());
        header("Location: error.php");
        exit();
    }
}


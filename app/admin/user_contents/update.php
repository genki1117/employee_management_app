<?php
require_once __DIR__ . '/../../../libs/function.php';
require __DIR__ . '/../../../vendor/autoload.php';

use Libs\departmentDao;
use Libs\UserDAO;

ini_set('display_errors', "On");

if (is_login()) {
    $id = (string)filter_input(INPUT_GET, 'user_id');
    if ($id === '') {
        set_message("idは必須です。");
        header("Location: index.php");
        exit();
    }
    if (filter_var($id, FILTER_VALIDATE_INT) === false) {
        set_message("idが不正です。");
        header("Location: index.php");
        exit();
    }

    try {
        $pdo = new_PDO();
        $user_dao = new UserDAO($pdo);
        $user = $user_dao->UserSelectById($id);

        $department_dao = new departmentDAO($pdo);
        $departments = $department_dao->selectAll();

        $csrf_token = generate_csrf_token();

        require __DIR__ . '/../../../views/admin/user_contents_views/update_view.php';
    } catch (PDOException $e) {
        set_message($e->getMessage());
        header("Location: index.php");
    }
}

<?php
require_once __DIR__ . '/../../../libs/function.php';
require __DIR__. '/../../../vendor/autoload.php';

use Libs\UserDAO;

if (is_login()) {
    $user_id = (string)filter_input(INPUT_GET, 'user_id');
    if ($user_id === '') {
        set_message("IDは必須です。");
        header("Location: index.php");
        exit();
    }
    if (filter_var($user_id, FILTER_VALIDATE_INT) === false) {
        set_message("IDが不正です。");
        header("Location: index.php");
        exit();
    }

    try {

        $pdo = new_PDO();
        $user_dao = new UserDAO($pdo);
        $user = $user_dao->UserSelectById($user_id);

        require __DIR__ . '/../../../views/admin/user_contents_views/datail_view.php';

    } catch (PDOException $e) {
        set_message("PDOException: " . $e->getMessage());
        header("Location: error.php");
        exit();
    }



}
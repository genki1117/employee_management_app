<?php
require __DIR__ . '/../../libs/function.php';
require __DIR__ . '/../../vendor/autoload.php';

use Libs\departmentDAO;


if (is_login()) {
    $csrf_token = generate_csrf_token();

    //プルダウン取得
    $pdo = new_PDO();
    $department_dao = new departmentDAO($pdo);
    $departments = $department_dao->selectAll();


    require __DIR__ . '/../../views/admin/register_view.php';

} else {
    header("Location: login.php");
}




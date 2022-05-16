<?php
require __DIR__ . '/../../libs/function.php';
require __DIR__ . '/../../vendor/autoload.php';

use Libs\departmentDao;

echo 'test1';
if (is_login()) {
    echo 'test2';
    $csrf_token = generate_csrf_token();
    echo 'test3';

    //プルダウン取得
    $pdo = new_PDO();
    echo 'test4';
    $department_dao = new departmentDao($pdo);
    echo 'test5';
    $departments = $department_dao->selectAll();

    echo 'test6';

    require __DIR__ . '/../../views/admin/register_view.php';

} else {
    header("Location: login.php");
}




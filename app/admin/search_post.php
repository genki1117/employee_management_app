<?php
require_once __DIR__ . '/../../libs/function.php';
require __DIR__ . '/../../vendor/autoload.php';

use Libs\searchDAO;

if (is_login()) {
    $word = (string)filter_input(INPUT_POST, "word");
    $pdo = new_PDO();
    $search_dao = new searchDAO($pdo);
    $admins = $search_dao->allSearchByname($word);
    require __DIR__ . '/../../views/admin/index_view.php';
} else {
    header("Location: login.php");
}



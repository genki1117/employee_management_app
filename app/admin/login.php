<?php
require __DIR__ . '/../../libs/function.php';

$csrf_token = generate_csrf_token();

require __DIR__ . '/../../views/admin/login_view.php';

?>


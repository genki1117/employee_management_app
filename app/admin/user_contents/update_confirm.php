<pre>
<?php
require_once __DIR__ . '/../../../libs/function.php';
require __DIR__ . '/../../../vendor/autoload.php';

use Libs\Validation;

var_dump($_POST);

$errors = [];
$validation_class = new Validation();

$errors = $validation_class->csrfTokenValidate($_POST['csrf_token']);



var_dump($errors);


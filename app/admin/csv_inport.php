<pre>
<?php
require_once __DIR__ . '/../../libs/function.php';
require __DIR__ . '/../../vendor/autoload.php';

use Libs\adminDAO;

$csrf_token = filter_input(INPUT_POST, "csrf_token");
if ($csrf_token === '') {
    set_message("Validate: csrf_token is required.");
    header("Location: index.php");
    exit();
}
if (verify_csrf_token($csrf_token) === false) {
    set_message("Validate: Invalid is csrf_token.");
    header("Location: index.php");
    exit();
}
if (!is_uploaded_file($_FILES['inport_csv']['tmp_name'])) {
    set_message("Validate: file is rquired");
    header("Location: index.php");
    exit();
}

$file_name = $_FILES['inport_csv']['name'];
$file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
$file_path = __DIR__ . '/../../csv/';

if ($file_extension != 'csv') {
    set_message("Validate: extension is not csv.");
    header("Location: index.php");
    exit();
}

if (!move_uploaded_file($_FILES['inport_csv']['tmp_name'], $file_path . $file_name)) {
    set_message("Validate: csv_file is not upload.");
    header("Location: index.php");
    exit();
}

$uploaded_csv_file = $file_path . $file_name;

$file = new SplFileObject($uploaded_csv_file);
$file->setFlags(SplFileObject::READ_CSV | SplFileObject::READ_AHEAD | SplFileObject::SKIP_EMPTY | SplFileObject::DROP_NEW_LINE);

$pdo = new_PDO();
$admin_dao = new adminDAO($pdo);
$admin_dao->adminCsvInport($file);




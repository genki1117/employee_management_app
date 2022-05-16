<?php

define("SESSION_ACCOUNT", "SESSION_ACCOUNT");
define("SESSION_MESSAGE", "SESSION_MESSAGE");
define("SESSION_CSRF_TOKEN", "SESSION_CSRF_TOKEN");

session_start();
// var_dump($_SESSION);
// var_dump($_FILES);
// var_dump($_POST);


//エスケープ
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}

//DB接続
function new_PDO()
{
    //ローカル
    // $dsn = "mysql:dbname=employee_management;host=localhost;charset=utf8mb4";
    // $username = "root";
    // $password = "root";

    //heroku
    $dsn = "mysql:dbname=heroku_4d1209dbba343a9;host=us-cdbr-east-05.cleardb.net;charset=utf8mb4";
    $username = "b76c9a73f58cc4";
    $password = "c5ab235ft";

    $options = [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false
    ];
    $pdo = new PDO($dsn, $username, $password, $options);
    return $pdo;
}

//$_SESSION[SESSION_MESSAGE]に$messageを格納
function set_message($message)
{
    $_SESSION[SESSION_MESSAGE] = $message;
}

//$_SESSION[SESSION_MESSAGE]から$messageに取得
function get_message()
{
    if (isset($_SESSION[SESSION_MESSAGE]) === false) {
        return false;
    }
    $message = $_SESSION[SESSION_MESSAGE];
    unset($_SESSION[SESSION_MESSAGE]);
    return $message;
}

//ログインしてたらture
function is_login()
{
    return isset($_SESSION[SESSION_ACCOUNT]);
}

function log_out()
{
    //サインインしてるかどうか判定
    if (is_login() === false) {
        return false;
    }

    $_SESSION = []; //$_SESSION変数を初期化
    //クッキー初期化
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }
    //セッション情報の破棄
    session_destroy();
}

//$_SESSION[SESSION_ACCOUNT]からセッション情報を取得
function get_account()
{
    if (is_login() === false){
        return false;
    }
    $account = $_SESSION[SESSION_ACCOUNT];
    return $account;
}
//$_SESSION[SESSION_ACCOUNT]['name']からセッション情報を取得
function get_account_name()
{
    $account = get_account();
    if ($account === false) {
        return false;
    }
    $account_name = $account['name'];
    return $account_name;
}

//$_SESSION[SESSION_ACCOUNT]['id']からセッション情報を取得
function get_account_id()
{
    $account = get_account();
    if ($account === false) {
        return false;
    }
    $account_id = $account['id'];
    return $account_id;
}

function get_account_email()
{
    $account = get_account();
    if ($account === false) {
        return false;
    }
    $account_email = $account['email'];
    return $account_email;
}

function sign_in($account)
{
    session_regenerate_id();
    $_SESSION[SESSION_ACCOUNT] = $account;
}

//csrftoken生成
function generate_csrf_token()
{
    $bytes = random_bytes(32);
    $csrf_token = bin2hex($bytes);
    $_SESSION[SESSION_CSRF_TOKEN] = $csrf_token;
    return $csrf_token;
}

//csrftoken検証
function verify_csrf_token($token)
{
    if (isset($_SESSION[SESSION_CSRF_TOKEN]) === false) {
        return false;
    }
    $result = $_SESSION[SESSION_CSRF_TOKEN] === $token;
    unset($_SESSION[SESSION_CSRF_TOKEN]);
    return $result;
}

function deleteFile($filepath, $filename = null)
{
    if (file_exists($filepath . $filename)) {
        unlink($filepath . $filename);
    }
}


<?php
require_once __DIR__ . '/../../libs/function.php';
require __DIR__ . '/../../vendor/autoload.php';

if (is_login()) {
    $csrf_token = (string)filter_input(INPUT_POST, "csrf_token");
    if (verify_csrf_token($csrf_token) === false) {
        set_message("Validate: csrf_token is Invalid.");
        header("Location: index.php");
        exit();
    }

    $from = (string)filter_input(INPUT_POST, "from");
    if ($from === '') {
        set_message("Validate: form_email is required.");
        header("Location: index.php");
        exit();
    }
    if (filter_var($from, FILTER_VALIDATE_EMAIL) === false) {
        set_message("validate: form_email is Invalid.");
    }

    $to = (string)filter_input(INPUT_POST, "to");
    if ($to === '') {
        set_message("Validate: to_email is rquired .");
        header("Location: index.php");
        exit();
    }
    if (filter_var($to, FILTER_VALIDATE_EMAIL) === false) {
        set_message("validate: to_email is Invalid.");
    }

    $subject = (string)filter_input(INPUT_POST, "subject");
    if ($subject === '') {
        set_message("Validate: subject is required.");
        header("Location: index.php");
        exit();
    }
    if (strlen($subject) > 30) {
        set_message("Validate: subject is orver count 30");
        header("Location: index.php");
        exit();
    }

    $message = (string)filter_input(INPUT_POST, "message");
    if ($message === '') {
        set_message("Validate: message is required.");
        header("Location: index.php");
        exit();
    }
    if (strlen($message) > 200) {
        set_message("Validate: message is orver count 200");
        header("Location: index.php");
        exit();
    }

    $headers = [];
    $headers = $from;
    $headers .= "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8";

    if (mb_send_mail($to, $subject, $message, $headers)) {
        set_message("send mail is success.");
        header("Location: index.php");
        exit();
    } else {
        set_message("send mail is Failure");
        header("Location: index.php");
        exit();
    }
}
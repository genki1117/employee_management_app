<?php

namespace Libs;

class TestValidation extends fileOperation {

    public function csrfTokenValidate($csrf_token)
    {
        if ($csrf_token === '') {
            $error = 'トークンは必須です。';
            set_message($error);
            return $error;
        }
        if (verify_csrf_token($csrf_token) === false) {
            $error = 'トークンが不正です。';
            set_message($error);
            return $error;
        }
    }

    public function nameValidate($name)
    {
        if ($name === '') {
            $error = '名前が未入力です。';
            set_message($error);
            return $error;
        }
    }

    public function emailValidate($email)
    {
        if ($email === '') {
            $error = 'メールアドレスが未入力です。';
            set_message($error);
            return $error;
        }
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $error = 'メールアドレスが不正です。';
            return $error;
        }
    }

    public function ageValidate($age)
    {
        if ($age === '') {
            $error = '年齢が未入力です。';
            set_message($error);
            return $error;
        }
        if (filter_var($age, FILTER_VALIDATE_INT) === false) {
            $error = '年齢が不正です。';
            set_message($error);
            return $error;
        }
    }

    public function tellNumberValidate($tell_number)
    {
        $pattern = '/^0[789]0\d{8}$/u';
        if ($tell_number === '') {
            $error = '電話番号が未入力です。';
            set_message($error);
            return $error;
        }
        if (preg_match($pattern, $tell_number) === 0) {
            $error = '電話番号が不正です。';
            set_message($error);
            return $error;
        }
    }

    public function departmentIdValidate($department_id)
    {
        if ($department_id === '') {
            $error = '部署が未入力です。';
            set_message($error);
            return $error;
        }
        if (filter_var($department_id, FILTER_VALIDATE_INT) === false) {
            $error = '部署が不正です。';
            set_message($error);
            return $error;
        }
    }

    public function passwordValidate($password)
    {
        if ($password === '') {
            $error = 'パスワードが未入力です。';
            set_message($error);
            return $error;
        }
        //要変更
        if (mb_strlen($password) < 3) {
            //3文字未満
            $error = 'パスワードが不正です。';
            set_message($error);
            return $error;
        }
    }

}
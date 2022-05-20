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
    }

    public function nameValidate($name)
    {
        if ($name === '') {
            $error = 'name brank';
            set_message($error);
            return $error;
        }
    }

    public function emailValidate($email)
    {
        if ($email === '') {
            $error = 'email brank';
            set_message($error);
            return $error;
        }
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $error = 'email invlid';
            return $error;
        }
    }

    public function ageValidate($age)
    {
        if ($age === '') {
            $error = 'age brank';
            set_message($error);
            return $error;
        }
        if (filter_var($age, FILTER_VALIDATE_INT) === false) {
            $error = 'age invalid';
            set_message($error);
            return $error;
        }
    }

    public function tellNumberValidate($tell_number)
    {
        $pattern = '/^0[789]0\d{8}$/u';
        if ($tell_number === '') {
            $error = 'tell_number brank';
            set_message($error);
            return $error;
        }
        if (preg_match($pattern, $tell_number) === 0) {
            $error = 'tell_number invalid';
            set_message($error);
            return $error;
        }
    }

    public function departmentIdValidate($department_id)
    {
        if ($department_id === '') {
            $error = 'department_id brank';
            set_message($error);
            return $error;
        }
        if (filter_var($department_id, FILTER_VALIDATE_INT) === false) {
            $error = 'department_id invalid';
            set_message($error);
            return $error;
        }
    }

    public function passwordValidate($password)
    {
        if ($password === '') {
            $error = 'password brank';
            return $error;
        }
        //要変更
        if (mb_strlen($password) < 3) {
            //3文字未満
            $error = 'password invalid';
            return $error;
        }
    }

}
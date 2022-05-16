<?php

namespace Libs;

class Validation extends fileOperation {

    public function nameValidate($name)
    {
        $name = (string)filter_input(INPUT_POST, "name");
        if ($name === '') {
            $error = 'name brank';
            return $error;
        }
    }

    public function emailValidate($email)
    {
        $email = (string)filter_input(INPUT_POST, "email");
        if ($email === '') {
            $error = 'email brank';
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
            return $error;
        }
        if (filter_var($age, FILTER_VALIDATE_INT) === false) {
            $error = 'age invalid';
            return $error;
        }
    }

    public function tellNumberValidate($tell_number)
    {
        $pattern = '/^0[789]0\d{8}$/u';
        if ($tell_number === '') {
            $error = 'tell_number brank';
            return $error;
        }
        if (preg_match($pattern, $tell_number) === 0) {
            $error = 'tell_number invalid';
            return $error;
        }
    }

    public function departmentIdValidate($department_id)
    {
        if ($department_id === '') {
            $error = 'department_id brank';
            return $error;
        }
        if (filter_var($department_id, FILTER_VALIDATE_INT) === false) {
            $error = 'department_id invalid';
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
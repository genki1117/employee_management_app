<?php

namespace Libs;

use Libs\PDO;

class UserDAO
{
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function UserSelectAll()
    {
        $sql = "select
                    us.id,
                    us.name,
                    us.email,
                    us.age,
                    us.tell_number,
                    de.name department_name
                from
                    users us left join departments de on us.department_id = de.id
                order by id";
        $ps = $this->pdo->prepare($sql);
        $ps->execute();
        $users = $ps->fetchAll();
        return $users;
    }

    public function UserSelectById($id)
    {
        $sql = "select
                    us.id,
                    us.name,
                    us.email,
                    us.age,
                    us.tell_number,
                    us.department_id,
                    us.file_name,
                    de.name department_name
                from
                    users us left join departments de on us.department_id = de.id
                where
                    us.id = :id";
        $ps = $this->pdo->prepare($sql);
        $ps->bindValue(":id", $id);
        $ps->execute();
        $user = $ps->fetch();
        return $user;
    }

    public function updateUser($id, $name, $email, $hashed_password, $age, $tell_number, $department_id, $file_name)
    {
        $sql = "update users set
                    name = :name,
                    email = :email,
                    hashed_password = :hashed_password,
                    age = :age,
                    tell_number = :tell_number,
                    department_id = :department_id,
                    file_name = :file_name
                where
                    id = :id";

        $ps = $this->pdo->prepare($sql);
        $ps->bindValue(":name", $name);
        $ps->bindValue(":email", $email);
        $ps->bindValue(":hashed_password", $hashed_password);
        $ps->bindValue(":age", $age);
        $ps->bindValue(":tell_number", $tell_number);
        $ps->bindValue(":department_id", $department_id);
        $ps->bindValue(":file_name", $file_name);
        $ps->bindValue(':id', $id);
        $ps->execute();
    }

    public function insertUser($name, $email, $hashed_password, $age, $tell_number, $department_id, $created_at, $file_name)
    {
        $sql = "insert into users (name, email, hashed_password, age, tell_number, department_id, created_at, file_name)
                            values (:name, :email, :hashed_password, :age, :tell_number, :department_id, :created_at, :file_name)";
        $ps = $this->pdo->prepare($sql);
        $ps->bindValue(":name", $name);
        $ps->bindValue(":email", $email);
        $ps->bindValue(":hashed_password", $hashed_password);
        $ps->bindValue(":age", $age);
        $ps->bindValue(":tell_number", $tell_number);
        $ps->bindValue(":department_id", $department_id);
        $ps->bindValue(":created_at", $created_at);
        $ps->bindValue(":file_name", $file_name);
        $ps->execute();
    }
}
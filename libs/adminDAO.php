<?php

namespace Libs;

class adminDAO
{
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
    public function createAdmin($name, $email, $age, $tell_number, $department_id, $hashed_password, $created_at, $file_name)
    {
        $sql = "insert into admins (name, email, age, tell_number, department_id, hashed_password, created_at, file_name)
                values (:name, :email, :age, :tell_number, :department_id, :hashed_password, :created_at, :file_name)";
        $ps = $this->pdo->prepare($sql);
        $ps->bindValue(":name", $name);
        $ps->bindValue(":email", $email);
        $ps->bindValue(":age", $age);
        $ps->bindValue(":tell_number", $tell_number);
        $ps->bindValue(":department_id", $department_id);
        $ps->bindValue(":hashed_password", $hashed_password);
        $ps->bindValue(":created_at", $created_at);
        $ps->bindValue(":file_name", $file_name);
        $ps->execute();
    }

    /**
     * 全取得
     */
    public function getAllAdmins()
    {
        $sql = "select
                    ad.id, ad.name, ad.email, ad.age, ad.tell_number, de.name department_name
                from
                    admins ad left join departments de on ad.department_id = de.id
                order by ad.id";
        $st = $this->pdo->query($sql);
        $admins = $st->fetchAll();
        return $admins;
    }

    /**
     * email検索
     */
    public function selectByEmail($email)
    {
        $sql = "select
                    id,
                    name,
                    email,
                    hashed_password
                from
                    admins
                where
                    email = :email";
        $ps = $this->pdo->prepare($sql);
        $ps->bindValue(":email", $email);
        $ps->execute();
        $admin = $ps->fetch();
        return $admin;
    }

    /**
     * adminId検索
     */
    public function selectByAdminId($adminId)
    {
        $sql = "select
                    ad.id,
                    ad.name,
                    ad.email,
                    ad.age,
                    ad.tell_number,
                    ad.file_name,
                    de.name department_name,
                    department_id
                from
                    admins ad left join departments de on ad.department_id = de.id
                where
                    ad.id = :id";
        $ps = $this->pdo->prepare($sql);
        $ps->bindValue(":id", $adminId);
        $ps->execute();
        $admin = $ps->fetch();
        return $admin;
    }

    public function adminUpdate($id, $name, $email, $hashed_password, $age, $tell_number, $department_id, $image_file_name)
    {
        $sql = "update
                    admins
                set
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
        $ps->bindValue(":id", $id);
        $ps->bindValue(":name", $name);
        $ps->bindValue(":email", $email);
        $ps->bindValue(":hashed_password", $hashed_password);
        $ps->bindValue(":age", $age);
        $ps->bindValue(":tell_number", $tell_number);
        $ps->bindValue(":department_id", $department_id);
        $ps->bindValue(":file_name", $image_file_name);
        $ps->execute();
    }

    //csvinport
    public function adminCsvInport($file)
    {
        $sql = "insert into admins (name, email, hashed_password, age, tell_number, department_id, created_at)
                    values (:name, :email, :hashed_password, :age, :tell_number, :department_id, :created_at)";
        $ps = $this->pdo->prepare($sql);

        foreach ($file as $i => $value) {
            if ($i === 0) continue;
            $ps->bindValue(':name', $value[0]);
            $ps->bindValue(':email', $value[1]);
            $ps->bindValue(':hashed_password', password_hash($value[2], PASSWORD_DEFAULT));
            $ps->bindValue(':age', $value[3]);
            $ps->bindValue(':tell_number', $value[4]);
            $ps->bindValue(':department_id', $value[5]);
            $ps->bindValue(':created_at', $value[6]);
            $ps->execute();
        }
        set_message("read compl csv.");
        header("Location: index.php");
        exit();
    }

    public function adminDelete($id)
    {
        $sql = "delete from admins where id = :id";
        $ps = $this->pdo->prepare($sql);
        $ps->bindValue(":id", $id);
        $ps->execute();
    }
}

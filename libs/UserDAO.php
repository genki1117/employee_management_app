<?php

namespace Libs;

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
}
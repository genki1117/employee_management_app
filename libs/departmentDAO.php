<?php

namespace Libs;

class departmentDao
{
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function selectAll()
    {
        $sql = "select * from departments";
        $st = $this->pdo->query($sql);
        $departments = $st->fetchAll();
        return $departments;
    }

    public function selectNameById($department_id)
    {
        $sql = "select * from departments where id = :id";
        $st = $this->pdo->prepare($sql);
        $st->bindValue(":id", $department_id);
        $st->execute();
        $department = $st->fetch();
        return $department;
    }
}
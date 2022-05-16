<?php

namespace Libs;

class searchDAO
{
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function allSearchByname($word)
    {
        $sql = "select
                    ad.id, ad.name, ad.email, ad.age, ad.tell_number, ad.file_name, de.name department_name
                from
                    admins ad left join departments de on ad.department_id = de.id
                where ad.name like :word";
        $ps = $this->pdo->prepare($sql);
        $ps->bindValue(":word", '%' . $word . '%');
        $ps->execute();
        $admins = $ps->fetchAll();
        return $admins;
    }
}

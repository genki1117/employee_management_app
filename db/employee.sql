drop table if exists admins;
create table admins(
    id integer primary key AUTO_INCREMENT,
    name varchar(255) not null,
    email varchar(255) unique not null,
    hashed_password text not null,
    age integer,
    tell_number varchar(255),
    department_id integer(20),
    created_at datetime,
    file_name text
);

insert into admins (name, email, hashed_password, age, tell_number, department_id, created_at)
            values ('user01', 'test01@test.com', '$2y$10$AhrwidiJgIq7/xJL0pA43.D1RdHsJO4.gjnbW3/6Tlo716SKqOxOy', 30, '09055557777', 2, NOW())


create table departments(
    id integer primary key AUTO_INCREMENT,
    name varchar(10) not null
);

insert into departments (id, name) values (1, "営業部");
insert into departments (id, name) values (2, "人事部");
insert into departments (id, name) values (3, "経理部");






select
    ad.id, ad.name, ad.email, ad.age, ad.tell_number, de.name department_name
from
    admins ad left join departments de on ad.department_id = de.id
order by ad.id;


select
    ad.id, ad.name, ad.email, ad.age, ad.tell_number, de.name department_name
from
    admins ad left join departments de on ad.department_id = de.id
where
    ad.id = :id;


検索
select * from admins where name LIKE '%test%' OR tell_number LIKE '%test%';
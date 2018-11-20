create table company(
    id int primary key
    ,nm varchar(25)
    ,tel char(13)
    ,e_mail varchar(25)
    ,loginId varchar(10)
    ,ps varchar(10)
)

create table instructor(
    id int primary key
    ,nm varchar(25)
    ,tel char(13)
    ,e_mail varchar(25)
    ,loginId varchar(10)
    ,ps varchar(10)
)

create table schedule(
    id int primary key
    ,str_date date
    ,end_date date
    ,u_id int
)

create table skill(
    id int primary key
    ,lang varchar(10)
)

create table skill_user(
    id int primary key
    ,u_id int
    ,s_id int
)

create table evalution(
    id int primary key
    ,c_id int
    ,u_id int
    ,results int
)

create table complete(
    id int primary key
    ,val varchar(5)
)

create table offer(
    id int primary key
    ,c_id int
    ,u_id int
    ,s_id int
    ,contents varchar(100)
    ,sta varchar(50)
    ,str_date date
    ,end_date date
    ,order_date date
    ,limit_date date
    ,app_id int
    ,complete_id int
)

create table approval(
    id int primary key
    ,val varchar(10)
)

insert skill(lang) values('C++'),('C#'),('Java'),('PHP'),('Ruby'),('Python')
,('Perl'),('VisualBsic'),('JavaScript'),('VB.NET'),('GO'),('Swift'),('Kotlin')
,('Objective C'),('LISP'),('Haskel'),('Prolog');

insert complete(val) values
('完了'),('未完了');

insert approval(val) values
('未承認'),('承認'),('拒否');

ALTER TABLE company MODIFY id INT auto_increment;
ALTER TABLE instructor MODIFY id INT auto_increment;
ALTER TABLE schedule MODIFY id INT auto_increment;
ALTER TABLE skill MODIFY id INT auto_increment;
ALTER TABLE skill_user MODIFY id INT auto_increment;
ALTER TABLE evalution MODIFY id INT auto_increment;
ALTER TABLE complete MODIFY id INT auto_increment;
ALTER TABLE offer MODIFY id INT auto_increment;
ALTER TABLE approval MODIFY id INT auto_increment;

ALTER TABLE company ADD UNIQUE (loginId);
ALTER TABLE company ADD UNIQUE (ps);
ALTER TABLE instructor ADD UNIQUE (loginId);
ALTER TABLE instructor ADD UNIQUE (ps);

ALTER TABLE schedule ADD FOREIGN KEY(u_id) REFERENCES instructor(id);
ALTER TABLE skill_user ADD FOREIGN KEY(u_id) REFERENCES instructor(id);
ALTER TABLE skill_user ADD FOREIGN KEY(s_id) REFERENCES skill(id);
ALTER TABLE offer ADD FOREIGN KEY(u_id) REFERENCES instructor(id);
ALTER TABLE offer ADD FOREIGN KEY(s_id) REFERENCES skill(id);
ALTER TABLE offer ADD FOREIGN KEY(c_id) REFERENCES company(id);
ALTER TABLE offer ADD FOREIGN KEY(app_id) REFERENCES approval(id);
ALTER TABLE offer ADD FOREIGN KEY(complete_id) REFERENCES complete(id);
ALTER TABLE evalution ADD FOREIGN KEY(u_id) REFERENCES instructor(id);
ALTER TABLE evalution ADD FOREIGN KEY(c_id) REFERENCES company(id);

create view view_suppengerichte as
select *
from gericht
where name like "%suppe%";
select *
from view_suppengerichte;
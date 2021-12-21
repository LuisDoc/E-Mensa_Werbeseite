create view view_anmeldungen as
select *
from benutzer
Order by (anzahlanmeldungen) DESC;
create view view_kategoriegerichte_vegetarisch as 
select gericht.name as Gerichtname, kategorie.name as Kategoriename
from gericht 
join gericht_hat_kategorie
on gericht_hat_kategorie.gericht_id = gericht.id and gericht.vegetarisch =1
right join kategorie
on gericht_hat_kategorie.kategorie_id = kategorie.id
order by gericht.name desc;
create view view_suppengerichte as
select *
from gericht
where name like "%suppe%";
select *
from view_suppengerichte;

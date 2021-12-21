create view view_anmeldungen as
select *
from benutzer
Order by (anzahlanmeldungen) DESC;
create view view_kategoriegerichte_vegetarisch as
Select DISTINCT kategorie.name as Kategoriename,
    (gericht.name) as Gerichtname
from kategorie
    left join gericht_hat_kategorie on gericht_hat_kategorie.kategorie_id = kategorie.id
    left join gericht on gericht_hat_kategorie.gericht_id = gericht.id
    and gericht.vegetarisch = 1;
create view view_suppengerichte as
select *
from gericht
where name like "%suppe%";
select *
from view_suppengerichte;
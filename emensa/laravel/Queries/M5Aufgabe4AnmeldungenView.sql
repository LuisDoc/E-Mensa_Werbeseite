create view view_anmeldungen as
select *
from benutzer
Order by (anzahlanmeldungen) DESC;
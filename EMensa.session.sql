select g.name,
    GROUP_CONCAT(gha.code) as Allergien
from gericht g
    join gericht_hat_allergen gha on g.id = gha.gericht_id
group by g.id
limit 5;
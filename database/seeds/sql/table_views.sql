create view bulls_view as
select b.id, b.sale_id, c.tag, c.purchase_date, c.birth, c.is_alive, c.gender, br.name, o.name, p.name,
(select weight from weight_logs where cattle_id = c.id order by date desc limit 1) as peso
from bulls b
inner join cattle c on b.cattle_id = c.id
left join breeds br on c.breed_id = br.id
left join owners o on c.owner_id = o.id
left join paddocks p on c.paddock_id = p.id;

create view cows_view as
select co.id, co.sale_id, c.tag, c.purchase_date, c.birth, c.is_alive, c.gender, br.name, o.name, p.name,
(select weight from weight_logs where cattle_id = c.id order by date desc limit 1) as peso
from cows co
inner join cattle c on co.cattle_id = c.id
left join breeds br on c.breed_id = br.id
left join owners o on c.owner_id = o.id
left join paddocks p on c.paddock_id = p.id;
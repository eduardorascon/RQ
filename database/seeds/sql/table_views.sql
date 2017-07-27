create view bulls_view as
select
	b.id, c.tag, c.purchase_date, c.birth, c.is_alive, c.gender,
	br.id as breed_id, br.name as breed_name,
	o.id as owner_id, o.name as owner_name,
	p.id as paddock_id, p.name as paddock_name,
	bs.id as sale_id, bs.sale_date,
	(select weight from weight_logs where cattle_id = c.id order by date desc limit 1) as peso
from bulls b
inner join cattle c on b.cattle_id = c.id
left join breeds br on c.breed_id = br.id
left join owners o on c.owner_id = o.id
left join paddocks p on c.paddock_id = p.id
left join bulls_sales bs on b.sale_id = bs.id;

create view cows_view as
select
	co.id, co.is_fertile, co.pregnancy_status, co.number_of_calves,
	c.tag, c.purchase_date, c.birth, c.is_alive, c.gender,
	br.id as breed_id, br.name as breed_name,
	o.id as owner_id, o.name as owner_name,
	p.id as paddock_id, p.name as paddock_name,
	cs.id as sale_id, cs.sale_date,
	(select weight from weight_logs where cattle_id = c.id order by date desc limit 1) as peso
from cows co
inner join cattle c on co.cattle_id = c.id
left join breeds br on c.breed_id = br.id
left join owners o on c.owner_id = o.id
left join paddocks p on c.paddock_id = p.id
left join cows_sales cs on co.sale_id = cs.id;

create view calves_view as
select
	ca.id, c.tag, co.id as mother_id, c.purchase_date, c.birth, c.is_alive, c.gender,
	br.id as breed_id, br.name as breed_name,
	o.id as owner_id, o.name as owner_name,
	p.id as paddock_id, p.name as paddock_name,
	cs.id as sale_id, cs.sale_date,
	(select weight from weight_logs where cattle_id = c.id order by date desc limit 1) as peso
from calves ca
inner join cattle c on ca.cattle_id = c.id
left join breeds br on c.breed_id = br.id
left join owners o on c.owner_id = o.id
left join paddocks p on c.paddock_id = p.id
left join calves_sales cs on ca.sale_id = cs.id
left join cows co on co.id = ca.cow_id;
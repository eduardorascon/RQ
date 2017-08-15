create view bulls_view as
select
	b.id, c.tag, c.purchase_date, date_format(c.purchase_date, '%d/%m/%Y') as purchase_date_with_format,
    c.birth, date_format(c.birth, '%d/%m/%Y') as birth_with_format,
    c.is_alive, c.gender,
	br.id as breed_id, upper(br.name) as breed_name,
	o.id as owner_id, upper(o.name) as owner_name,
	p.id as paddock_id, upper(p.name) as paddock_name,
	bs.id as sale_id, bs.sale_date, date_format(bs.sale_date, '%d/%m/%Y') as sale_date_with_format,
	timestampdiff(month, c.birth, curdate()) as age_in_months,
	coalesce((select weight from weight_logs where cattle_id = c.id order by date desc limit 1), 0) as current_weight
from bulls b
inner join cattle c on b.cattle_id = c.id
left join breeds br on c.breed_id = br.id
left join owners o on c.owner_id = o.id
left join paddocks p on c.paddock_id = p.id
left join bulls_sales bs on b.sale_id = bs.id;

create view last_calf_born_view as
select co.id as cow_id, max(catt.birth) as last_calf_born
from cows co
join calves ca on co.id = ca.cow_id
join cattle catt on ca.cattle_id = catt.id
group by co.id;

create view cows_view as
select
	co.id, co.is_fertile, upper(co.pregnancy_status) as pregnancy_status, co.number_of_calves,
	c.tag, c.purchase_date, date_format(c.purchase_date, '%d/%m/%Y') as purchase_date_with_format,
	c.birth, date_format(c.birth, '%d/%m/%Y') as birth_with_format, c.is_alive, c.gender,
	br.id as breed_id, upper(br.name) as breed_name,
	o.id as owner_id, upper(o.name) as owner_name,
	p.id as paddock_id, upper(p.name) as paddock_name,
	cs.id as sale_id, cs.sale_date, date_format(cs.sale_date, '%d/%m/%Y') as sale_date_with_format,
	timestampdiff(month, c.birth, curdate()) as age_in_months,
	coalesce((select weight from weight_logs where cattle_id = c.id order by date desc limit 1), 0) as current_weight,
	timestampdiff(month, lcbv.last_calf_born, curdate()) as months_since_last_birth
from cows co
inner join cattle c on co.cattle_id = c.id
left join breeds br on c.breed_id = br.id
left join owners o on c.owner_id = o.id
left join paddocks p on c.paddock_id = p.id
left join cows_sales cs on co.sale_id = cs.id
left join last_calf_born_view lcbv on c.id = lcbv.cow_id;

create view calves_view as
select
	ca.id, c.tag, c.purchase_date, date_format(c.purchase_date, '%d/%m/%Y') as purchase_date_with_format,
	c.birth, date_format(c.birth, '%d/%m/%Y') as birth_with_format, c.is_alive, c.gender,
	br.id as breed_id, upper(br.name) as breed_name,
	o.id as owner_id, upper(o.name) as owner_name,
	p.id as paddock_id, upper(p.name) as paddock_name,
	cs.id as sale_id, cs.sale_date, date_format(cs.sale_date, '%d/%m/%Y') as sale_date_with_format,
	timestampdiff(month, c.birth, curdate()) as age_in_months, co.id as mother_id, c2.tag as mother_tag,
	coalesce((select weight from weight_logs where cattle_id = c.id order by date desc limit 1), 0) as current_weight
from calves ca
inner join cattle c on ca.cattle_id = c.id
left join breeds br on c.breed_id = br.id
left join owners o on c.owner_id = o.id
left join paddocks p on c.paddock_id = p.id
left join calves_sales cs on ca.sale_id = cs.id
left join cows co on co.id = ca.cow_id
left join cattle c2 on c2.id = co.cattle_id;
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

create view cows_view as
select
	co.id, co.is_fertile, co.pregnancy_status, co.number_of_calves,
	c.tag, c.purchase_date, c.birth, c.is_alive, c.gender,
	br.id as breed_id, upper(br.name) as breed_name,
	o.id as owner_id, upper(o.name) as owner_name,
	p.id as paddock_id, upper(p.name) as paddock_name,
	cs.id as sale_id, cs.sale_date,
	timestampdiff(month, c.birth, curdate()) as age_in_months,
	coalesce((select weight from weight_logs where cattle_id = c.id order by date desc limit 1), 0) as current_weight,
	timestampdiff(month,
	        coalesce((select birth
              from calves
                left join cattle
                    on calves.cattle_id = cattle.id
              where cow_id = co.id
              order by calves.id desc limit 1)),
            curdate()) as months_since_last_birth
from cows co
inner join cattle c on co.cattle_id = c.id
left join breeds br on c.breed_id = br.id
left join owners o on c.owner_id = o.id
left join paddocks p on c.paddock_id = p.id
left join cows_sales cs on co.sale_id = cs.id;

create view calves_view as
select
	ca.id, c.tag, co.id as mother_id, c.purchase_date, c.birth, c.is_alive, c.gender,
	br.id as breed_id, upper(br.name) as breed_name,
	o.id as owner_id, upper(o.name) as owner_name,
	p.id as paddock_id, upper(p.name) as paddock_name,
	cs.id as sale_id, cs.sale_date,
	timestampdiff(month, c.birth, curdate()) as age_in_months,
	coalesce((select weight from weight_logs where cattle_id = c.id order by date desc limit 1), 0) as current_weight
from calves ca
inner join cattle c on ca.cattle_id = c.id
left join breeds br on c.breed_id = br.id
left join owners o on c.owner_id = o.id
left join paddocks p on c.paddock_id = p.id
left join calves_sales cs on ca.sale_id = cs.id
left join cows co on co.id = ca.cow_id;
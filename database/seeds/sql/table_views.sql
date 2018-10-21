create view bulls_view as
select
	b.id, c.tag, c.purchase_date, c.birth, c.is_alive, c.gender,
	br.id as breed_id, upper(br.name) as breed_name,
	o.id as owner_id, upper(o.name) as owner_name,
	p.id as paddock_id, upper(p.name) as paddock_name,
	bs.id as sale_id, bs.sale_date,
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

create view all_cattle_view as
select 
bu.id, bu.tag, bu.control_tag, bu.breed_name, 'Toro' AS kind, 
bu.birth_with_format , bu.birth, bu.purchase_date_with_format, bu.purchase_date,
bu.empadre_date_with_format, bu.empadre_date, bu.sale_date_with_format, bu.sale_date,
'Macho' AS gender, bu.current_weight, bu.age_in_months,
NULL AS pregnancy_status, NULL AS months_since_last_birth, NULL AS mother_id 
from bulls_view bu 
union 
select 
co.id, co.tag, co.control_tag, co.breed_name, 'Vaca',
co.birth_with_format, co.birth, co.purchase_date_with_format, co.purchase_date,
co.empadre_date_with_format, co.empadre_date, co.sale_date_with_format, co.sale_date,
'Hembra', co.current_weight, co.age_in_months,
co.pregnancy_status, co.months_since_last_birth, NULL
from cows_view co 
union 
select 
ca.id, ca.tag, ca.control_tag, ca.breed_name, 'Becerro',
ca.birth_with_format, ca.birth, ca.purchase_date_with_format, ca.purchase_date,
ca.empadre_date_with_format, ca.empadre_date, ca.sale_date_with_format ,ca.sale_date,
ca.gender, ca.current_weight, ca.age_in_months,
NULL, NULL, ca.mother_id AS mother_id
from calves_view ca
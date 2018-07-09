create view bulls_view as
select 
	b.id, c.tag, c.purchase_date, date_format(c.purchase_date,'%d/%m/%Y') AS purchase_date_with_format,
	c.birth, date_format(c.birth,'%d/%m/%Y') AS birth_with_format,
	c.is_alive, c.gender, 
	br.id AS breed_id, upper(br.name) AS breed_name,
	o.id AS owner_id, upper(o.name) AS owner_name,
	p.id AS paddock_id, upper(p.name) AS paddock_name,
	bs.id AS sale_id, bs.sale_date AS sale_date,date_format(bs.sale_date,'%d/%m/%Y') AS sale_date_with_format,
	timestampdiff(MONTH,c.birth,curdate()) AS age_in_months,
	coalesce((select weight_logs.weight from weight_logs where weight_logs.cattle_id = c.id order by weight_logs.date desc limit 1),0) AS current_weight,
	upper(cv.concat_comments) as comments
from bulls b 
inner join cattle c on b.cattle_id = c.id 
left join breeds br on c.breed_id = br.id 
left join owners o on c.owner_id = o.id 
left join paddocks p on c.paddock_id = p.id
left join bulls_sales bs on b.sale_id = bs.id
left join comments_view cv on b.cattle_id = cv.cattle_id;

create view calves_view as
select
	ca.id, c.tag, c.purchase_date, date_format(c.purchase_date, '%d/%m/%Y') as purchase_date_with_format,
	c.birth, date_format(c.birth, '%d/%m/%Y') as birth_with_format, c.is_alive, c.gender,
	br.id as breed_id, upper(br.name) as breed_name,
	o.id as owner_id, upper(o.name) as owner_name,
	p.id as paddock_id, upper(p.name) as paddock_name,
	cs.id as sale_id, cs.sale_date, date_format(cs.sale_date, '%d/%m/%Y') as sale_date_with_format,
	timestampdiff(month, c.birth, curdate()) as age_in_months,
	co.id as mother_id, c2.tag as mother_tag,
	coalesce((select weight from weight_logs where cattle_id = c.id order by date desc limit 1), 0) as current_weight
from calves ca
inner join cattle c on ca.cattle_id = c.id
left join breeds br on c.breed_id = br.id
left join owners o on c.owner_id = o.id
left join paddocks p on c.paddock_id = p.id
left join calves_sales cs on ca.sale_id = cs.id
left join cows co on co.id = ca.cow_id
left join cattle c2 on c2.id = co.cattle_id;

create view last_calf_born_view as
select co.id as cow_id, min(cs.age_in_months) age_in_months
from calves ca
inner join calves_view cs on ca.id = cs.id
inner join cattle catt on ca.cattle_id = catt.id
inner join cows co on ca.cow_id = co.id
inner join cattle catt2 on co.cattle_id = catt2.id
where ca.cow_id is not null
group by co.id;

create view cows_view as
select 
	co.id, co.is_fertile, upper(co.pregnancy_status) AS pregnancy_status, co.number_of_calves,
	(select count(0) from (calves left join cattle on((calves.cattle_id = cattle.id))) where (calves.cow_id = co.id)) AS number_of_registered_calves,
	c.tag, c.purchase_date, date_format(c.purchase_date,'%d/%m/%Y') AS purchase_date_with_format,
	c.birth, date_format(c.birth,'%d/%m/%Y') AS birth_with_format, c.is_alive, c.gender,
	br.id AS breed_id, upper(br.name) AS breed_name,
	o.id AS owner_id, upper(o.name) AS owner_name,
	p.id AS paddock_id,upper(p.name) AS paddock_name,
	cs.id AS sale_id, cs.sale_date, date_format(cs.sale_date,'%d/%m/%Y') AS sale_date_with_format,
	timestampdiff(MONTH,c.birth,curdate()) AS age_in_months,
	coalesce((select weight_logs.weight from weight_logs where weight_logs.cattle_id = c.id order by weight_logs.date desc limit 1),0) AS current_weight,
	timestampdiff(MONTH,coalesce((select max(cattle.birth) AS birth from (calves left join cattle on((calves.cattle_id = cattle.id))) where (calves.cow_id = co.id) group by calves.cow_id)),curdate()) AS months_since_last_birth,
	upper(cv.concat_comments) as comments
from cows co 
inner join cattle c on co.cattle_id = c.id
left join breeds br on c.breed_id = br.id
left join owners o on c.owner_id = o.id
left join paddocks p on c.paddock_id = p.id
left join cows_sales cs on co.sale_id = cs.id
left join comments_view cv on co.cattle_id = cv.cattle_id
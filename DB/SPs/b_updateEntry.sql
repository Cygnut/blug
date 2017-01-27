DELIMITER $$
DROP PROCEDURE IF EXISTS `b_updateEntry`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `b_updateEntry`(
	in _id int,
    in _title varchar(255), 
	in _content longtext,
	in _category_id int
	)
BEGIN
	
	update entry set
		title = coalesce(_title, title),
		content = coalesce(_content, content),
		category_id = coalesce(_category_id, category_id),
		when_updated = now()
	where id = _id;
	
	select
		e.*,
		ec.name as category_name
	from entry e
	inner join entry_category ec
	on e.category_id = ec.id
    where e.id = _id;
	
END$$
DELIMITER ;

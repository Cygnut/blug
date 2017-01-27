DELIMITER $$
DROP PROCEDURE IF EXISTS `b_insertEntry`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `b_insertEntry`(
	in _title varchar(255), 
	in _content longtext,
	in _category_id int,
	in _user_id int
	)
BEGIN
	
	insert into entry (
		title, 
		content, 
		category_id,
		user_id
	) values (
		_title,
		_content, 
		_category_id,
		_user_id
	);
	
	select
		n.*,
		nc.name as category_name
	from entry e
	inner join entry_category ec
	on e.category_id = ec.id
	where e.id = last_insert_id();
	
END$$
DELIMITER ;

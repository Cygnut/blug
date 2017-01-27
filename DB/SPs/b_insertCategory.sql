DELIMITER $$
DROP PROCEDURE IF EXISTS `b_insertCategory`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `b_insertCategory`(
	in _user_id int,
	in _name varchar(45),
	in _description varchar(255)
	)
BEGIN
	
	insert into entry_category (
		user_id,
		name, 
		description
	) values (
		_user_id,
		_name, 
		_description
	);
	
	select * 
	from entry_category
	where id = last_insert_id();
	
END$$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS `b_insertUser`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `b_insertUser`(
	in _name varchar(45)
	)
BEGIN
	
	insert into user (
		name
	) values (
		_name
	);
	
	select *
	from user u
	where u.id = last_insert_id();
	
END$$
DELIMITER ;

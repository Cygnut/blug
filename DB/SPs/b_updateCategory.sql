DELIMITER $$
DROP PROCEDURE IF EXISTS `b_updateCategory`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `b_updateCategory`(
	in _id int,
	in _name varchar(45),
	in _description varchar(255)
	)
BEGIN
	
	update entry_category set
		name = coalesce(_name, name),
		description = coalesce(_description, description),
		when_updated = now()
	where id = _id;
	
	select *
	from entry_category
	where id = _id;
	
END$$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS `b_getCategory`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `b_getCategory`(
	in _id int,
	in _user_id int
	)
BEGIN
	
	select * from entry_category
	where
		(_id is null or _id = id) and
		(_user_id is null or _user_id = user_id);
	
END$$
DELIMITER ;

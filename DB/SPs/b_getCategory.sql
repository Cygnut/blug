DELIMITER $$
DROP PROCEDURE IF EXISTS `b_getCategory`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `b_getCategory`(
	in _id int
	)
BEGIN
	
	select * from entry_category
	where (_id is null or _id = id);
	
END$$
DELIMITER ;

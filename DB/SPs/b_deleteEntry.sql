DELIMITER $$
DROP PROCEDURE IF EXISTS `b_deleteEntry`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `b_deleteEntry`(
	in _id int
	)
BEGIN
	
	delete from entry where id = _id;
	
END$$
DELIMITER ;

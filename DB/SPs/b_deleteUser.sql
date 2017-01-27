DELIMITER $$
DROP PROCEDURE IF EXISTS `b_deleteUser`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `b_deleteUser`(
	in _id int
	)
BEGIN
	
	delete from user where id = _id;
	
END$$
DELIMITER ;

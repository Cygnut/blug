DELIMITER $$
DROP PROCEDURE IF EXISTS `b_deleteCategory`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `b_deleteCategory`(
	in _id int
	)
BEGIN
	
	delete from entry_category where id = _id;
	
END$$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS `b_getEntry`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `b_getEntry`(
	in _id int,
	in _offset bigint unsigned, 
	in _limit bigint unsigned
	)
BEGIN
	
	set _offset = coalesce(_offset, 0);
	set _limit = coalesce(_limit, 18446744073709551615);
	
	select *
	from user u
	where
		(_id is null or u.id = _id)
	order by u.when_created desc
	limit _offset, _limit;
	
END$$
DELIMITER ;

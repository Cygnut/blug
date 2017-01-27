DELIMITER $$
DROP PROCEDURE IF EXISTS `b_getEntry`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `b_getEntry`(
	in _id int,
	in _offset bigint unsigned, 
	in _limit bigint unsigned,
	in _category_id int,
	in _title varchar(255),
	in _user_id int
	)
BEGIN
	
	set _offset = coalesce(_offset, 0);
	set _limit = coalesce(_limit, 18446744073709551615);
	
	select
		e.*,
		ec.name as category_name
	from entry e
	inner join entry_category ec
	on e.category_id = ec.id
	where
		(_id is null or e.id = _id) and
		(_category_id is null or e.category_id = _category_id) and
		(_title is null or e.title like concat('%', _title, '%')) and
		(_user_id is null or e.user_id = _user_id)
	order by e.when_created desc
	limit _offset, _limit;
	
END$$
DELIMITER ;

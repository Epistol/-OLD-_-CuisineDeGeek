CREATE DEFINER=`mlebeau`@`%` PROCEDURE `majClassementCoureur`( __ide int)
BEGIN

	DECLARE _idCoureur int;
    declare classmt int;
    declare _finish int default false;
    declare _curCoureurs  cursor for select IDPER from coureur;
    declare continue handler for not found set _finish = true;
    open _curCoureurs;
		fetch _curCoureurs into _idCoureur;
        
        while _finish != true do
			select count(*)+1 into classt from coureur
								where TEMPS < (select TEMPS from coureur WHERE IDPER = _idCoureur ) AND TEMPS != '00:00:00';
        
        
        
        update coureur
			set CLASSEMENTTEMPS = classmt
			where IDPER = _idCoureur;
            
            end repeat;
            close _curCoureurs;
	
    
END
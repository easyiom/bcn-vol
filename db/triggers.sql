DELIMITER $$
    CREATE TRIGGER ControlEstat BEFORE INSERT ON `tbl_inscri`
    FOR EACH ROW
    BEGIN
        SET @estat = (SELECT estat_event FROM tbl_events WHERE id_events = NEW.id_events);
        SET @count= (SELECT (count(*)+1 )FROM tbl_inscri WHERE id_events = NEW.id_events);
        SET @capacidad = (SELECT capac_event FROM tbl_events WHERE id_events = NEW.id_events);
        SET @countInsUsu = (SELECT COUNT(*) FROM tbl_inscri WHERE id_user=NEW.id_user AND id_events=NEW.id_events);
        IF @countInsUsu >= 1
            THEN SIGNAL SQLSTATE '45000'
                SET MESSAGE_TEXT = 'Ya se ha inscrito en este evento';
        ELSEIF @estat <> 'Activo'
            THEN SIGNAL SQLSTATE '45000'
                SET MESSAGE_TEXT = 'Capacitat máxima completa';

        ELSEIF @estat = 'Activo' AND @count > @capacidad
            THEN
                UPDATE tbl_events SET estat_event = 'Lleno' WHERE id_events = NEW.id_events;
        ELSEIF @count = @capacidad

            THEN
                UPDATE tbl_events SET estat_event = 'Lleno' WHERE id_events = NEW.id_events;
        END IF;
    END $$
DELIMITER ;

DELIMITER $$
    CREATE TRIGGER ControlInscripcion AFTER DELETE ON `tbl_inscri`
    FOR EACH ROW
    BEGIN
        SET @count = (SELECT (count(*)-1) FROM tbl_inscri WHERE id_events = OLD.id_events);
        SET @capacidad = (SELECT capac_event FROM tbl_events WHERE id_events = OLD.id_events);
        SET @estat = (SELECT estat_event FROM tbl_events WHERE id_events = OLD.id_events);
        IF  @count < @capacidad AND @estat='Lleno'
            THEN
                UPDATE tbl_events SET estat_event = 'Activo' WHERE id_events = OLD.id_events;
        END IF;
    END $$;
DELIMITER ;




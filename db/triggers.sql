DELIMITER $$
    CREATE TRIGGER ControlEstat BEFORE INSERT ON `tbl_inscri`
    FOR EACH ROW
    BEGIN
        SET @estat = (SELECT estat_event FROM tbl_events WHERE id_events = NEW.id_events);
        IF @estat = 'Lleno'
            THEN SIGNAL SQLSTATE '45000'
                SET MESSAGE_TEXT = 'Capacitat máxima completa';
        ELSEIF (SELECT count(*) FROM tbl_inscri WHERE id_events = NEW.id_events) <= (SELECT capac_event FROM tbl_events WHERE id_events = NEW.id_events)
            THEN
                UPDATE tbl_events SET estat_event = 'Lleno' WHERE id_events = NEW.id_events;
        END IF;
    END $$
DELIMITER ;






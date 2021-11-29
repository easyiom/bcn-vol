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

-- Segunda Manera
DELIMITER $$
    CREATE TRIGGER ControlEstat BEFORE INSERT ON `tbl_inscri`
    FOR EACH ROW
    BEGIN
        IF((SELECT count(*) FROM tbl_inscri WHERE id_user = NEW.id_user)=1)
            THEN
                UPDATE tbl_events SET estat_event = "Lleno" WHERE id_events = NEW.id_events;
        END IF;
    END $$
DELIMITER ;

--Insert
INSERT INTO `tbl_events` (`nom_events`, `data_ini_event`, `data_fi_event`, `adre_event`, `desc_event`, `ubi_event`, `capac_event`, `estat_event`, `foto_event`) VALUES
('Carrera Solidaria', '2021-12-16', '2021-12-24', 'C. Esteve Cardelus', 'Evento solidario en contra de las enfermedades respiratorias', 'Sant Celoni', 1, 'Activo', NULL)




DROP PROCEDURE IF EXISTS generator.create_generator;
CREATE PROCEDURE generator.create_generator( IN id_new VARCHAR(255), value_new INT )
BEGIN
    IF( SELECT id FROM  generator where id = id_new LIMIT 1 ) IS NULL
    THEN
        BEGIN
            INSERT INTO `generator`( id, `value` ) VALUES ( id_new, value_new );
        END;
    END IF;

    SELECT * FROM `generator` where id = id_new ;
END
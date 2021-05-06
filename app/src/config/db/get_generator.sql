DROP PROCEDURE IF EXISTS generator.get_generator;
CREATE PROCEDURE generator.get_generator( IN id_new VARCHAR(255) )
BEGIN
    SELECT
        value
    FROM
        generator
    WHERE
        id = id_new
    LIMIT
        1;
END
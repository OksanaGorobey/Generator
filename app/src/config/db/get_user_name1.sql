DROP PROCEDURE IF EXISTS generator.get_user_name;
CREATE PROCEDURE generator.get_user_name( IN nickname_val VARCHAR(255), password_val VARCHAR(255) )
BEGIN
    SELECT
        nickname
    FROM
         `users`
    WHERE
        nickname = nickname_val
        AND
        password = password_val
    LIMIT
        1;
END
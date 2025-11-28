DELIMITER $$

CREATE PROCEDURE sp_delete_reporte (IN p_id INT)
BEGIN
    DELETE FROM reportes WHERE id = p_id;
END$$

DELIMITER ;

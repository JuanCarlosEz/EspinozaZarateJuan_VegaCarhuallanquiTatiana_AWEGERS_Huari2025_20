DELIMITER //
CREATE PROCEDURE sp_read_reporte_por_id(IN p_id INT)
BEGIN
    SELECT * FROM reportes WHERE id = p_id LIMIT 1;
END //
DELIMITER ;

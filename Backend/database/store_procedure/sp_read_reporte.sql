DELIMITER $$

CREATE PROCEDURE sp_get_reportes ()
BEGIN
    SELECT 
        r.*,
        z.nombre AS zona_nombre
    FROM reportes r
    LEFT JOIN zonas z ON z.id = r.zona_id
    ORDER BY r.created_at DESC;
END$$

DELIMITER ;

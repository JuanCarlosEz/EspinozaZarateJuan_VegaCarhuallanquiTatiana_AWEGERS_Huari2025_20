DELIMITER $$

CREATE PROCEDURE sp_update_reporte (
    IN p_id INT,
    IN p_user_id INT,
    IN p_zona_id INT,
    IN p_tipo_incidencia VARCHAR(255),
    IN p_descripcion TEXT,
    IN p_nivel_prioridad VARCHAR(100),
    IN p_referencia VARCHAR(255),
    IN p_foto VARCHAR(255),
    IN p_ubicacion VARCHAR(255),
    IN p_estado VARCHAR(50)
)
BEGIN
    UPDATE reportes
    SET
        user_id = p_user_id,
        zona_id = p_zona_id,
        tipo_incidencia = p_tipo_incidencia,
        descripcion = p_descripcion,
        nivel_prioridad = p_nivel_prioridad,
        referencia = p_referencia,
        foto = p_foto,
        ubicacion = p_ubicacion,
        estado = p_estado,
        updated_at = NOW()
    WHERE id = p_id;
END$$

DELIMITER ;

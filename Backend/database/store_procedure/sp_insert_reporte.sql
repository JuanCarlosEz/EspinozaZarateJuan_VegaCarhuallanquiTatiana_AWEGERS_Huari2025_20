DELIMITER $$

CREATE PROCEDURE sp_insert_reporte (
    IN p_user_id INT,
    IN p_zona_id INT,
    IN p_tipo_incidencia VARCHAR(255),
    IN p_descripcion TEXT,
    IN p_nivel_prioridad VARCHAR(100),
    IN p_referencia VARCHAR(255),
    IN p_foto VARCHAR(255),
    IN p_ubicacion VARCHAR(255)
)
BEGIN
    INSERT INTO reportes (
        user_id,
        zona_id,
        tipo_incidencia,
        descripcion,
        nivel_prioridad,
        referencia,
        foto,
        ubicacion,
        estado,
        created_at,
        updated_at
    ) VALUES (
        p_user_id,
        p_zona_id,
        p_tipo_incidencia,
        p_descripcion,
        p_nivel_prioridad,
        p_referencia,
        p_foto,
        p_ubicacion,
        'pendiente',
        NOW(),
        NOW()
    );
END$$

DELIMITER ;

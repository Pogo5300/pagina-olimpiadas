---  creado por mi (mati)  ----
---  Procedimiento sp_insertar_usuario  ---
DELIMITER //

CREATE PROCEDURE sp_insertar_usuario (
    IN p_nombre VARCHAR(25),
    IN p_apellido VARCHAR(25),
    IN p_email VARCHAR(100),
    IN p_contrasena TEXT
)
BEGIN
    -- Validar si el email ya existe
    IF EXISTS (SELECT 1 FROM Usuarios WHERE email = p_email) THEN
        SELECT 'USUARIO_YA_EXISTE' AS Resultado;
    ELSE
        -- Insertar el nuevo usuario
        INSERT INTO Usuarios (nombre, apellido, email, contraseña)
        VALUES (p_nombre, p_apellido, p_email, p_contrasena);
        
        SELECT 'REGISTRO_EXITOSO' AS Resultado;
    END IF;
END;
//

DELIMITER ;


DELIMITER //

CREATE PROCEDURE sp_login_usuario (
    IN p_email VARCHAR(100)
)
BEGIN
    DECLARE v_count INT;

    -- Verificar si el correo existe
    SELECT COUNT(*) INTO v_count FROM Usuarios WHERE email = p_email;

    IF v_count = 0 THEN
        SELECT 'CUENTA_NO_EXISTE' AS Resultado;
    ELSE
        -- Devolver el hash de la contraseña para verificarlo en PHP
        SELECT id_usuario, nombre, apellido, email, contraseña FROM Usuarios WHERE email = p_email;
    END IF;
END;
//

DELIMITER ;

// --- procedimiento de admin
CREATE PROCEDURE sp_login_admin (
    IN pUsuario VARCHAR(100),
    IN pContrasena VARCHAR(100)
)
BEGIN
    IF EXISTS (
        SELECT 1 FROM administradores 
        WHERE usuario = pUsuario AND contraseña = pContrasena AND activo = 1
    ) THEN
        SELECT 'LOGIN_ADMIN_CORRECTO' AS Resultado;
    ELSE
        SELECT 'LOGIN_ADMIN_INCORRECTO' AS Resultado;
    END IF;
END;





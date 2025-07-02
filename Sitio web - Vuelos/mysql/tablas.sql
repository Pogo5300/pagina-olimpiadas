CREATE TABLE Usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(25),
    apellido VARCHAR(25),
    email VARCHAR(100) UNIQUE,
    contraseña TEXT,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Administradores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50),
    email VARCHAR(100),
    contraseña VARCHAR(255),
    activo TINYINT(1)
);

CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    descripcion TEXT,
    precio DECIMAL(10,2),
    imagen VARCHAR(255),
    categoria VARCHAR(50) 
);

CREATE TABLE pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    estado VARCHAR(50) DEFAULT 'Pendiente',
    total DECIMAL(10,2) NOT NULL,
    metodo_pago VARCHAR(50) NOT NULL,
    codigo_verificacion VARCHAR(20),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id_usuario)
);

CREATE TABLE pedidos_productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pedido_id INT NOT NULL,
    producto_id INT NOT NULL,
    cantidad INT NOT NULL,
    precio_unitario DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (pedido_id) REFERENCES pedidos(id),
    FOREIGN KEY (producto_id) REFERENCES productos(id)
);


-- Agregar las columnas de "precio_original" y "precio"
ALTER TABLE productos ADD COLUMN precio_original DECIMAL(10,2) DEFAULT 0;
ALTER TABLE productos ADD COLUMN precio DECIMAL(10,2) DEFAULT 0;

-- consulta para agregar productos (categoria: VUELOS)
INSERT INTO productos (nombre, descripcion, precio, imagen, rating, features, categoria) VALUES
('Europa Clásica - 10 días', 'París, Roma, Barcelona con vuelos y hoteles', 1899, 'Vuelos/Europa Clásica.jpg', '4.4', 'Vuelos incluidos,hoteles 4 estrellas,Desayunos,Guia turistica,Familiar', 'vuelo');

-- consulta para agregar productos (categoria: ALOJAMIENTOS)
INSERT INTO productos (nombre, descripcion, precio, imagen, rating, features, categoria) VALUES
('Hotel Ritz Madrid', 'Hotel de lujo en el centro de Madrid', 450, 'hoteles/Hotel Ritz Madrid.jpg', '4.9', '5 estrellas,Desayuno,incluido,Gimnasio,Concierge', 'alojamiento');

-- consulta para agregar productos (categoria: PAQUETE)
INSERT INTO productos (nombre, descripcion, precio, imagen, rating, features, categoria) VALUES
('Europa Clásica - 10 días', 'París, Roma, Barcelona con vuelos y hoteles', 1899, 'paquetes/Europa Clásica.jpg', '4.4', 'Vuelos incluidos,hoteles 4 estrellas,Desayunos,Guia turistica,Familiar', 'paquete');

-- consulta para agregar ofertas (categoria: OFERTAS)
INSERT INTO productos (nombre, descripcion, precio, imagen, rating, features, categoria) VALUES
('Europa Clásica - 10 días', 'París, Roma, Barcelona con vuelos y hoteles', 1899, 'ofertas/Europa Clásica.jpg', '4.4', 'Vuelos incluidos,hoteles 4 estrellas,Desayunos,Guia turistica,Familiar', 'oferta');
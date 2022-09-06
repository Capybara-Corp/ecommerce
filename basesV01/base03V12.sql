--   _______  _______  _______  __   __  _______  _______  ______    _______ 
--  |       ||   _   ||       ||  | |  ||  _    ||   _   ||    _ |  |   _   |
--  |       ||  |_|  ||    _  ||  |_|  || |_|   ||  |_|  ||   | ||  |  |_|  |
--  |       ||       ||   |_| ||       ||       ||       ||   |_||_ |       |
--  |      _||       ||    ___||_     _||  _   | |       ||    __  ||       |
--  |     |_ |   _   ||   |      |   |  | |_|   ||   _   ||   |  | ||   _   |
--  |_______||__| |__||___|      |___|  |_______||__| |__||___|  |_||__| |__|

DROP DATABASE IF EXISTS CHARRUA;
CREATE DATABASE IF NOT EXISTS CHARRUA;

USE CHARRUA;

/*SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";--> se utiliza cuando hay diferentes versiones de mysql en uso. 
cuando estas transfiriendo de un server a otro tenemos que tener en cuenta las versiones de uso de la base de datos en un nuevo entorno.*/
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
/*START TRANSACTION--> es la forma recomendada para iniciar una transaccion ad-hoc, una consulta ad-hoc es una consulta que no se puede determinar antes del momento en que se emite la consulta.
Se crea para obtener información cuando surge la necesidad y consiste en sql construido dinámicamente.
Las transacciones de bases de datos permiten agrupar sentencias en bloques, las mismas, van a ser ejecutados simultaneamente de tal forma que podamos evaluar si alguna de las sentencias
ha fallado y de ser asi poder deshacer los cambios en el momento sin alterar de forma alguna la base de datos.*/
START TRANSACTION;
SET time_zone = "+00:00";/* --> se utiliza para que el servidor sepa que hora es.*/

DROP TABLE IF EXISTS PROVEEDORES;
CREATE TABLE IF NOT EXISTS PROVEEDORES (
  id int NOT NULL AUTO_INCREMENT,
  nombre varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  direccion varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY nombre (nombre)
);

DROP TABLE IF EXISTS TEL_PROVEEDORES;
CREATE TABLE IF NOT EXISTS TEL_PROVEEDORES (
  proveedor_id int NOT NULL,
  telefono varchar(45) NOT NULL UNIQUE like '%[0-9]%',
  PRIMARY KEY (proveedor_id, telefono),
  FOREIGN KEY (proveedor_id) REFERENCES PROVEEDORES (id) ON DELETE CASCADE ON UPDATE CASCADE
);

DROP TABLE IF EXISTS COMPRA_PROVEEDOR;
CREATE TABLE IF NOT EXISTS COMPRA_PROVEEDOR (
  id int NOT NULL AUTO_INCREMENT,
  proveedor_id int NOT NULL,
  fecha datetime NOT NULL,
  PRIMARY KEY (id),
  KEY fk_proveedor (proveedor_id)
);

DROP TABLE IF EXISTS DETALLE_COMPRA;
CREATE TABLE IF NOT EXISTS DETALLE_COMPRA (
  id int NOT NULL AUTO_INCREMENT,
  articulo_id int NOT NULL,
  cantidad int NOT NULL,
  precio decimal(10,2) NOT NULL,
  compra_id int NOT NULL,
  PRIMARY KEY (id),
  KEY fk_articulo (articulo_id) references articulo (id),
  KEY fk_compra (compra_id)
  COMMENT 'Comprar a un proveedor genera una compra, por lo que es necesario tener detalle sobre la compra'
);

DROP TABLE IF EXISTS USUARIOS;
CREATE TABLE IF NOT EXISTS USUARIOS (
  id int NOT NULL AUTO_INCREMENT,
  email varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL UNIQUE,
-- añadir fecha de nacimiento y si es menor de edad no se le permite comprar
  fecha_nacimiento date NOT NULL,
  nombre varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
-- necesito una contraseña de 200 caracteres porque se guarda con hash (BDCRYPT)
  passwd varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY nombre (nombre)
);

DROP TABLE IF EXISTS PRODUCTOS;
CREATE TABLE IF NOT EXISTS PRODUCTOS (
  id_productos int NOT NULL AUTO_INCREMENT,
  codigo varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  descripcion varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  categoria varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  precio decimal(10,2) DEFAULT NULL,
  fecha datetime DEFAULT NULL,
  url varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (id_productos),
  UNIQUE KEY codigo_UNIQUE (codigo)
);

DROP TABLE IF EXISTS PEDIDO;
CREATE TABLE IF NOT EXISTS PEDIDO (
  id int NOT NULL AUTO_INCREMENT,
  usuario_id int NOT NULL,
  fecha datetime NOT NULL,
  PRIMARY KEY (id),
  KEY fk_usuario (usuario_id)
);

DROP TABLE IF EXISTS DETALLE_VENTA;
CREATE TABLE IF NOT EXISTS DETALLE_VENTA (
  id int NOT NULL AUTO_INCREMENT,
  articulo_id int NOT NULL,
  cantidad int NOT NULL,
  precio decimal(10,2) NOT NULL,
  pedido_id int NOT NULL,
  PRIMARY KEY (id),
  KEY fk_articulo (articulo_id) references articulo (id),
  KEY fk_pedido (pedido_id)
  COMMENT 'Relación entre pedido y articulo (vender a un usuario genera un pedido, por lo que es necesario tener detalle sobre la venta)'
);

ALTER TABLE DETALLE_VENTA ---> se añade la columna de la tabla DETALLE_VENTA para que sea una clave foranea y no se pueda repetir el articulo en el mismo pedido.
  ADD CONSTRAINT fk_articulo FOREIGN KEY (articulo_id) REFERENCES productos (id_productos),
  ADD CONSTRAINT fk_pedido FOREIGN KEY (pedido_id) REFERENCES pedido (id) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE PEDIDO ---> si se elimina un pedido se eliminan los DETALLE_VENTAS que pertenecen a ese pedido
  ADD CONSTRAINT fk_usuario FOREIGN KEY (usuario_id) REFERENCES usuarios (id);
COMMIT;

ALTER TABLE usuarios ---> se le puede añadir una columna a la tabla usuarios para saber si es mayor de edad o no
ADD COLUMN mayor_edad boolean NOT NULL DEFAULT false;

insert into PROVEEDORES (id, nombre, direccion)
values (1, 'Proveedor 1', 'Calle 1'),
values (2, 'Proveedor 2', 'Calle 2'),
values (3, 'Proveedor 3', 'Calle 3'),
values (4, 'Proveedor 4', 'Calle 4'),
values (5, 'Proveedor 5', 'Calle 5'),
values (6, 'Proveedor 6', 'Calle 6'),
values (7, 'Proveedor 7', 'Calle 7'),
values (8, 'Proveedor 8', 'Calle 8'),
values (9, 'Proveedor 9', 'Calle 9'),
values (10, 'Proveedor 10', 'Calle 10');

insert into TEL_PROVEEDORES (proveedor_id, telefono)
values (1, '123456789'),
values (2, '987654321'),
values (3, '123456789'),
values (4, '987654321'),
values (5, '123456789'),
values (6, '987654321'),
values (7, '123456789'),
values (8, '987654321'),
values (9, '123456789'),
values (10, '987654321');

insert into PRODUCTOS (id_productos, codigo, descripcion, categoria, precio, fecha, url)
-- codigo=nombre del producto, descripcion=descripcion del producto, categoria=categoria del producto, precio=precio del producto, fecha=fecha de creacion del producto, url=url de la imagen del producto
values (1, 'Vino tinto', 'Producto 1', 'vinos', 1.00, '2020-01-01', ''),
values (2, 'Vino blanco', 'Producto 2', 'vinos', 2.00, '2020-01-01', ''),
values (3, 'Vino rosado', 'Producto 3', 'vinos', 3.00, '2020-01-01', ''),
values (4, 'Vino espumoso', 'Producto 4', 'vinos', 4.00, '2020-01-01', ''),
values (5, 'Vino generoso', 'Producto 5', 'vinos', 5.00, '2020-01-01', ''),
values (6, 'Vino de la casa', 'Producto 6', 'vinos', 6.00, '2020-01-01', ''),
values (7, 'Vino merlot', 'Producto 7', 'vinos', 7.00, '2020-01-01', ''),
values (8, 'Vino cabernet', 'Producto 8', 'vinos', 8.00, '2020-01-01', ''),
values (9, 'Vino syrah', 'Producto 9', 'vinos', 9.00, '2020-01-01', ''),
values (10, 'Vino zinfandel', 'Producto 10', 'vinos', 10.00, '2020-01-01', '');
values (11, 'Vino franco', 'Producto 11', 'vinos', 1.00, '2020-01-01', ''),
values (12, 'Vino bianco', 'Producto 12', 'vinos', 2.00, '2020-01-01', ''),
values (13, 'Vino bajo en alcohol', 'Producto 13', 'vinos', 3.00, '2020-01-01', ''),
values (14, 'Vino riesling', 'Producto 14', 'vinos', 4.00, '2020-01-01', ''),
values (15, 'Vino pinot noir', 'Producto 15', 'vinos', 5.00, '2020-01-01', ''),
values (16, 'Vino chardonnay', 'Producto 16', 'vinos', 6.00, '2020-01-01', ''),
values (17, 'Vino sauvignon', 'Producto 18', 'vinos', 8.00, '2020-01-01', ''),
values (18, 'Vino roussanne', 'Producto 19', 'vinos', 9.00, '2020-01-01', ''),
values (19, 'Vino verdejo', 'Producto 20', 'vinos', 10.00, '2020-01-01', ''),
values (20, 'Vino sherry', 'Producto 21', 'vinos', 1.00, '2020-01-01', ''),

values (21, 'Copa bohemia', 'Producto 22', 'copas', 2.00, '2020-01-01', ''),
values (22, 'Copa barone', 'Producto 23', 'copas', 3.00, '2020-01-01', ''),
values (23, 'Copa degustacion', 'Producto 24', 'copas', 4.00, '2020-01-01', ''),
values (24, 'Copa brunello', 'Producto 25', 'copas', 5.00, '2020-01-01', ''),
values (25, 'Copa paulista', 'Producto 26', 'copas', 6.00, '2020-01-01', ''),

values (26, 'Barra zamak conica', 'Producto 27', 'herramientas', 7.00, '2020-01-01', ''),
values (27, 'Abridor de botella', 'Producto 28', 'herramientas', 8.00, '2020-01-01', ''),
values (28, 'Saca corchos', 'Producto 29', 'herramientas', 9.00, '2020-01-01', ''),
values (29, 'Cortador de laminas', 'Producto 30', 'herramientas', 10.00, '2020-01-01', ''),
values (30, 'Decantador y Vela', 'Producto 31', 'herramientas', 1.00, '2020-01-01', ''),
values (31, 'Termometro', 'Producto 32', 'herramientas', 2.00, '2020-01-01', ''),
values (32, 'Tenazas sumiller', 'Producto 33', 'herramientas', 3.00, '2020-01-01', ''),
values (33, 'Corchos', 'Producto 34', 'herramientas', 4.00, '2020-01-01', ''),
values (34, 'Tastevin', 'Producto 35', 'herramientas', 5.00, '2020-01-01', ''),
values (35, 'Glacette', 'Producto 36', 'herramientas', 6.00, '2020-01-01', ''),
values (36, 'Toalla de bar sin pelusa', 'Producto 37', 'herramientas', 7.00, '2020-01-01', ''),
values (37, 'Enfriador de vino', 'Producto 38', 'herramientas', 8.00, '2020-01-01', ''),
values (38, 'Bolsa de transporte', 'Producto 39', 'herramientas', 9.00, '2020-01-01', ''),
values (39, 'Protectores de vino para viajes', 'Producto 40', 'herramientas', 10.00, '2020-01-01', '');
values (40, 'Tapones de silicona', 'Producto 41', 'herramientas', 1.00, '2020-01-01', '');
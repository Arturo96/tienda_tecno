DROP DATABASE tienda_tecno;

CREATE DATABASE tienda_tecno;

use tienda_tecno;

CREATE TABLE ciudades(
    id      int(10) auto_increment not null,
    nombre  varchar(200) not null,
    CONSTRAINT pk_ciudades PRIMARY KEY(id)
)engine=InnoDB;

CREATE TABLE tipo_productos(
    id      int(10) auto_increment not null,
    nombre  varchar(200) not null,
    CONSTRAINT pk_tipo_productos PRIMARY KEY(id)
)engine=InnoDB;

CREATE TABLE roles(
    id      int(10) auto_increment not null,
    nombre  varchar(200) not null,
    CONSTRAINT pk_roles PRIMARY KEY(id)
)engine=InnoDB;

CREATE TABLE vendedores(
    id         int(10) auto_increment not null,
    nombre     varchar(100) not null,
    apellidos  varchar(100) not null,
    documento  int(10) not null,
    CONSTRAINT pk_vendedores PRIMARY KEY(id),
    CONSTRAINT uq_documento UNIQUE(documento)
)engine=InnoDB;

CREATE TABLE usuarios(
    email       varchar(100) not null,
    rol_id      int(10) not null,
    password    varchar(20) not null,
    CONSTRAINT pk_usuarios PRIMARY KEY(email),
    CONSTRAINT fk_usuario_rol FOREIGN KEY(rol_id) REFERENCES roles(id)
)engine=InnoDB;

CREATE TABLE clientes(
    email       varchar(100) not null,
    ciudad_id   int(10) not null,
    documento   int(10) not null,
    nombre      varchar(100) not null,
    apellidos   varchar(100),
    direccion   varchar(200) not null,
    telefono    bigint(15),
    CONSTRAINT pk_clientes PRIMARY KEY(email),
    CONSTRAINT fk_cliente_ciudad FOREIGN KEY(ciudad_id) REFERENCES ciudades(id),
    CONSTRAINT uq_documento UNIQUE(documento)
)engine=InnoDB;

CREATE TABLE productos(
    id                  int(10) auto_increment not null,
    tipo_producto_id    int(10) not null,
    marca               varchar(100) not null,
    modelo              varchar(200) not null,
    precio              float(10, 2) not null,
    stock               int(10) not null,
    fecha_garantia      date,
    descripcion         MEDIUMTEXT,
    CONSTRAINT pk_productos PRIMARY KEY(id),
    CONSTRAINT fk_producto_tipo FOREIGN KEY(tipo_producto_id) REFERENCES tipo_productos(id)
    
)engine=InnoDB;

CREATE TABLE compras(
    id                  int(10) auto_increment not null,
    cliente             varchar(100) not null,
    vendedor_id         int(10) not null,
    fecha               date not null,
    CONSTRAINT pk_compras PRIMARY KEY(id),
    CONSTRAINT fk_compra_cliente FOREIGN KEY(cliente) REFERENCES clientes(email),
    CONSTRAINT fk_compra_vendedor FOREIGN KEY(vendedor_id) REFERENCES vendedores(id)
)engine=InnoDB;

CREATE TABLE detalle_compras(
    compra_id           int(10) not null,
    producto_id         int(10) not null,
    cantidad            int(10) not null,
    CONSTRAINT pk_detalle_compras PRIMARY KEY(compra_id, producto_id),
    CONSTRAINT fk_factura_compra FOREIGN KEY(compra_id) REFERENCES compras(id),
    CONSTRAINT fk_factura_producto FOREIGN KEY(producto_id) REFERENCES productos(id)
)engine=InnoDB;

INSERT INTO ciudades VALUES (null, 'Bogotá');
INSERT INTO ciudades VALUES (null, 'Medellín');
INSERT INTO ciudades VALUES (null, 'Cali');
INSERT INTO ciudades VALUES (null, 'Barranquilla');
INSERT INTO ciudades VALUES (null, 'Bucaramanga');
INSERT INTO ciudades VALUES (null, 'Manizales');
INSERT INTO ciudades VALUES (null, 'Pereira');
INSERT INTO ciudades VALUES (null, 'Armenia');
INSERT INTO ciudades VALUES (null, 'Popayán');
INSERT INTO ciudades VALUES (null, 'Santa Marta');
INSERT INTO ciudades VALUES (null, 'Riohacha');
INSERT INTO ciudades VALUES (null, 'Cartagena');
INSERT INTO ciudades VALUES (null, 'Tunja');
INSERT INTO ciudades VALUES (null, 'Neiva');
INSERT INTO ciudades VALUES (null, 'Ibagué');

INSERT INTO tipo_productos VALUES (null, 'Celular');
INSERT INTO tipo_productos VALUES (null, 'Tablet');
INSERT INTO tipo_productos VALUES (null, 'Portátil');
INSERT INTO tipo_productos VALUES (null, 'Auriculares');
INSERT INTO tipo_productos VALUES (null, 'Altavoces');
INSERT INTO tipo_productos VALUES (null, 'Micrófono');
INSERT INTO tipo_productos VALUES (null, 'Monitor');
INSERT INTO tipo_productos VALUES (null, 'Minicomponente');
INSERT INTO tipo_productos VALUES (null, 'TV');
INSERT INTO tipo_productos VALUES (null, 'Smartwatch');
INSERT INTO tipo_productos VALUES (null, 'Batería portable');
INSERT INTO tipo_productos VALUES (null, 'Router');
INSERT INTO tipo_productos VALUES (null, 'Switch');

INSERT INTO roles VALUES (null, 'Admin');
INSERT INTO roles VALUES (null, 'Vendedor');
INSERT INTO roles VALUES (null, 'Auditor');

INSERT INTO vendedores VALUES (null, 'Julián Fernando', 'Duque Martinez', 1152134567);
INSERT INTO vendedores VALUES (null, 'Luz Alba', 'Fernandez Fernandez', 1152194567);
INSERT INTO vendedores VALUES (null, 'Carlos Andrés', 'Cuero Suaza', 52134567);
INSERT INTO vendedores VALUES (null, 'Giovanny Andrés', 'Vargas Castro', 32134567);

INSERT INTO usuarios VALUES ('carlosospino13@gmail.com', 1, 1234);
INSERT INTO usuarios VALUES ('dtellez@gmail.com', 3, 1234);
INSERT INTO usuarios VALUES ('giovannyvargas@gmail.com', 2, 1234);
INSERT INTO usuarios VALUES ('lfernandez@gmail.com', 2, 1234);
INSERT INTO usuarios VALUES ('csuaza@gmail.com', 2, 1234);
INSERT INTO usuarios VALUES ('jmartinez@gmail.com', 2, 1234);

INSERT INTO clientes VALUES ('hlavoe@gmail.com', 5, 1152457641, 'Hector Alfonso','Lavoe Jimenez', 'Calle 33AA # 93C-62 Villas de Aragón Bloque 5 Casa 201', 4922027);

INSERT INTO clientes VALUES ('darbelaez@gmail.com', 8, 1030456789, 'Alvaro Diego','Arbelaez Gallego', 'Carrera 73 # 32C - 99', 3027670626);

INSERT INTO clientes VALUES ('sramirez@gmail.com', 7, 1156857636, 'Susana Estrada','Henao Ramirez', 'Calle 16 # 81C-62', 3014563423);

INSERT INTO productos VALUES (null, 1, 'Xiaomi', 'Redmi Note 8 Pro', 900000.00, 5, '2020-11-11', 'RAM: 6 GB, Procesador: Mediatek  Helio G90T, Almacenamiento: 128 GB, Tamaño de pantalla: 6,53 pulgadas');

INSERT INTO productos VALUES (null, 1, 'Oneplus', '7 Pro', 2500000.00, 2, '2020-11-11', 'RAM: 8 GB, Procesador: Qualcomm Snapdragon 855, Almacenamiento: 256 GB, Tamaño de pantalla: 6.67 pulgadas');

INSERT INTO compras VALUES (null, 'hlavoe@gmail.com', 1, CURDATE());
INSERT INTO compras VALUES (null, 'darbelaez@gmail.com', 2, CURDATE());

INSERT INTO detalle_compras VALUES (1, 1, 2);
INSERT INTO detalle_compras VALUES (1, 2, 1);

INSERT INTO detalle_compras VALUES (2, 1, 1);

# Consultas

SELECT d.*, p.marca, p.modelo, p.precio, (p.precio * d.cantidad) AS 'Costo total'
FROM detalle_compras d
    JOIN productos p ON d.producto_id = p.id
ORDER BY d.compra_id;


CREATE TABLE detalle_compras(
    compra_id           int(10) not null,
    producto_id         int(10) not null,
    cantidad            int(10) not null,
    CONSTRAINT pk_detalle_compras PRIMARY KEY(compra_id, producto_id),
    CONSTRAINT fk_factura_compra FOREIGN KEY(compra_id) REFERENCES compras(id),
    CONSTRAINT fk_factura_producto FOREIGN KEY(producto_id) REFERENCES productos(id)
);

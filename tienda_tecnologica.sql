CREATE DATABASE tienda_tecnologica;

use tienda_tecnologica;

CREATE TABLE ciudades(
    id      int(10) auto_increment not null,
    nombre  varchar(200) not null,
    CONSTRAINT pk_ciudades PRIMARY KEY(id)
);

CREATE TABLE tipo_productos(
    id      int(10) auto_increment not null,
    nombre  varchar(200) not null,
    CONSTRAINT pk_tipo_productos PRIMARY KEY(id)
);

CREATE TABLE roles(
    id      int(10) auto_increment not null,
    nombre  varchar(200) not null,
    CONSTRAINT pk_roles PRIMARY KEY(id)
);

CREATE TABLE vendedores(
    id         int(10) auto_increment not null,
    nombre     varchar(100) not null,
    apellidos  varchar(100) not null,
    documento  int(10) not null,
    CONSTRAINT pk_vendedores PRIMARY KEY(id),
    CONSTRAINT uq_documento UNIQUE(documento)
);

CREATE TABLE usuarios(
    email       varchar(100) not null,
    rol_id      int(10) not null,
    password    varchar(20) not null,
    CONSTRAINT pk_usuarios PRIMARY KEY(email),
    CONSTRAINT fk_usuario_rol FOREIGN KEY(rol_id) REFERENCES roles(id)
);

CREATE TABLE clientes(
    email       varchar(100) not null,
    ciudad_id   int(10) not null,
    documento   int(10) not null,
    nombre      varchar(100) not null,
    apellidos   varchar(100),
    direccion   varchar(200) not null,
    telefono    int(15),
    CONSTRAINT pk_clientes PRIMARY KEY(email),
    CONSTRAINT fk_cliente_ciudad FOREIGN KEY(ciudad_id) REFERENCES ciudades(id),
    CONSTRAINT uq_documento UNIQUE(documento)
);

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
    
);



CREATE DATABASE IF NOT EXISTS system_sop;
USE system_sop;

/* -USUARIOS- */
CREATE TABLE IF NOT EXISTS users(
    id              int(255) auto_increment not null,
    role            varchar(20),
    name            varchar(100),
    surname         varchar(200),
    num_empleado    int(255),
    nick            varchar(100),
    email           varchar(255),
    password        varchar(255),
    image           varchar(255),
    created_at      datetime,
    updated_at      datetime,
    remember_token  varchar(255),
    CONSTRAINT pk_users PRIMARY KEY(id)
)ENGINE=InnoDb;

INSERT INTO users VALUES (NULL, 'admin', 'Angel', 'Paredes', 15090105,'angel95', 'admin@admin.com', 'n15090105', null, CURTIME(), CURTIME(), NULL);

/* -PARTIDAS- */
CREATE TABLE IF NOT EXISTS partidas_urg(
    id                  int auto_increment not null,
    clave_urg           int(255),
    nom_cog_partida     varchar(255),
    desc_cog_partida    text,
    CONSTRAINT pk_partidas PRIMARY KEY(id)
)ENGINE=InnoDb;

/* -CENTRO DE COSTOS- */
CREATE TABLE IF NOT EXISTS centro_de_costos(
    id int auto_increment not null,
    nom_centro_costo varchar(255),
    titular varchar(255),
    cargo varchar(255),
    nom_enlace varchar(255),
    cargo_enlace varchar(255),
    id_urg int(255),
    id_usuario int(255),
    CONSTRAINT pk_centro_de_costo PRIMARY KEY(id),
    CONSTRAINT fk_centro_de_costos_partidas_urg FOREIGN KEY(id_urg) REFERENCES partidas_urg(id),
    CONSTRAINT fk_centro_de_costos_users FOREIGN KEY(id_usuario) REFERENCES users(id)
)ENGINE=InnoDb;

/* -TRAMITE- */
CREATE TABLE IF NOT EXISTS tramite(
    id int auto_increment not null,
    num_folio int(255),
    periodo varchar(255),
    proyecto varchar(200),
    descripcion text,
    importe_letra varchar(255),
    importe_num int(255),
    create_at datetime,
    id_dependencia int(255),
    id_urg int(255),
    id_usuario int(255),
    CONSTRAINT pk_tramite PRIMARY KEY(id)
)ENGINE=InnoDb;

/* -CUENTAS- */
CREATE TABLE IF NOT EXISTS cuenta(
    id int auto_increment not null,
    nombre varchar(255),
    CONSTRAINT pk_cuenta PRIMARY KEY(id)
)ENGINE=InnoDb;

/* -FACTURAS- */
CREATE TABLE IF NOT EXISTS facturas(
    id int auto_increment not null,
    monto int(255),
    provedor varchar(255),
    id_tramite int(255),
    id_usuario int(255),
    CONSTRAINT pk_facturas PRIMARY KEY(id)
)ENGINE=InnoDb;

/* -CONCENTRADO / PRESUPUESTO- */
CREATE TABLE IF NOT EXISTS concentrado(
    id int auto_increment not null,
    mes varchar(20),
    acomulado int(255),
    id_urg int(255),
    id_cuenta int(255),
    CONSTRAINT pk_concentrado PRIMARY KEY(id)
)ENGINE=InnoDb;

/* -VENEFICIARIO */
CREATE TABLE IF NOT EXISTS beneficiario(
    id int auto_increment not null,
    num_beneficiario int,
    beneficiario varchar(100),
    titular varchar(100),
    enlace varchar(255),
    rfc varchar(50),
    giro varchar(100),
    telefono varchar(20),
    email varchar(100),
    direccion varchar(150),
    cp int,
    ciudad varchar(100),
    pais varchar(100),
    observaciones varchar(255),
    tipo varchar(100),
    CONSTRAINT pk_veneficiario PRIMARY KEY(id)
)ENGINE=InnoDb;
INSERT INTO veneficiario VALUES (NULL, 2324, 'Angel', 'Marisol', 'Financiero', 'PATA1003MS019', 'Vendedor', '7341509106', 'angel@angel.com', 'Tetelpa', 62780, 'Zacatepec', 'Mexico','Lorem input', 'Provedor');

















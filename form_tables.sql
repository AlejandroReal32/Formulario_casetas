-- Crear base de datos
CREATE DATABASE IF NOT EXISTS casetas_inspeccion;
USE casetas_inspeccion;

-- Tabla: Sitio de Inspeccion
CREATE TABLE sitio_inspeccion (
    id INT PRIMARY KEY AUTO_INCREMENT,
    tipositioInspeccion VARCHAR(100),
    entidad VARCHAR(100),
    sitio VARCHAR(100),
    fecha DATE,
    hora TIME
);

-- Tabla: Informacion General
CREATE TABLE info_general (
    id INT PRIMARY KEY AUTO_INCREMENT,
    Tipo_de_mercancia VARCHAR(50),
    doc_mov_presenta VARCHAR(20),
    Tipo_de_doc VARCHAR(100),
    folio_doc_mov VARCHAR(100),
    tipo_revision VARCHAR(50)
);

-- Tabla: Informacion de la Mercancia
CREATE TABLE info_mercancia (
    id INT PRIMARY KEY AUTO_INCREMENT,
    mercancia VARCHAR(100),
    variedad_mercancia VARCHAR(100),
    P_mercancia VARCHAR(100),
    tipo_embalaje VARCHAR(100),
    cantidad DECIMAL(15,2),
    peso DECIMAL(15,2),
    cantidad_total DECIMAL(15,2),
    unidad_medida VARCHAR(50),
    motivo_mov VARCHAR(100)
);

-- Tabla: Informacion del Cargamento
CREATE TABLE info_carga (
    id INT PRIMARY KEY AUTO_INCREMENT,
    estadoOrigen VARCHAR(100),
    municipioOrigen VARCHAR(100),
    estadoDestino VARCHAR(100),
    municipioDestino VARCHAR(100),
    empresaOrigen VARCHAR(100),
    empresaDestino VARCHAR(100),
    tipoVehiculo VARCHAR(100),
    descripcionVehiculo VARCHAR(200),
    placas VARCHAR(50),
    fleje VARCHAR(50)
);

-- Tabla: Incumplimiento Federal
CREATE TABLE incumplimiento_federal (
    id INT PRIMARY KEY AUTO_INCREMENT,
    FcumpleNoCumple VARCHAR(50),
    FresultadoVerificacion TEXT,
    FaccionResultante TEXT,
    FfolioActa VARCHAR(100)
);

-- Tabla: Incumplimiento Estatal
CREATE TABLE incumplimiento_estatal (
    id INT PRIMARY KEY AUTO_INCREMENT,
    EcumpleNoCumple VARCHAR(50),
    EresultadoVerificacion TEXT,
    EaccionResultante TEXT,
    EfolioActa VARCHAR(100)
);

-- Tabla: Datos de Expedicion del Certificado de Aportacion (DECA)
CREATE TABLE deca (
    id INT PRIMARY KEY AUTO_INCREMENT,
    numeroFolio VARCHAR(100),
    fecha DATE,
    productor VARCHAR(100),
    numeroInscripcion VARCHAR(100),
    numeroTarjeta VARCHAR(100),
    localidad VARCHAR(100),
    predio VARCHAR(100),
    noSello VARCHAR(100),
    campanasFitosanitarias VARCHAR(200),
    expedidoEn VARCHAR(100),
    fechaExpedicion DATE,
    diasVigencia INT,
    jlsvAutoriza VARCHAR(100),
    personalInspeccion VARCHAR(100),
    observaciones TEXT
);

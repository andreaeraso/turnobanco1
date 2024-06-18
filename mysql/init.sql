-- Crear la base de datos si no existe
CREATE DATABASE IF NOT EXISTS TurnosDB;
USE TurnosDB;

-- Crear la tabla de Clientes si no existe
CREATE TABLE IF NOT EXISTS Clientes (
    cedula VARCHAR(20) PRIMARY KEY,
    nombre VARCHAR(100)
);

-- Crear la tabla de Turnos si no existe
CREATE TABLE IF NOT EXISTS Turnos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cedula_cliente VARCHAR(20),
    servicio ENUM('Caja', 'Tramites', 'Asesor'),
    turno VARCHAR(10),
    estado ENUM('Pendiente', 'Atendido'),
    FOREIGN KEY (cedula_cliente) REFERENCES Clientes(cedula)
);

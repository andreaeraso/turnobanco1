<?php
$servername = "db";
$username = "root";
$password = "root_password";
$dbname = "TurnosDB";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}





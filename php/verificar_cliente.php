<?php
// Incluir archivo de configuración para conectar con la base de datos
include 'config.php';

// Obtener la cédula del parámetro GET
$cedula = $_GET['cedula'];

// Consultar la base de datos para obtener el nombre del cliente con la cédula proporcionada
$sql = "SELECT nombre FROM Clientes WHERE cedula='$cedula'";
$result = $conn->query($sql);

// Verificar si se encontró el cliente
if ($result->num_rows > 0) {
    // Obtener el nombre del cliente y convertirlo a formato JSON
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    // Si no se encuentra el cliente, devolver un JSON con un nombre vacío
    echo json_encode(["nombre" => ""]);
}
?>


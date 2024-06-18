<?php
// Incluir el archivo de configuración para establecer la conexión a la base de datos
include 'config.php';

// Inicializar arrays para almacenar los turnos pendientes y atendidos
$pendientes = [];
$atendidos = [];

// Consulta para obtener los turnos pendientes y los nombres de los clientes correspondientes
$sql = "SELECT t.turno, c.nombre FROM Turnos t JOIN Clientes c ON t.cedula_cliente = c.cedula WHERE t.estado='Pendiente'";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    // Almacenar cada resultado en el array de pendientes
    $pendientes[] = $row;
}

// Consulta para obtener los turnos atendidos y los nombres de los clientes correspondientes
$sql = "SELECT t.turno, c.nombre FROM Turnos t JOIN Clientes c ON t.cedula_cliente = c.cedula WHERE t.estado='Atendido'";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    // Almacenar cada resultado en el array de atendidos
    $atendidos[] = $row;
}

// Convertir los arrays de turnos pendientes y atendidos a formato JSON
// Esto permite enviar los datos de manera estructurada y legible a otras aplicaciones o servicios
echo json_encode(['pendientes' => $pendientes, 'atendidos' => $atendidos]);
?>


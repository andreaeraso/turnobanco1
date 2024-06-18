<?php
// Incluir el archivo de configuración para establecer la conexión a la base de datos
include 'config.php';

// Inicializar un array para almacenar los turnos
$turnos = ['caja' => '', 'tramites' => '', 'asesor' => ''];

// Consulta para obtener el siguiente turno pendiente en el servicio de "Caja"
$sql = "SELECT turno FROM Turnos WHERE servicio='Caja' AND estado='Pendiente' ORDER BY id ASC LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // Si hay resultados, obtener el turno y almacenarlo en el array
    $row = $result->fetch_assoc();
    $turnos['caja'] = $row['turno'];
}

// Consulta para obtener el siguiente turno pendiente en el servicio de "Tramites"
$sql = "SELECT turno FROM Turnos WHERE servicio='Tramites' AND estado='Pendiente' ORDER BY id ASC LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // Si hay resultados, obtener el turno y almacenarlo en el array
    $row = $result->fetch_assoc();
    $turnos['tramites'] = $row['turno'];
}

// Consulta para obtener el siguiente turno pendiente en el servicio de "Asesor"
$sql = "SELECT turno FROM Turnos WHERE servicio='Asesor' AND estado='Pendiente' ORDER BY id ASC LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // Si hay resultados, obtener el turno y almacenarlo en el array
    $row = $result->fetch_assoc();
    $turnos['asesor'] = $row['turno'];
}

// Convertir el array de turnos a formato JSON y mostrarlo
echo json_encode($turnos);
?>


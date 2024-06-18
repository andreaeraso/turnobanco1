<?php
include 'config.php';

$servicios = ['Caja', 'Trámites', 'Asesor'];
$resultado = [];

foreach ($servicios as $servicio) {
    $sql = "SELECT turno FROM Turnos WHERE servicio='$servicio' AND estado='Pendiente' ORDER BY id ASC LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $resultado[strtolower($servicio)] = $row['turno'];
    } else {
        $resultado[strtolower($servicio)] = null;
    }
}

echo json_encode($resultado);
?>

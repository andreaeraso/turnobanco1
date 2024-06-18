<?php
include 'config.php';

if (isset($_POST['turno']) && isset($_POST['servicio'])) {
    $turno = $_POST['turno'];
    $servicio = $_POST['servicio'];

    $sql = "UPDATE Turnos SET estado='Atendido' WHERE turno='$turno' AND servicio='$servicio'";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Datos incompletos']);
}
?>

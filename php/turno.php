<?php
// Incluir el archivo de configuración para establecer la conexión a la base de datos
include 'config.php';

// Verificar si el método de la solicitud es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos enviados por el formulario
    $cedula = $_POST["cedula"];
    $servicio = $_POST["servicio"];

    // Obtener el último turno para el servicio seleccionado
    $sql = "SELECT turno FROM Turnos WHERE servicio='$servicio' ORDER BY id DESC LIMIT 1";
    $result = $conn->query($sql);
    $ultimo_turno = 0;

    // Si hay resultados, obtener el último turno y extraer el número
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $ultimo_turno = (int) substr($row["turno"], 1);
    }

    // Generar el nuevo turno incrementando el número del último turno
    $nuevo_turno = $servicio[0] . ($ultimo_turno + 1);

    // Insertar el nuevo turno en la base de datos
    $sql = "INSERT INTO Turnos (cedula_cliente, servicio, turno, estado) VALUES ('$cedula', '$servicio', '$nuevo_turno', 'Pendiente')";
    $conn->query($sql);

    // Redirigir al usuario a la página de ver_turno con los parámetros de cédula y turno
    header("Location: ver_turno.php?cedula=$cedula&turno=$nuevo_turno");
    exit();
}
?>


<?php
include 'config.php'; // Incluye el archivo de configuración para la conexión a la base de datos

$cedula = $_GET['cedula']; // Obtiene el parámetro 'cedula' de la URL
$sql = "SELECT nombre FROM Clientes WHERE cedula='$cedula'"; // Define la consulta SQL para obtener el nombre del cliente con la cédula dada
$result = $conn->query($sql); // Ejecuta la consulta SQL

if ($result->num_rows > 0) { // Verifica si se encontró algún resultado
    $row = $result->fetch_assoc(); // Obtiene la fila resultante de la consulta
    $nombre = $row["nombre"]; // Asigna el nombre del cliente a la variable $nombre
} else {
    die("Cliente no encontrado"); // Si no se encuentra el cliente, muestra un mensaje de error y termina la ejecución del script
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Bienvenido</title>
    <!-- Incluye la hoja de estilo de FontAwesome para usar íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Estilos CSS para la apariencia de la página */
        body {
            background: url('turno6.jpg') no-repeat center center fixed; /* Imagen de fondo */
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            perspective: 1px;
            overflow-x: hidden;
            overflow-y: auto;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('turno6.jpg') no-repeat center center fixed;
            background-size: cover;
            transform: translateZ(-1px) scale(2);
            z-index: -1;
        }

        .container {
            text-align: center;
            background-color: #fff;
            padding: 60px;
            border-radius: 30px;
            box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.2);
            margin: 100px;
            animation: fadeIn 1s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .button-container {
            display: flex;
            justify-content: center;
            gap: 30px; /* Espacio entre los botones */
        }

        .button {
            width: 250px;
            height: 250px;
            background-color: #78CAD2;
            border: none;
            color: white;
            font-size: 72px;
            cursor: pointer;
            border-radius: 50%;
            transition: background-color 0.3s, transform 0.2s, box-shadow 0.3s;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .button:hover {
            background-color: #A1D2CE;
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        .button:active {
            transform: scale(0.95);
        }

        .button-label {
            margin-top: 30px;
            font-size: 30px;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Muestra un mensaje de bienvenida con el nombre del cliente -->
        <h2>Bienvenido <?php echo $nombre; ?>, ¿Qué deseas hacer hoy?</h2>
        <!-- Formulario para seleccionar el servicio deseado -->
        <form action="turno.php" method="POST">
            <input type="hidden" name="cedula" value="<?php echo $cedula; ?>"> <!-- Campo oculto para enviar la cédula -->
            <div class="button-container">
                <!-- Botón para el servicio de Caja -->
                <div>
                    <button class="button" name="servicio" value="Caja"><i class="fa fa-cash-register"></i></button>
                    <div class="button-label">Caja</div>
                </div>
                <!-- Botón para el servicio de Trámites -->
                <div>
                    <button class="button" name="servicio" value="Tramites"><i class="fa fa-file-alt"></i></button>
                    <div class="button-label">Trámites</div>
                </div>
                <!-- Botón para el servicio de Asesor -->
                <div>
                    <button class="button" name="servicio" value="Asesor"><i class="fa fa-user-tie"></i></button>
                    <div class="button-label">Asesor</div>
                </div>
            </div>
        </form>
    </div>
</body>
</html>


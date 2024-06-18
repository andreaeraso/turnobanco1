<?php
// Incluir archivo de configuración para conectar con la base de datos
include 'config.php';

// Obtener cédula y turno de los parámetros GET
$cedula = $_GET['cedula'];
$turno = $_GET['turno'];

// Consultar la base de datos para obtener el nombre del cliente con la cédula proporcionada
$sql = "SELECT nombre FROM Clientes WHERE cedula='$cedula'";
$result = $conn->query($sql);

// Verificar si se encontró el cliente
if ($result->num_rows > 0) {
    // Obtener el nombre del cliente
    $row = $result->fetch_assoc();
    $nombre = $row["nombre"];
} else {
    // Terminar el script si no se encuentra el cliente
    die("Cliente no encontrado");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu Turno</title>
    <!-- Incluir hojas de estilo de Font Awesome para los iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-Ky4s0rhWup6eBkiTPc7HL4YGBFAwunz15JSfjZpn6BK/yKRFLwBJ3f5t9tQrH7EP5qbuYXAS+3wuDr1r9x/vDw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        /* Estilos para el cuerpo de la página */
        body {
            background: url('turno6.jpg') no-repeat center center fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
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

        /* Estilos para el contenedor principal */
        .container {
            text-align: center;
            background-color: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            position: relative;
            overflow: hidden; /* Ocultar contenido fuera del contenedor */
            animation: slideIn 0.5s ease-out forwards; /* Animación para el deslizamiento */
            transform: translateY(100%); /* Empieza fuera de la vista */
            opacity: 0; /* Empieza invisible */
            margin-top: 20px; /* Ajuste para separar del borde superior */
        }

        /* Estilos para el borde en forma de tiquete */
        .container:before,
        .container:after {
            content: '';
            position: absolute;
            top: 0;
            width: 100%;
            height: 20px; /* Altura de la parte rasgada */
            background: #fff; /* Color de fondo */
        }

        .container:before {
            left: -10px; /* Desplazamiento izquierdo para la esquina */
            clip-path: polygon(0% 0%, 100% 0%, calc(100% - 10px) 100%, 0% 100%);
            transform: rotate(-2deg); /* Rotación para el rasgado */
        }

        .container:after {
            right: -10px; /* Desplazamiento derecho para la esquina */
            clip-path: polygon(10px 0%, 100% 0%, 100% 100%, 0% 100%);
            transform: rotate(2deg); /* Rotación para el rasgado */
        }

        /* Animación para el contenedor */
        @keyframes slideIn {
            0% {
                transform: translateY(100%);
                opacity: 0;
            }
            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Estilos para el icono */
        .icon {
            color: #007bff;
            font-size: 48px;
            margin-bottom: 20px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
            100% {
                transform: scale(1);
            }
        }

        /* Estilos para la información del turno */
        .info {
            font-size: 18px;
            margin-bottom: 15px;
        }

        .info i {
            margin-right: 10px;
        }

        /* Estilos para el encabezado */
        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        /* Estilos para el enlace */
        a {
            display: inline-block;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
            font-size: 16px;
            transition: color 0.3s, transform 0.3s;
        }

        a:hover {
            color: #0056b3;
            text-decoration: underline;
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <!-- Contenedor principal -->
    <div class="container">
        <!-- Icono de éxito -->
        <i class="fas fa-check-circle icon"></i>
        <!-- Mensaje de turno -->
        <h2>Tu turno es:</h2>
        <!-- Mostrar información del cliente y su turno -->
        <p class="info"><i class="fas fa-user"></i> Nombre: <?php echo $nombre; ?></p>
        <p class="info"><i class="fas fa-id-card"></i> Cédula: <?php echo $cedula; ?></p>
        <p class="info"><i class="fas fa-clock"></i> Turno: <?php echo $turno; ?></p>
        <!-- Enlace para volver al inicio -->
        <a href="index.php"><i class="fas fa-arrow-circle-left"></i> Volver a Inicio</a>
    </div>
</body>
</html>



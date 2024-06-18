<?php
include 'config.php'; // Incluye el archivo de configuración para la conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Verifica si el formulario ha sido enviado mediante POST
    $servicio = $_POST["servicio"]; // Obtiene el valor del servicio enviado desde el formulario

    // Consulta SQL para seleccionar el siguiente turno pendiente para el servicio seleccionado
    $sql = "SELECT id, turno FROM Turnos WHERE servicio='$servicio' AND estado='Pendiente' ORDER BY id ASC LIMIT 1";
    $result = $conn->query($sql); // Ejecuta la consulta

    if ($result->num_rows > 0) { // Verifica si hay resultados
        $row = $result->fetch_assoc(); // Obtiene la fila resultante
        $turno_id = $row["id"]; // Obtiene el ID del turno
        $turno = $row["turno"]; // Obtiene el número del turno

        // Consulta SQL para actualizar el estado del turno a 'Atendido'
        $sql_update = "UPDATE Turnos SET estado='Atendido' WHERE id='$turno_id'";
        $conn->query($sql_update); // Ejecuta la consulta de actualización

        // Genera un script de JavaScript para anunciar el turno y luego redirigir a la página de administración
        echo '<script>
                function anunciarYRedirigir() {
                    var synthesis = window.speechSynthesis; // Accede a la síntesis de voz del navegador
                    var utterance = new SpeechSynthesisUtterance("Siguiente turno:  para ' . $servicio . '"); // Crea un mensaje de voz
                    utterance.onend = function() { // Define lo que ocurre al terminar de hablar
                        window.location.href = "administrar_turnos.php"; // Redirige a la página de administración
                    };
                    synthesis.speak(utterance); // Reproduce el mensaje de voz
                }
                anunciarYRedirigir(); // Llama a la función para anunciar el turno y redirigir
              </script>';
        exit(); // Termina la ejecución del script PHP
    } else {
        echo '<script>alert("No hay turnos pendientes para este servicio."); window.location.href = "administrar_turnos.php";</script>';
        exit(); // Termina la ejecución del script PHP
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Administrar Turnos</title>
    <!-- Incluye las hojas de estilo de FontAwesome para los íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-Ky4s0rhWup6eBkiTPc7HL4YGBFAwunz15JSfjZpn6BK/yKRFLwBJ3f5t9tQrH7EP5qbuYXAS+3wuDr1r9x/vDw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Estilos CSS para la apariencia de la página */
        body {
            background: url('turno6.jpg') no-repeat center center fixed; /* Imagen de fondo */
            background-size: cover; /* Ajusta la imagen de fondo para cubrir toda la pantalla */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            overflow: hidden; /* Oculta cualquier contenido que se desborde */
            position: relative; /* Establece posición relativa para animaciones */
        }

        @keyframes moveBackground {
            0% { background-position: center center; }
            50% { background-position: center 10%; }
            100% { background-position: center center; }
        }

        /* Aplica la animación a la imagen de fondo */
        body::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('turno6.jpg');
            background-size: cover;
            z-index: -1;
            animation: moveBackground 10s infinite alternate; /* Animación de vaivén */
        }

        .container {
            text-align: center;
            background-color: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            z-index: 1;
        }
        .container h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .button-container {
            display: flex;
            justify-content: center;
            gap: 20px; /* Espacio entre los botones */
        }
        .button {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 200px;
            padding: 15px;
            background-color: #78CAD2;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s, transform 0.2s;
            overflow: hidden;
            position: relative;
        }
        .button:hover {
            background-color: #A1D2CE;
            transform: scale(1.1);
        }
        .button i {
            margin-right: 10px;
        }
        .button::before {
            content: "";
            position: absolute;
            background-color: rgba(255, 255, 255, 0.2);
            width: 100%;
            height: 100%;
            top: 0;
            left: -100%;
            transition: left 0.3s;
            z-index: 0;
        }
        .button:hover::before {
            left: 0;
        }
        .button span {
            position: relative;
            z-index: 1;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Administrar Turnos</h2>
        <!-- Formulario con botones para seleccionar el servicio -->
        <form method="POST">
            <div class="button-container">
                <button class="button" name="servicio" value="Caja">
                    <i class="fas fa-cash-register"></i> <span>Siguiente Caja</span>
                </button>
                <button class="button" name="servicio" value="Tramites">
                    <i class="fas fa-file-alt"></i> <span>Siguiente Trámites</span>
                </button>
                <button class="button" name="servicio" value="Asesor">
                    <i class="fas fa-user-tie"></i> <span>Siguiente Asesor</span>
                </button>
            </div>
        </form>
    </div>

    <?php
    include 'config.php'; // Incluye el archivo de configuración para la conexión a la base de datos

    if ($_SERVER["REQUEST_METHOD"] == "POST") { // Verifica si el formulario ha sido enviado mediante POST
        $servicio = $_POST["servicio"]; // Obtiene el valor del servicio enviado desde el formulario

        // Consulta SQL para seleccionar el siguiente turno pendiente para el servicio seleccionado
        $sql = "SELECT id, turno FROM Turnos WHERE servicio='$servicio' AND estado='Pendiente' ORDER BY id ASC LIMIT 1";
        $result = $conn->query($sql); // Ejecuta la consulta

        if ($result->num_rows > 0) { // Verifica si hay resultados
            $row = $result->fetch_assoc(); // Obtiene la fila resultante
            $turno_id = $row["id"]; // Obtiene el ID del turno
            $turno = $row["turno"]; // Obtiene el número del turno

            // Consulta SQL para actualizar el estado del turno a 'Atendido'
            $sql_update = "UPDATE Turnos SET estado='Atendido' WHERE id='$turno_id'";
            $conn->query($sql_update); // Ejecuta la consulta de actualización

            // Genera un script de JavaScript para anunciar el turno y luego redirigir a la página de administración
            echo '<script>
                    function anunciarYRedirigir() {
                        var synthesis = window.speechSynthesis; // Accede a la síntesis de voz del navegador
                        var utterance = new SpeechSynthesisUtterance("Siguiente turno:  para ' . $servicio . '"); // Crea un mensaje de voz
                        utterance.onend = function() { // Define lo que ocurre al terminar de hablar
                            window.location.href = "administrar_turnos.php"; // Redirige a la página de administración
                        };
                        synthesis.speak(utterance); // Reproduce el mensaje de voz
                    }
                    anunciarYRedirigir(); // Llama a la función para anunciar el turno y redirigir
                  </script>';
            exit(); // Termina la ejecución del script PHP
        } else {
            echo '<script>alert("No hay turnos pendientes para este servicio."); window.location.href = "administrar_turnos.php";</script>';
            exit(); // Termina la ejecución del script PHP
        }
    }
    ?>
</body>
</html>

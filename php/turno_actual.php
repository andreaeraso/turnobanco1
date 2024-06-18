<!DOCTYPE html>
<html>
<head>
    <title>Turno Actual</title>
    <!-- Incluir las hojas de estilo de Font Awesome para los iconos -->
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
            padding: 20px;
            box-sizing: border-box;
        }
        /* Estilos para el contenedor principal */
        .main-container {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            width: 100%;
            max-width: 1400px;
            gap: 40px;
        }
        /* Estilos para los contenedores individuales */
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.2);
        }
        .turno-container {
            flex: 1; /* Reducir el tamaño del contenedor de turnos */
        }
        .video-container {
            flex: 3; /* Aumentar el tamaño del contenedor de video */
        }
        /* Estilos para la tabla */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 20px; /* Aumentar el tamaño de la fuente */
        }
        th, td {
            padding: 15px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #f4f4f4;
            font-size: 28px; /* Aumentar el tamaño de la fuente */
        }
        td i {
            margin-right: 10px;
            font-size: 28px; /* Aumentar el tamaño del ícono */
        }
        .turno {
            font-size: 28px; /* Aumentar el tamaño de la fuente */
            font-weight: bold;
            color: #007bff;
        }

        /* Animación para cambio de turno */
        @keyframes flash {
            0% { background-color: #007bff; color: #fff; }
            100% { background-color: transparent; color: #007bff; }
        }

        .flash {
            animation: flash 0.5s ease-in-out;
        }
    </style>
</head>
<body>
    <!-- Contenedor principal -->
    <div class="main-container">
        <!-- Contenedor de turnos actuales -->
        <div class="container turno-container">
            <h2 style="text-align: center; font-size: 32px;">Turno Actual</h2> <!-- Aumentar el tamaño del título -->
            <table>
                <thead>
                    <tr>
                        <th>Servicio</th>
                        <th>Turno</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><i class="fas fa-cash-register"></i> Caja</td>
                        <td id="turno_caja" class="turno"></td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-file-alt"></i> Trámites</td>
                        <td id="turno_tramites" class="turno"></td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-user-tie"></i> Asesor</td>
                        <td id="turno_asesor" class="turno"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Contenedor de video -->
        <div class="container video-container">
            <video width="100%" height="auto" autoplay loop muted>
                <source src="video.mp4" type="video/mp4">
                Tu navegador no soporta el elemento de video.
            </video>
        </div>
    </div>
    <script>
        // Función para cargar el turno actual desde el servidor
        function cargarTurnoActual() {
            fetch('obtener_turno_actual.php')
                .then(response => response.json())
                .then(data => {
                    actualizarTurno('turno_caja', data.caja);
                    actualizarTurno('turno_tramites', data.tramites);
                    actualizarTurno('turno_asesor', data.asesor);
                });
        }

        // Función para actualizar el contenido del turno con animación
        function actualizarTurno(id, nuevoTurno) {
            const elemento = document.getElementById(id);
            if (elemento.textContent !== nuevoTurno) {
                elemento.textContent = nuevoTurno;
                elemento.classList.add('flash');
                setTimeout(() => {
                    elemento.classList.remove('flash');
                }, 500); // Duración de la animación en milisegundos
            }
        }

        // Configurar la recarga automática de los turnos cada 5 segundos
        setInterval(cargarTurnoActual, 5000);

        // Cargar el turno actual cuando la página se haya cargado completamente
        window.onload = cargarTurnoActual;
    </script>
</body>
</html>





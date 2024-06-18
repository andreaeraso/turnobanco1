<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turnos Pendientes y Atendidos</title>
    <!-- Incluir hojas de estilo de Font Awesome para los iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-Ky4s0rhWup6eBkiTPc7HL4YGBFAwunz15JSfjZpn6BK/yKRFLwBJ3f5t9tQrH7EP5qbuYXAS+3wuDr1r9x/vDw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Estilos generales */
        body {
            background: url('turno6.jpg') no-repeat center center fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            max-width: 1000px;
            background-color: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            overflow: hidden; /* Evitar desbordamiento */
        }
        .column {
            width: 45%;
            padding: 20px;
            overflow-y: auto; /* Scroll vertical */
            max-height: 70vh; /* Altura máxima */
            background-color: #f5f5f5;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .column h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .column h2 i {
            margin-right: 10px;
            color: #78CAD2;
        }
        ul {
            padding: 0;
            list-style-type: none;
            margin: 0;
        }
        li {
            background-color: #ffffff;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
        }
        li i {
            margin-right: 10px;
            color: #007bff;
        }
        /* Animaciones */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        @keyframes fadeInListItem {
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="column">
            <h2><i class="fas fa-hourglass-half"></i> Turnos Pendientes</h2>
            <ul id="pendientes">
                <!-- Turnos pendientes se cargarán aquí -->
            </ul>
        </div>
        <div class="column">
            <h2><i class="fas fa-check-circle"></i> Turnos Atendidos</h2>
            <ul id="atendidos">
                <!-- Turnos atendidos se cargarán aquí -->
            </ul>
        </div>
    </div>
    <script>
        // Función para cargar los turnos desde el servidor
        function cargarTurnos() {
            fetch('obtener_turnos.php')
                .then(response => response.json())
                .then(data => {
                    const pendientes = document.getElementById('pendientes');
                    const atendidos = document.getElementById('atendidos');

                    // Limpiar el contenido actual de las listas
                    pendientes.innerHTML = '';
                    atendidos.innerHTML = '';

                    // Añadir turnos pendientes a la lista
                    data.pendientes.forEach(turno => {
                        const li = document.createElement('li');
                        li.innerHTML = `<i class="fas fa-hourglass-start"></i>${turno.turno} - ${turno.nombre}`;
                        pendientes.appendChild(li);
                    });

                    // Añadir turnos atendidos a la lista
                    data.atendidos.forEach(turno => {
                        const li = document.createElement('li');
                        li.innerHTML = `<i class="fas fa-check"></i>${turno.turno} - ${turno.nombre}`;
                        atendidos.appendChild(li);
                    });

                    // Aplicar animación a los elementos de lista
                    const listItems = document.querySelectorAll('li');
                    listItems.forEach((item, index) => {
                        item.style.animationDelay = `${index * 0.1}s`;
                    });
                });
        }

        // Configurar la recarga automática de los turnos cada 5 segundos
        setInterval(cargarTurnos, 5000);
        // Cargar los turnos cuando la página se haya cargado completamente
        window.onload = cargarTurnos;
    </script>
</body>
</html>

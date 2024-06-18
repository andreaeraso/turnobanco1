<?php
// Incluir el archivo de configuración para establecer la conexión a la base de datos
include 'config.php';

// Verificar si el método de la solicitud es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos enviados por el formulario
    $cedula = $_POST["cedula"];
    $nombre = $_POST["nombre"];

    // Consulta para verificar si el cliente ya existe en la base de datos
    $sql = "SELECT * FROM Clientes WHERE cedula='$cedula'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Si el cliente ya existe, obtener su nombre
        $row = $result->fetch_assoc();
        $nombre = $row["nombre"];
    } else {
        // Si el cliente no existe, insertar un nuevo registro en la base de datos
        $sql = "INSERT INTO Clientes (cedula, nombre) VALUES ('$cedula', '$nombre')";
        $conn->query($sql);
    }

    // Redirigir al usuario a la página de bienvenida con la cédula como parámetro
    header("Location: bienvenido.php?cedula=$cedula");
    exit(); // Asegúrate de salir después de enviar el encabezado de redirección
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
    <!-- Incluir las hojas de estilo de Font Awesome para los iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-Ky4s0rhWup6eBkiTPc7HL4YGBFAwunz15JSfjZpn6BK/yKRFLwBJ3f5t9tQrH7EP5qbuYXAS+3wuDr1r9x/vDw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Estilos para la página */
        body {
            background: url('turno6.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .form-container {
            text-align: center;
            background-color: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        .form-container h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .form-container form {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }
        .form-container label {
            margin-bottom: 10px;
            color: #333;
            font-weight: bold;
            display: flex;
            align-items: center;
        }
        .form-container label i {
            margin-right: 10px;
        }
        .form-container input[type="text"] {
            width: calc(100% - 20px);
            margin-bottom: 20px;
            border: none;
            border-bottom: 2px solid #ccc;
            font-size: 16px;
            padding: 5px 0;
            background: transparent;
            outline: none;
            transition: border-color 0.3s;
        }
        .form-container input[type="text"]:focus {
            border-color: #78CAD2;
        }
        .form-container input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #78CAD2;
            border: none;
            color: white;
            font-size: 18px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s, transform 0.2s;
        }
        .form-container input[type="submit"]:hover {
            background-color: #A1D2CE;
        }
        .form-container input[type="submit"]:active {
            transform: scale(0.95);
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Ingrese sus datos <i class="fas fa-user-edit"></i></h2>
        <!-- Formulario para el registro de clientes -->
        <form method="POST">
            <label for="cedula"><i class="fas fa-id-card"></i> Cédula:</label>
            <input type="text" id="cedula" name="cedula" required>
            <label for="nombre"><i class="fas fa-user"></i> Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
            <input type="submit" value="Registrar">
        </form>
    </div>
    <script>
    // Agregar un evento blur al campo de cédula para verificar el cliente en la base de datos
    document.getElementById('cedula').addEventListener('blur', function() {
        // Obtener el valor ingresado en el campo de cédula
        var cedula = this.value;
        // Verificar si se ha ingresado un valor en el campo de cédula
        if (cedula) {
            // Realizar una solicitud fetch para enviar la cédula al servidor para verificar el cliente
            fetch('verificar_cliente.php?cedula=' + cedula)
                // Convertir la respuesta a formato JSON
                .then(response => response.json())
                // Manipular los datos obtenidos
                .then(data => {
                    // Si se encuentra el cliente en la base de datos
                    if (data.nombre) {
                        // Rellenar el campo de nombre con el nombre del cliente obtenido de la base de datos
                        document.getElementById('nombre').value = data.nombre;
                    }
                });
        }
    });
    </script>
</body>
</html>


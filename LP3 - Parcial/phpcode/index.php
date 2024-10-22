<?php 
include 'conectarBD.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            padding: 20px;
        }
        .form-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 800px; /* Aumentado para más espacio */
            margin: 0 auto;
            padding: 20px;
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #7a4b45;
        }
        .form-container label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }
        .form-container input[type="text"], 
        .form-container input[type="email"], 
        .form-container textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .form-container button {
            background-color: #7a4b45;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        .form-container button:hover {
            background-color: #5e3c37;
        }
        .form-container .message {
            text-align: center;
            color: #d9534f;
        }
        .form-container hr {
            margin: 40px 0;
        }
        .table-container {
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px; /* Espacio entre el formulario y la tabla */
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #7a4b45;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #e2e2e2;
        }
        
.nav-button {
    display: inline-block; /* Hace que el enlace se comporte como un bloque en línea */
    margin: 0 10px; /* Espacio entre botones */
    padding: 10px 20px;
    background-color: white;
    color: #9b8181; /* Color del texto */
    text-decoration: none; /* Sin subrayado */
    border-radius: 5px; /* Bordes redondeados */
    border: 1px solid #9b8181; /* Borde del botón */
    transition: background-color 0.3s; /* Transición para el hover */
}
    </style>
    <script>
        function validarFormulario() {
            const nombre = document.getElementById('nombre').value.trim();
            const apellido = document.getElementById('apellido').value.trim();
            const mail = document.getElementById('mail').value.trim();
            const chat = document.getElementById('chat').value.trim();

            // Expresiones regulares para validar que no contenga números
            const soloLetras = /^[A-Za-záéíóúÁÉÍÓÚñÑ ]+$/;

            // Verificación de campos vacíos
            if (nombre === "") {
                alert('El nombre no puede estar vacío.');
                return false; // No envía el formulario
            }
            if (apellido === "") {
                alert('El apellido no puede estar vacío.');
                return false; // No envía el formulario
            }
            if (mail === "") {
                alert('El correo electrónico no puede estar vacío.');
                return false; // No envía el formulario
            }
            if (chat === "") {
                alert('El mensaje no puede estar vacío.');
                return false; // No envía el formulario
            }

            // Validar que nombre y apellido solo contengan letras
            if (!soloLetras.test(nombre)) {
                alert('El nombre solo debe contener letras.');
                return false; // No envía el formulario
            }
            if (!soloLetras.test(apellido)) {
                alert('El apellido solo debe contener letras.');
                return false; // No envía el formulario
            }

            return true; // Envía el formulario
        }
    </script>
</head>
<body>

<div class="form-container">
 <!-- Tabla para mostrar datos -->
 <div class="table-container">
        <h3>Lista de Personas</h3>
        <?php
        // Consulta para obtener los datos de la tabla persona
        $query = "SELECT * FROM persona";
        $result = mysqli_query($conexion, $query);

        // Verificar si hay resultados
        if (mysqli_num_rows($result) > 0) {
            // Mostrar los resultados en una tabla
            echo "<table>";
            echo "<tr><th>ID</th><th>Nombre</th><th>Apellido</th><th>Email</th><th>Chat</th></tr>";

            // Recorrer cada fila de resultado
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['idpersona'] . "</td>";
                echo "<td>" . $row['nombre'] . "</td>";
                echo "<td>" . $row['apellido'] . "</td>";
                echo "<td>" . $row['mail'] . "</td>";
                echo "<td>" . $row['chat'] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<p>No hay resultados en la base de datos.</p>";
        }
        ?>
    </div>

    <h2>Formulario para procesar</h2>

    <!-- Formulario para Insertar -->
    <form action="procesar.php" method="post" onsubmit="return validarFormulario();">
        <h3>Insertar Datos</h3>
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required>

        <label for="mail">Correo electrónico:</label>
        <input type="email" id="mail" name="mail" required>

        <label for="chat">Mensaje:</label>
        <textarea id="chat" name="chat" rows="4" required></textarea>

        <button type="submit" name="insertar">Insertar</button>
    </form>

    <hr>

    <!-- Formulario para Editar -->
    <form action="procesar.php" method="post" onsubmit="return validarFormulario();">
        <h3>Editar Datos</h3>
        <label for="id">ID del registro a modificar:</label>
        <input type="text" id="id" name="id" required>

        <label for="nombreEditar">Nombre:</label>
        <input type="text" id="nombreEditar" name="nombre" required>

        <label for="apellidoEditar">Apellido:</label>
        <input type="text" id="apellidoEditar" name="apellido" required>

        <label for="mailEditar">Correo electrónico:</label>
        <input type="email" id="mailEditar" name="mail" required>

        <label for="chatEditar">Mensaje:</label>
        <textarea id="chatEditar" name="chat" rows="4" required></textarea>

        <button type="submit" name="EnviarEditar">Editar</button>
    </form>

    <hr>

    <!-- Formulario para Borrar -->
    <form action="procesar.php" method="post">
        <h3>Borrar Datos</h3>
        <label for="idBorrar">ID del registro a eliminar:</label>
        <input type="text" id="idBorrar" name="id" required>

        <button type="submit" name="EnviarBorrar">Borrar</button>
    </form>

    <hr>
    <a href="http://localhost/LP3%20-%20Parcial/menu/" class="nav-button">Volver al menu principal</a>
</div>

</body>
</html>

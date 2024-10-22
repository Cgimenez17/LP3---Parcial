<?php
include 'conectarBD.php';
if (!$conexion) {
    die("Error al conectar a la base de datos: " . mysqli_connect_error());
} else {
    echo "Conexión exitosa a la base de datos.<br>";
}

if (isset($_POST['insertar'])) {
    if (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['mail']) && isset($_POST['chat'])) {
        $existe = true;
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $mail = $_POST['mail'];
        $chat = $_POST['chat'];

        echo "Datos recibidos para insertar:<br>";
        echo "Nombre: $nombre, Apellido: $apellido, Correo: $mail, Chat: $chat<br>";
    } else {
        $existe = false;
        echo "Debes completar todos los campos. Faltan los siguientes:<br>";
        if (!isset($_POST['nombre'])) echo "Nombre<br>";
        if (!isset($_POST['apellido'])) echo "Apellido<br>";
        if (!isset($_POST['mail'])) echo "Correo electrónico<br>";
        if (!isset($_POST['chat'])) echo "Mensaje<br>";
    }

    if ($existe) {
        $query = "INSERT INTO persona (nombre, apellido, mail, chat) VALUES ('$nombre', '$apellido', '$mail', '$chat')";
        echo "Consulta SQL a ejecutar: $query<br>";

        $result = mysqli_query($conexion, $query);

        if ($result) {
            echo "La inserción fue exitosa.<br>";
            ?>
            <meta http-equiv="refresh" content="3; url=http://localhost/LP3%20-%20Parcial/phpcode/index.php">
            <?php
        } else {
            echo "Problemas para insertar: " . mysqli_error($conexion) . "<br>";
        }
    }
} else if (isset($_POST['EnviarEditar'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $mail = $_POST['mail'];
    $chat = $_POST['chat'];

    // Verificar si el ID existe
    $query_check = "SELECT * FROM persona WHERE idpersona = $id";
    $result_check = mysqli_query($conexion, $query_check);

    if (mysqli_num_rows($result_check) > 0) {
        echo "Datos recibidos para actualizar: ID: $id, Nombre: $nombre, Apellido: $apellido, Mail: $mail, Chat: $chat<br>";

        $query_editar = "UPDATE persona SET nombre='$nombre', apellido='$apellido', mail='$mail', chat='$chat' WHERE idpersona=$id";
        echo "Consulta SQL a ejecutar para actualizar: $query_editar<br>";

        $result_editar = mysqli_query($conexion, $query_editar);

        if ($result_editar) {
            echo "La modificación fue exitosa.<br>";
            ?>
            <meta http-equiv="refresh" content="3; url=http://localhost/LP3%20-%20Parcial/phpcode/index.php">
            <?php
        } else {
            echo "No se pudo modificar: " . mysqli_error($conexion) . "<br>";
        }
    } else {
        echo "No se encontró un registro con el ID $id.<br>";
    }
} else if (isset($_POST['EnviarBorrar'])) {
    $id = $_POST['id'];

    // Verificar si el ID existe
    $query_check = "SELECT * FROM persona WHERE idpersona = $id";
    $result_check = mysqli_query($conexion, $query_check);

    if (mysqli_num_rows($result_check) > 0) {
        echo "ID a eliminar: $id<br>";

        $query_borrar = "DELETE FROM persona WHERE idpersona=$id";
        echo "Consulta SQL a ejecutar para borrar: $query_borrar<br>";

        $result_borrar = mysqli_query($conexion, $query_borrar);

        if ($result_borrar) {
            echo "Se eliminó correctamente.<br>";
            ?>
            <meta http-equiv="refresh" content="3; url=http://localhost/LP3%20-%20Parcial/phpcode/index.php">
            <?php
        } else {
            echo "Problemas para eliminar: " . mysqli_error($conexion) . "<br>";
            
        }
    } else {
        echo "No se encontró un registro con el ID $id.<br>";
        ?>
            <meta http-equiv="refresh" content="3; url=http://localhost/LP3%20-%20Parcial/phpcode/index.php">
            <?php
    }
}
?>

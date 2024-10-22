<?php
/*
    conexion php con mysql
*/

// establecer variables del servidor de bd
$vhost = 'localhost';
$vuser = 'root';
$vpass = 'sql$';
$vbd = 'devParcial';

$conexion = mysqli_connect($vhost, $vuser, $vpass, $vbd);

if(mysqli_connect_errno()){
    echo "La conexión a la base de datos no se pudo establecer, mirar el error: ".mysqli_connect_errno();
}else{
    echo "Conexión a $vbd fue exitosa.";
}


?>
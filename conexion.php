 <?php

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "proyecto";

$conexion = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

?>
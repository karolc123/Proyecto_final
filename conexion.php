<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "proyecto";

$conexion = mysqli_connect('localhost', 'root', '', 'proyecto');

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Recibir datos del formulario
$cedula = $_POST['cedula'];
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];

// Insertar datos en la base de datos
$sql = "INSERT INTO clientes (cedula, nombre, `e-mail`, telefono, direccion)
        VALUES ('$cedula', '$nombre', '$email', '$telefono', '$direccion')";

if ($conexion->query($sql) === TRUE) {
    echo "Cliente guardado correctamente.";
} else {
    echo "Error al guardar el estudiante: " . $conexion->error;
}

$conexion->close();

?>

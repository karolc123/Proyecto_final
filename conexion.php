<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Content-Type: application/json");

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

// Recibir datos del formulario
$data = json_decode(file_get_contents("php://input"));

$cedula = $data->cedula;
$nombre = $data->nombre;
$email = $data->email;
$telefono = $data->telefono;
$direccion = $data->direccion;
$tipo = $data->tipo;

if(!empty($cedula) && !empty($nombre) &&
!empty($email) && !empty($telefono) && 
!empty($direccion) && !empty($tipo)){
    // Insertar datos en la base de datos
    $sql = "INSERT INTO clientes (cedula, nombre, email, telefono, direccion, tipo)
            VALUES ('$cedula', '$nombre', '$email', '$telefono', '$direccion', '$tipo')";

    if ($conexion->query($sql) === TRUE) {
        echo json_encode(["message" => "Cliente guardado correctamente."]);
    } else {
        echo json_encode(["message" => "Error al guardar el cliente: " . $conexion->error]);
    }
}
$conexion->close();
?>

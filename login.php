<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Content-Type: application/json");

// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

// Obtener los datos JSON enviados desde React
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['cedula'], $data['contraseña'])) {
    $cedula = $conexion->real_escape_string($data['cedula']);
    $contraseña = $conexion->real_escape_string($data['contraseña']);

    // Consultar la base de datos para verificar las credenciales
    $sql = "SELECT * FROM clientes WHERE cedula='$cedula' AND contraseña='$contraseña'";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        echo json_encode(array("message" => "Inicio de sesión exitoso.", "tipo" => $user['tipo']));
    } else {
        echo json_encode(array("error" => "Credenciales incorrectas."));
    }
} else {
    echo json_encode(array("error" => "No se recibieron todos los datos esperados"));
}

$conexion->close();
?>

<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Content-Type: application/json");

// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

// Obtener los datos JSON enviados desde React
$data = json_decode(file_get_contents("php://input"), true);

// Verificar que todos los campos requeridos estén presentes
if (isset($data['cedula'], $data['nombre'], $data['email'], $data['telefono'], $data['direccion'], $data['contraseña'], $data['tipo'])) {
    $cedula = $conexion->real_escape_string($data['cedula']);
    $nombre = $conexion->real_escape_string($data['nombre']);
    $email = $conexion->real_escape_string($data['email']);
    $telefono = $conexion->real_escape_string($data['telefono']);
    $direccion = $conexion->real_escape_string($data['direccion']);
    $contraseña = $conexion->real_escape_string($data['contraseña']);
    $tipo = $conexion->real_escape_string($data['tipo']);

    // Preparar la consulta SQL

    if ($cedula == "") {
        
    }else{

        $sql = "INSERT INTO clientes (cedula, nombre, email, telefono, direccion, contraseña, tipo)
            VALUES ('$cedula', '$nombre', '$email', '$telefono', '$direccion','$contraseña', '$tipo')";

        // Ejecutar la consulta y verificar si fue exitosa
        if ($conexion->query($sql) === TRUE) {
            echo json_encode(array("message" => "Cliente guardado correctamente."));
        } else {
            echo json_encode(array("error" => "Error al guardar el cliente: " . $conexion->error));
        }

    }

    
} else {
    echo json_encode(array("error" => "No se recibieron todos los datos esperados"));
}

$conexion->close();
?>

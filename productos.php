<?php
// Configurar los encabezados para manejar solicitudes JSON
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Content-Type: application/json");

// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

// Obtener los datos JSON enviados desde React
$data = json_decode(file_get_contents("php://input"), true);

// Verificar que todos los campos requeridos estén presentes
if (isset($data['nombre'], $data['descripcion'], $data['precio'], $data['cantidad'], $_FILES['imagen'])) {
    $nombre = $conexion->real_escape_string($data['nombre']);
    $descripcion = $conexion->real_escape_string($data['descripcion']);
    $precio = $conexion->real_escape_string($data['precio']);
    $cantidad = $conexion->real_escape_string($data['cantidad']);
    $imagen = $conexion->real_escape_string($_FILES['imagen']);

    // Preparar la consulta SQL
    $sql = "INSERT INTO productos (nombre, descripcion, precio, cantidad, imagen) 
            VALUES ('$nombre', '$descripcion', '$precio', '$cantidad', '$imagen')";

    // Ejecutar la consulta y verificar si fue exitosa
    if ($conexion->query($sql) === TRUE) {
        echo json_encode(array("message" => "Producto insertado correctamente"));
    } else {
        echo json_encode(array("error" => "Error al insertar producto: " . $conexion->error));
    }
} else {
    echo json_encode(array("error" => "No se recibieron todos los datos esperados"));
}
?>



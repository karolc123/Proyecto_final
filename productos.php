<?php
// Configurar los encabezados para manejar solicitudes JSON y CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Content-Type: application/json");

// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

// Verificar si el método de la solicitud es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") 
    // Directorio donde se guardarán las imágenes
    $targetDir = "uploads/";

    // Verificar que el directorio exista, si no, crear uno nuevo
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    // Verificar si el archivo fue cargado sin errores
    if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0) {
        $fileName = basename($_FILES["imagen"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Extensiones permitidas
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
        if (in_array($fileType, $allowTypes)) {
            // Subir archivo al servidor
            if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $targetFilePath)) {
                $imagen = $targetFilePath; // Ruta relativa de la imagen guardada
            } else {
                echo json_encode(array("error" => "Error al subir la imagen."));
                exit();
            }
        } else {
            echo json_encode(array("error" => "Solo se permiten archivos JPG, JPEG, PNG, GIF, y PDF."));
            exit();
        }
    } else {
        echo json_encode(array("error" => "No se recibió ninguna imagen o hubo un error al cargarla."));
        exit();
    }

    // Obtener los datos del formulario
    $nombre = $conexion->real_escape_string($_POST['nombre']);
    $descripcion = $conexion->real_escape_string($_POST['descripcion']);
    $precio = $conexion->real_escape_string($_POST['precio']);
    $cantidad = $conexion->real_escape_string($_POST['cantidad']);

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
    echo json_encode(array("error" => "Solicitud no válida"));
}
?>

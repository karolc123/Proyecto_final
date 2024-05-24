<?php
session_start();

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Content-Type: application/json");

// Obtener los datos JSON enviados desde React
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

if (isset($data['id'], $data['nombre'], $data['precio'], $data['cantidad'], $data['imagen'])) {
    $producto = [
        "id" => $data['id'],
        "nombre" => $data['nombre'],
        "precio" => $data['precio'],
        "cantidad" => $data['cantidad'],
        "imagen" => $data['imagen']
    ];

    $existe = false;
    foreach ($_SESSION['carrito'] as &$item) {
        if ($item['id'] == $producto['id']) {
            $item['cantidad'] += $producto['cantidad'];
            $existe = true;
            break;
        }
    }

    if (!$existe) {
        $_SESSION['carrito'][] = $producto;
    }

    echo json_encode(["message" => "Producto agregado al carrito"]);
} else {
    echo json_encode(["error" => "Datos del producto incompletos"]);
}
?>

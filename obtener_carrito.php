<?php
session_start();

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Content-Type: application/json");

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

echo json_encode($_SESSION['carrito']);
?>

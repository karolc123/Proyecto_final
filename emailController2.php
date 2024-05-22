<?php

require_once "mail2.php";

// Verificar si todos los datos necesarios están presentes
if (isset($_POST['cedula'], $_POST['nombre'], $_POST['email'], $_POST['telefono'], $_POST['direccion'], $_POST['tipo'])) {
    $cedula = $_POST['cedula'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $tipo = $_POST['tipo'];

    $mail = new Email();
    
    $result = $mail->sendEmail($cedula, $nombre, $email, $telefono, $direccion, $tipo);

    echo json_encode(['result' => $result]);
} else {
    echo json_encode(['error' => 'Missing required fields']);
}
?>

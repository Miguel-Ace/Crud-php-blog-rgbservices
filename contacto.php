<?php
require 'admin/config.php';
require 'funcion.php';

$enviado = '';
$error = '';

if (isset($_POST['submit'])) {
    $correo = $_POST['correo'];
    $mensaje = $_POST['mensaje'];

    if (!empty($correo)) {
        $correo = trim($correo);
        $correo = filter_var($correo, FILTER_SANITIZE_EMAIL);
        
        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $error .= 'CORREO INVALIDO <br/>';
        }
    }else{
        $error .= 'ESCRIBE UN CORREO <br/>';
    }
    
    if (!empty($mensaje)) {
        $mensaje = trim($mensaje);
        $mensaje = htmlspecialchars($mensaje);
        $mensaje = stripcslashes($mensaje);
    }else{
        $error .= 'ESCRIBE UN MENSAJE <br/>';
    }

    if (!$error) {
        $enviar_a = 'acevedo51198mac@gmail.com';
        $asunto = 'Enviar un mensaje';
        $mensaje_listo = "Correo: $correo";
        $mensaje_listo .= "Mensaje: $mensaje";

        mail($enviar_a, $asunto, $mensaje_listo);
        $enviado = true;
    }
}
require 'views/contacto-views.php';
?>
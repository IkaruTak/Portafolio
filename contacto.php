<?php

$errores = '';
$enviado = '';

if (isset($_POST['submit'])) {
    extract($_POST);

    if (!empty($nombre)) {
        $nombre = trim($nombre);
        $nombre = filter_var($nombre,FILTER_SANITIZE_STRING);
    } else {
        $errores .= 'Por favor ingresa un nombre <br>';
    }

    if (!empty($correo)) {
        $correo = trim($correo);
        $correo = filter_var($correo,FILTER_SANITIZE_EMAIL);

        if (!filter_var($correo,FILTER_VALIDATE_EMAIL)) {
            $errores .= 'Por favor ingresa un correo válido. <br>';
        }

    } else {
        $errores .= 'Por favor ingresa un correo <br>';
    }

    if (!empty($mensaje)) {
        $mensaje = htmlspecialchars($mensaje);
        $mensaje = trim($mensaje);
        $mensaje = stripslashes($mensaje);
    } else {
        $errores .= 'Por favor ingresa el mensaje. <br>';
    }

    if (!$errores) {
        $enviar_a = 'isc.fernandowg@gmail.com';
        $asunto = 'Correo enviado desde formulario';
        $contenido = "De: $nombre \n";
        $contenido .= "E-mail: $correo \n";
        $contenido .= "Mensaje: $mensaje";

        mail($enviar_a, $asunto, $cuerpo);

        $enviado = true;
    }

}

require 'index.view.php';

?>

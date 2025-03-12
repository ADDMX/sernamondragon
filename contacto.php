<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars($_POST['nombre']);
    $telefono = htmlspecialchars($_POST['telefono']);
    $email = htmlspecialchars($_POST['email']);
    $mensaje = htmlspecialchars($_POST['mensaje']);

    // Verifica que todos los campos estén llenos
    if (empty($nombre) || empty($telefono) || empty($email) || empty($mensaje)) {
        echo "Por favor completa todos los campos.";
        exit;
    }

    // Configuración del correo
    $destinatario = "rafaelreyesvazquez45@gmail.com"; // Cambia esto por tu correo
    $asunto = "Serna Mondragón";

    // Cuerpo del mensaje
    $cuerpo = "Has recibido un nuevo mensaje:\n\n";
    $cuerpo .= "Nombre: $nombre\n";
    $cuerpo .= "Teléfono: $telefono\n";
    $cuerpo .= "Correo: $email\n";
    $cuerpo .= "Mensaje:\n$mensaje\n";

    // Encabezados
    $headers = "From: no-reply@tu-dominio.com\r\n"; // Usa un correo válido de tu dominio
    $headers .= "Reply-To: $email\r\n";

    // Enviar correo
    if (mail($destinatario, $asunto, $cuerpo, $headers)) {
        echo "<div style='text-align: center; margin-top: 50px;'>
                <h1>Mensaje enviado correctamente.</h1>
                <a href='index.html' style='text-decoration: none; color: blue;'>Volver al formulario</a>
              </div>";
    } else {
        echo "<div style='text-align: center; margin-top: 50px;'>
                <h1>Error al enviar el mensaje. Inténtalo nuevamente.</h1>
                <a href='index.html' style='text-decoration: none; color: red;'>Volver al formulario</a>
              </div>";
    }
} else {
    echo "Acceso no autorizado.";
}
?>
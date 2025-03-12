<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars($_POST['nombre']);
    $email = htmlspecialchars($_POST['email']);
    $telefono = htmlspecialchars($_POST['telefono']);
    $experiencia = htmlspecialchars($_POST['experiencia']);
    $educacion = htmlspecialchars($_POST['educacion']);

    // Verificar y mover el archivo subido
    $cv = $_FILES['cv'];
    $ruta_destino = "uploads/" . basename($cv['name']);

    if (move_uploaded_file($cv['tmp_name'], $ruta_destino)) {
        // Configuración del correo
        $destinatario = "rafaelreyesvazquez45@gmail.com"; // Cambia esto por tu correo
        $asunto = "Nueva solicitud de trabajo";

        // Cuerpo del mensaje
        $cuerpo = "Has recibido una nueva solicitud de trabajo:\n\n";
        $cuerpo .= "Nombre: $nombre\n";
        $cuerpo .= "Correo: $email\n";
        $cuerpo .= "Teléfono: $telefono\n";
        $cuerpo .= "Educación: $educacion\n\n";
        $cuerpo .= "Experiencia Laboral:\n$experiencia\n\n";
        $cuerpo .= "El currículum se encuentra adjunto.";

        // Encabezados
        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";

        // Adjuntar archivo y enviar correo
        if (mail($destinatario, $asunto, $cuerpo, $headers)) {
            echo "Solicitud enviada correctamente.";
        } else {
            echo "Error al enviar la solicitud.";
        }
    } else {
        echo "Error al subir el archivo. Inténtalo nuevamente.";
    }
} else {
    echo "Acceso no autorizado.";
}
?>

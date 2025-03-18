<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $telefono = trim($_POST['telefono']);
    $educacion = trim($_POST['educacion']);
    $cv = $_FILES['cv'];
    
    // Validar el archivo (CV en PDF)
    $permitidos = ['application/pdf'];
    if (!in_array($cv['type'], $permitidos)) {
        die("<script>alert('Solo se permiten archivos PDF para el currículum.'); window.history.back();</script>");
    }
    
    // Mover el archivo subido a una carpeta segura
    $directorioSubida = 'uploads/';
    if (!is_dir($directorioSubida)) {
        mkdir($directorioSubida, 0777, true);
    }
    
    $nombreArchivo = time() . "_" . basename($cv['name']);
    $rutaArchivo = $directorioSubida . $nombreArchivo;
    
    if (move_uploaded_file($cv['tmp_name'], $rutaArchivo)) {
        // Configuración del correo
        $para = "rafaelreyesvazquez45@gmail.com"; // Reemplaza con el correo de destino
        $asunto = "Nueva solicitud de empleo";
        $mensaje = "Nombre: $nombre\n" .
                   "Correo: $email\n" .
                   "Teléfono: $telefono\n" .
                   "Educación: $educacion\n" .
                   "Currículum: $rutaArchivo";
        $cabeceras = "From: $email\r\n";
        
        // Enviar el correo
        if (mail($para, $asunto, $mensaje, $cabeceras)) {
            echo "<script>alert('Solicitud enviada correctamente.'); window.location.href='gracias.html';</script>";
        } else {
            die("<script>alert('Error al enviar el correo.'); window.history.back();</script>");
        }
    } else {
        die("<script>alert('Error al subir el archivo.'); window.history.back();</script>");
    }
} else {
    die("<script>alert('Método de acceso no permitido.'); window.history.back();</script>");
}
?>

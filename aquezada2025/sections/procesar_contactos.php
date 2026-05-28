<?php
require_once '../admin/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre          = htmlspecialchars($_POST['nombre']);
    $email_remitente = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $asunto          = htmlspecialchars($_POST['asunto']);
    $mensaje         = htmlspecialchars($_POST['mensaje']);

    // Lee el correo destino desde la base de datos
    $bio  = $pdo->query("SELECT email FROM biografia WHERE id = 1")->fetch(PDO::FETCH_ASSOC);
    $para = $bio['email'] ?? 'correo@ejemplo.com';

    $titulo_correo = "Nuevo mensaje de contacto: " . $asunto;

    $cuerpo  = "Has recibido un nuevo mensaje desde tu portafolio:\n\n";
    $cuerpo .= "Nombre: $nombre\n";
    $cuerpo .= "Correo: $email_remitente\n";
    $cuerpo .= "Asunto: $asunto\n\n";
    $cuerpo .= "Mensaje:\n$mensaje";

    $headers = "From: $email_remitente" . "\r\n" .
               "Reply-To: $email_remitente" . "\r\n" .
               "X-Mailer: PHP/" . phpversion();

    if (mail($para, $titulo_correo, $cuerpo, $headers)) {
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <title>Mensaje Enviado</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="../assets/css/style.css">
            <style>* { caret-color: transparent !important; }</style>
        </head>
        <body class="seccion-oscura">
            <div class="container py-5 text-center">
                <h2 class="text-white fw-bold">✅ ¡Mensaje enviado correctamente!</h2>
                <p class="text-white">Gracias por contactarme, <?= htmlspecialchars($nombre) ?>.</p>
                <a href="../index.php" class="btn btn-rosado mt-3">Volver al inicio</a>
            </div>
        </body>
        </html>
        <?php
    } else {
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <title>Error al Enviar</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="../assets/css/style.css">
            <style>* { caret-color: transparent !important; }</style>
        </head>
        <body class="seccion-oscura">
            <div class="container py-5 text-center">
                <h2 class="text-white fw-bold">❌ Error al enviar</h2>
                <p class="text-white">El servidor no pudo enviar el correo. Esto ocurre porque <strong>PHP mail() necesita configuración SMTP</strong> en local.</p>
                <a href="contacto.php" class="btn btn-rosado mt-3">Intentar de nuevo</a>
            </div>
        </body>
        </html>
        <?php
    }
}
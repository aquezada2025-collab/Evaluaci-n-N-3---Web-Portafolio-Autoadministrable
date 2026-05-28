<?php require_once '../admin/db_config.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contacto - Allan Quezada</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        * { caret-color: transparent !important; }
        input, textarea, select { caret-color: white !important; }
    </style>
</head>
<body class="seccion-oscura">

    <?php include '../includes/navbar.php'; ?>

    <div class="container py-5">
        <h2 class="fw-bold mb-5 text-white">Formulario de Contacto</h2>

        <div class="card p-5 shadow border-0" style="max-width: 800px; margin: auto;">
            <h3 class="text-center mb-4">📧 Contáctame</h3>
            <form action="procesar_contacto.php" method="POST">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" placeholder="Ingresa nombre..." required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Correo Electrónico</label>
                        <input type="email" name="email" class="form-control" placeholder="Ingresa correo electrónico..." required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Asunto</label>
                    <input type="text" name="asunto" class="form-control" placeholder="Ingresa asunto...">
                </div>
                <div class="mb-3">
                    <label class="form-label">Mensaje</label>
                    <textarea name="mensaje" class="form-control" rows="5" placeholder="Escribe tu mensaje aquí..." required></textarea>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-5">Enviar solicitud</button>
                </div>
            </form>
        </div>
    </div>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
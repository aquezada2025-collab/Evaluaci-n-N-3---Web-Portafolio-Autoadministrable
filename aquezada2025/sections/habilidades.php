<?php require_once '../admin/db_config.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Habilidades - Allan Quezada</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        * { caret-color: transparent !important; }
        input, textarea, select { caret-color: white !important; }
    </style>
</head>
<body class="seccion-oscura">

    <?php include '../includes/navbar.php'; ?>

    <div class="container py-5">
        <h2 class="fw-bold mb-5 text-center text-white">Habilidades y Herramientas</h2>
        <div class="row g-4">
            <?php
            $stmt = $pdo->query("SELECT * FROM habilidades");
            while ($h = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $color = htmlspecialchars($h['color']);
                $nombre = htmlspecialchars($h['nombre']);
                echo '
                <div class="col-md-3 col-sm-6">
                    <div class="card-habilidad" style="border-top: 5px solid ' . $color . ';">
                        <div class="card-habilidad-icono" style="color: ' . $color . ';">
                            <span class="habilidad-inicial">' . mb_strtoupper(mb_substr($nombre, 0, 2)) . '</span>
                        </div>
                        <h5 class="card-habilidad-nombre">' . $nombre . '</h5>
                    </div>
                </div>';
            }
            ?>
        </div>
    </div>

    <?php include '../includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
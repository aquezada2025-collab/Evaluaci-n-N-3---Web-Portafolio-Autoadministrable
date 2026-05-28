<?php 
require_once '../admin/db_config.php'; 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tecnologías - Allan Quezada</title>
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
        <h2 class="fw-bold mb-5 text-white text-center">Tecnologías Dominadas</h2>

        <div class="row gx-5 gy-4">
            <?php
            $query = $pdo->query("SELECT * FROM tecnologias");
            $tecnologias = $query->fetchAll(PDO::FETCH_ASSOC);

            if ($tecnologias) {
                foreach ($tecnologias as $t) {
                    $color = htmlspecialchars($t['color']);
                    $porcentaje = (int)$t['porcentaje'];
                    $nombre = htmlspecialchars($t['nombre']);
                    $nivel = htmlspecialchars($t['nivel']);
                    $clase_badge = htmlspecialchars($t['clase_badge']);

                    echo '
                    <div class="col-md-6">
                        <div class="tech-card">
                            <div class="tech-header">
                                <span class="tech-nombre">' . $nombre . '</span>
                                <span class="tech-badge ' . $clase_badge . '">' . $nivel . '</span>
                            </div>
                            <div class="tech-progress-wrapper">
                                <div class="tech-progress-bar" style="width: ' . $porcentaje . '%; background-color: ' . $color . ';"></div>
                            </div>
                            <div class="tech-footer">
                                <span class="tech-percent" style="color: ' . $color . ';">' . $porcentaje . '%</span>
                            </div>
                        </div>
                    </div>';
                }
            } else {
                echo '<p class="text-center text-white">Aún no hay tecnologías cargadas en el panel.</p>';
            }
            ?>
        </div>
    </div>

    <?php include '../includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
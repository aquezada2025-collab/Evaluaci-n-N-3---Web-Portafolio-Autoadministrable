<?php 
require_once '../admin/db_config.php'; 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Proyectos - Allan Quezada</title>
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
        <div class="proyectos-header mb-5">
            <span class="proyectos-tag">Portafolio</span>
            <h2 class="fw-bold text-white mt-2">Proyectos Realizados</h2>
            <p class="text-secondary">Una selección de trabajos donde apliqué mis habilidades.</p>
        </div>

        <div class="row g-4">
            <?php
            $query = $pdo->query("SELECT * FROM proyectos");
            while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                echo '
                <div class="col-md-4">
                    <div class="proyecto-card">
                        <div class="proyecto-img-wrapper">
                            <img src="' . htmlspecialchars($p['imagen']) . '" 
                                 class="proyecto-img" 
                                 alt="' . htmlspecialchars($p['titulo']) . '"
                                 onerror="this.parentElement.classList.add(\'sin-imagen\')">
                            <div class="proyecto-overlay">
                                <a href="' . htmlspecialchars($p['enlace_demo']) . '" class="btn-overlay">Ver Demo</a>
                                <a href="' . htmlspecialchars($p['enlace_github']) . '" class="btn-overlay btn-overlay-dark">GitHub</a>
                            </div>
                        </div>
                        <div class="proyecto-body">
                            <h4 class="proyecto-titulo">' . htmlspecialchars($p['titulo']) . '</h4>
                            <p class="proyecto-desc">' . htmlspecialchars($p['descripcion']) . '</p>
                            <div class="proyecto-tags">';

                $tags = explode(',', $p['tags']);
                foreach ($tags as $tag) {
                    echo '<span class="proyecto-badge">' . trim($tag) . '</span>';
                }

                echo '      </div>
                        </div>
                    </div>
                </div>';
            }
            ?>
        </div>
    </div>

    <?php include '../includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
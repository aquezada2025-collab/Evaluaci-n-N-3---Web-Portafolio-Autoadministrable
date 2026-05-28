<?php
require_once 'admin/db_config.php';
$stmt = $pdo->query("SELECT * FROM biografia LIMIT 1");
$bio = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Portafolio - Allan Quezada</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css?v=<?= time(); ?>">
</head>
<body>

    <?php include 'includes/navbar.php'; ?>

    <main>
        <section id="biografia" class="hero-section">
            <div class="container">
                <div class="row align-items-center" style="min-height: 85vh;">

                    <!-- FOTO IZQUIERDA -->
                    <div class="col-md-4 hero-foto-col mb-5 mb-md-0">
                        <div class="hero-foto-wrapper">
                            <div class="hero-foto-anillo"></div>
                            <img src="assets/img/tu_foto.jpg"
                                 class="hero-foto-img"
                                 alt="Foto de perfil"
                                 onerror="this.src='https://ui-avatars.com/api/?name=Allan+Quezada&size=320&background=0d2137&color=e91e63&bold=true'">
                        </div>
                    </div>

                    <!-- TEXTO DERECHA -->
                    <div class="col-md-8 hero-texto ps-md-5">
                        <p class="hero-saludo">Hola, soy</p>

                        <h1 class="hero-nombre">
                            <?php echo htmlspecialchars($bio['nombre'] ?? 'Allan Quezada'); ?>
                        </h1>

                        <h2 class="hero-cargo">
                            <span id="typed-text"></span><span class="hero-blink">|</span>
                        </h2>

                        <p class="hero-descripcion">
                            <?php echo htmlspecialchars($bio['descripcion'] ?? 'Descripción profesional aquí.'); ?>
                        </p>

                        <div class="hero-botones">
                            <a href="sections/proyecto.php" class="btn btn-rosado btn-lg px-4">Ver Proyectos</a>
                            <button type="button" class="btn btn-contacto btn-lg px-4" onclick="toggleContacto()">
                                Contactar
                            </button>
                        </div>

                        <!-- Desplegable contacto -->
                        <div id="contacto-desplegable" class="contacto-box">
                            <p class="mb-1">📍 <strong>Ciudad:</strong> <?php echo htmlspecialchars($bio['ciudad'] ?? 'No definida'); ?></p>
                            <p class="mb-3">📧 <strong>Email:</strong> <?php echo htmlspecialchars($bio['email'] ?? 'No disponible'); ?></p>
                            <a href="sections/contacto.php" class="btn btn-rosado btn-sm">Contáctame ahora →</a>
                        </div>
                    </div>

                </div>
            </div>

            <div class="hero-blob hero-blob-1"></div>
            <div class="hero-blob hero-blob-2"></div>
        </section>
    </main>

    <script>
        function toggleContacto() {
            var div = document.getElementById("contacto-desplegable");
            div.style.display = (div.style.display === "none" || div.style.display === "") ? "block" : "none";
        }

        const textos = ["Desarrollador Web", "Desarrollador PHP"];
        let i = 0, j = 0, borrando = false;
        const el = document.getElementById("typed-text");
        function typeWriter() {
            const actual = textos[i];
            if (!borrando) {
                el.textContent = actual.substring(0, j + 1);
                j++;
                if (j === actual.length) { borrando = true; setTimeout(typeWriter, 1800); return; }
            } else {
                el.textContent = actual.substring(0, j - 1);
                j--;
                if (j === 0) { borrando = false; i = (i + 1) % textos.length; }
            }
            setTimeout(typeWriter, borrando ? 60 : 100);
        }
        typeWriter();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
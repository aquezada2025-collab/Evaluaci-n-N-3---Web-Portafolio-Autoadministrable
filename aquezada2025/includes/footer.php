<?php
require_once __DIR__ . '/../admin/db_config.php';
$query = $pdo->query("SELECT * FROM biografia WHERE id = 1");
$f = $query->fetch(PDO::FETCH_ASSOC);
?>

<footer class="footer-principal">
    <div class="container">

        <div class="footer-top">
            <div class="footer-marca">
                <img src="/aquezada2025/assets/img/tu_foto.jpg" 
                     class="footer-foto"
                     alt="Allan Quezada"
                     onerror="this.style.display='none';">
                <h3 class="footer-nombre"><?= htmlspecialchars($f['nombre'] ?? 'Allan Quezada'); ?></h3>
                <p class="footer-desc"><?= htmlspecialchars($f['descripcion'] ?? ''); ?></p>
            </div>

            <div class="footer-nav">
                <p class="footer-section-title">Navegación</p>
                <ul>
                    <li><a href="/aquezada2025/index.php">Biografía</a></li>
                    <li><a href="/aquezada2025/sections/habilidades.php">Habilidades</a></li>
                    <li><a href="/aquezada2025/sections/tecnologia.php">Tecnologías</a></li>
                    <li><a href="/aquezada2025/sections/proyecto.php">Proyectos</a></li>
                </ul>
            </div>

            <div class="footer-contacto">
                <p class="footer-section-title">Contacto</p>
                <p class="footer-email">📧 <?= htmlspecialchars($f['email'] ?? 'correo@ejemplo.com'); ?></p>
                <div class="footer-redes">
                    <a href="<?= htmlspecialchars($f['linkedin'] ?? '#'); ?>" class="footer-red-link">LinkedIn</a>
                    <a href="<?= htmlspecialchars($f['github'] ?? '#'); ?>" class="footer-red-link">GitHub</a>
                    <a href="<?= htmlspecialchars($f['twitter'] ?? '#'); ?>" class="footer-red-link">Twitter / X</a>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p><?= htmlspecialchars($f['footer_texto'] ?? '© 2026 Allan Quezada — Todos los derechos reservados.'); ?></p>
        </div>

    </div>
</footer>
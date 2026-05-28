<?php
if (session_status() == PHP_SESSION_NONE) { session_start(); }
?>

<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll("[contenteditable]").forEach(function(el) {
        el.removeAttribute("contenteditable");
    });
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            mutation.addedNodes.forEach(function(node) {
                if (node.nodeType === 1) {
                    if (node.hasAttribute("contenteditable")) node.removeAttribute("contenteditable");
                    node.querySelectorAll("[contenteditable]").forEach(function(el) {
                        el.removeAttribute("contenteditable");
                    });
                }
            });
        });
    });
    observer.observe(document.body, { childList: true, subtree: true });
});
</script>

<nav class="navbar navbar-expand-lg navbar-fija">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="/aquezada2025/index.php">
            <img src="/aquezada2025/assets/img/tu_foto.jpg" 
                 class="navbar-foto" 
                 alt="Allan Quezada"
                 onerror="this.style.display='none'; this.nextElementSibling.style.display='inline-flex';">
            <span class="brand-aq" style="display:none;">AQ</span>
            Allan Quezada
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto align-items-center gap-1">
                <li class="nav-item"><a class="nav-link nav-pill" href="/aquezada2025/index.php">Biografía</a></li>
                <li class="nav-item"><a class="nav-link nav-pill" href="/aquezada2025/sections/habilidades.php">Habilidades</a></li>
                <li class="nav-item"><a class="nav-link nav-pill" href="/aquezada2025/sections/tecnologia.php">Tecnologías</a></li>
                <li class="nav-item"><a class="nav-link nav-pill" href="/aquezada2025/sections/proyecto.php">Proyectos</a></li>
                <li class="nav-item ms-2">
                    <?php if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true): ?>
                        <a href="/aquezada2025/admin/panel/g_biografia.php" class="btn btn-rosado px-3">Panel Admin</a>
                    <?php else: ?>
                        <a href="/aquezada2025/admin/autch/login.php" class="btn btn-rosado px-3">Iniciar Sesión</a>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </div>
</nav>
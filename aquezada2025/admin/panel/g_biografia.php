<?php
if (session_status() == PHP_SESSION_NONE) { session_start(); }

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: /aquezada2025/admin/autch/login.php");
    exit();
}

require_once '../db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn_guardar'])) {
    $sql = "UPDATE biografia SET nombre = ?, descripcion = ?, ciudad = ?, email = ?,
            footer_texto = ?, linkedin = ?, github = ?, twitter = ? WHERE id = 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['nombre'],      $_POST['descripcion'], $_POST['ciudad'],  $_POST['email'],
        $_POST['footer_texto'], $_POST['linkedin'],   $_POST['github'],  $_POST['twitter']
    ]);
    header("Location: /aquezada2025/admin/panel/g_biografia.php?guardado=1");
    exit();
}

$bio = $pdo->query("SELECT * FROM biografia WHERE id = 1")->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Biografía</title>
    <link rel="stylesheet" href="../../assets/css/admin.css?v=<?= time(); ?>">
</head>
<body>

    <?php include '../../includes/sidebar.php'; ?>

    <main id="content">
        <div class="panel-header">
            <h2 class="panel-titulo">👤 Gestión de Biografía</h2>
            <p class="panel-subtitulo">Edita tu información personal visible en el portafolio</p>
        </div>

        <?php if (isset($_GET['guardado'])): ?>
            <div class="alert-success">✅ Cambios guardados correctamente.</div>
        <?php endif; ?>

        <form method="POST" action="/aquezada2025/admin/panel/g_biografia.php" class="form-card" autocomplete="off">

            <div class="form-header">Información Personal</div>

            <div class="form-group">
                <label>Nombre completo</label>
                <input type="text" name="nombre" class="form-control"
                       value="<?= htmlspecialchars($bio['nombre'] ?? ''); ?>" required>
            </div>

            <div class="form-group">
                <label>Descripción personal</label>
                <input type="text" name="descripcion" class="form-control"
                       value="<?= htmlspecialchars($bio['descripcion'] ?? ''); ?>">
            </div>

            <div class="form-group">
                <label>Ciudad</label>
                <input type="text" name="ciudad" class="form-control"
                       value="<?= htmlspecialchars($bio['ciudad'] ?? ''); ?>">
            </div>

            <div class="form-group">
                <label>Email de contacto</label>
                <input type="email" name="email" class="form-control"
                       value="<?= htmlspecialchars($bio['email'] ?? ''); ?>"
                       placeholder="contacto@tucorreo.cl">
            </div>

            <div class="form-header" style="border-top: 1px solid #2d3748;">
                Pie de Página y Redes Sociales
            </div>

            <div class="form-group">
                <label>Texto del Footer</label>
                <input type="text" name="footer_texto" class="form-control"
                       value="<?= htmlspecialchars($bio['footer_texto'] ?? ''); ?>"
                       placeholder="Ej: © 2026 Allan Quezada — Todos los derechos reservados">
            </div>

            <div class="form-group">
                <label>URL LinkedIn</label>
                <input type="url" name="linkedin" class="form-control"
                       value="<?= htmlspecialchars($bio['linkedin'] ?? ''); ?>"
                       placeholder="https://linkedin.com/in/tu-perfil">
            </div>

            <div class="form-group">
                <label>URL GitHub</label>
                <input type="url" name="github" class="form-control"
                       value="<?= htmlspecialchars($bio['github'] ?? ''); ?>"
                       placeholder="https://github.com/tu-usuario">
            </div>

            <div class="form-group">
                <label>URL Twitter / X</label>
                <input type="url" name="twitter" class="form-control"
                       value="<?= htmlspecialchars($bio['twitter'] ?? ''); ?>"
                       placeholder="https://twitter.com/tu-usuario">
            </div>

            <div class="form-actions">
                <button type="submit" name="btn_guardar" class="btn-save">
                    💾 Guardar Cambios
                </button>
            </div>

        </form>
    </main>

</body>
</html>
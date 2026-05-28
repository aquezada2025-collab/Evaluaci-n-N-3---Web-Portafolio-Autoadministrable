<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: /aquezada2025/admin/autch/login.php");
    exit();
}

require_once '../db_config.php';

if (isset($_POST['agregar'])) {
    $stmt = $pdo->prepare("INSERT INTO habilidades (nombre, clase, color) VALUES (?, ?, ?)");
    $stmt->execute([$_POST['nombre'], $_POST['clase'], $_POST['color']]);
    header("Location: g_habilidades.php?guardado=1");
    exit();
}

if (isset($_POST['editar'])) {
    $stmt = $pdo->prepare("UPDATE habilidades SET nombre = ?, clase = ?, color = ? WHERE id = ?");
    $stmt->execute([$_POST['nombre'], $_POST['clase'], $_POST['color'], $_POST['id']]);
    header("Location: g_habilidades.php?guardado=1");
    exit();
}

if (isset($_GET['eliminar'])) {
    $pdo->prepare("DELETE FROM habilidades WHERE id = ?")->execute([$_GET['eliminar']]);
    header("Location: g_habilidades.php");
    exit();
}

$habilidades = $pdo->query("SELECT * FROM habilidades ORDER BY id ASC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestionar Habilidades</title>
    <link rel="stylesheet" href="../../assets/css/admin.css?v=<?= time(); ?>">
    <link rel="stylesheet" href="../../assets/css/g_tabla.css?v=<?= time(); ?>">

</head>

<body>

    <?php include '../../includes/sidebar.php'; ?>

    <main id="content">
        <div class="panel-header">
            <h2 class="panel-titulo">⚡ Gestión de Habilidades</h2>
            <p class="panel-subtitulo">Agrega, edita o elimina las habilidades de tu portafolio</p>
        </div>

        <?php if (isset($_GET['guardado'])): ?>
            <div class="alert-success">✅ Cambios guardados correctamente.</div>
        <?php endif; ?>

        <!-- Formulario agregar -->
        <form method="POST" class="form-card mb-30">
            <div class="form-header">➕ Agregar Nueva Habilidad</div>

            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="nombre" placeholder="ej: HTML5"
                    class="form-control" required>
            </div>
            <div class="form-group">
                <label>Clase CSS</label>
                <input type="text" name="clase" placeholder="ej: html5"
                    class="form-control">
            </div>
            <div class="form-group">
                <label>Color</label>
                <input type="color" name="color" value="#e91e63" class="input-color">
            </div>

            <div class="form-actions">
                <button type="submit" name="agregar" class="btn-save">➕ Agregar Habilidad</button>
            </div>
        </form>

        <!-- Tabla -->
        <div class="form-card">
            <div class="form-header">
                📋 Habilidades Registradas
                <span class="header-count">(<?= count($habilidades) ?> registros)</span>
            </div>

            <?php if (empty($habilidades)): ?>
                <div class="empty-state">No hay habilidades registradas aún.</div>
            <?php else: ?>
                <table class="panel-table">
                    <thead>
                        <tr>
                            <th style="width:40px;">#</th>
                            <th>Nombre</th>
                            <th>Clase CSS</th>
                            <th style="width:80px; text-align:center;">Color</th>
                            <th style="text-align:right;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($habilidades as $h): ?>
                            <tr>
                                <form method="POST">
                                    <input type="hidden" name="id" value="<?= $h['id'] ?>">
                                    <td class="td-id"><?= $h['id'] ?></td>
                                    <td><input type="text" name="nombre"
                                            value="<?= htmlspecialchars($h['nombre']) ?>"
                                            class="table-input"></td>
                                    <td><input type="text" name="clase"
                                            value="<?= htmlspecialchars($h['clase']) ?>"
                                            class="table-input"></td>
                                    <td style="text-align:center;">
                                        <input type="color" name="color"
                                            value="<?= htmlspecialchars($h['color']) ?>"
                                            class="input-color-sm">
                                    </td>
                                    <td style="text-align:right; white-space:nowrap;">
                                        <button type="submit" name="editar" class="btn-save btn-sm">💾 Guardar</button>
                                </form>
                                <a href="?eliminar=<?= $h['id'] ?>"
                                    class="btn-danger btn-sm"
                                    onclick="return confirm('¿Eliminar esta habilidad?')">🗑 Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </main>

</body>

</html>
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
    $nivel = $_POST['nivel'];
    $clase = 'badge-' . strtolower($nivel);
    $stmt  = $pdo->prepare("INSERT INTO tecnologias (nombre, porcentaje, nivel, clase_badge, color) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$_POST['nombre'], $_POST['porcentaje'], $nivel, $clase, $_POST['color']]);
    header("Location: g_tecnologia.php?guardado=1");
    exit();
}

if (isset($_POST['editar'])) {
    $nivel = $_POST['nivel'];
    $clase = 'badge-' . strtolower($nivel);
    $stmt  = $pdo->prepare("UPDATE tecnologias SET nombre = ?, porcentaje = ?, nivel = ?, clase_badge = ?, color = ? WHERE id = ?");
    $stmt->execute([$_POST['nombre'], $_POST['porcentaje'], $nivel, $clase, $_POST['color'], $_POST['id']]);
    header("Location: g_tecnologia.php?guardado=1");
    exit();
}

if (isset($_GET['eliminar'])) {
    $pdo->prepare("DELETE FROM tecnologias WHERE id = ?")->execute([$_GET['eliminar']]);
    header("Location: g_tecnologia.php");
    exit();
}

$tecnologias = $pdo->query("SELECT * FROM tecnologias ORDER BY id ASC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestionar Tecnologías</title>
    <link rel="stylesheet" href="../../assets/css/admin.css?v=<?= time(); ?>">
    <link rel="stylesheet" href="../../assets/css/g_tabla.css?v=<?= time(); ?>">

</head>

<body>

    <?php include '../../includes/sidebar.php'; ?>

    <main id="content">
        <div class="panel-header">
            <h2 class="panel-titulo">💻 Gestión de Tecnologías</h2>
            <p class="panel-subtitulo">Administra las tecnologías y sus niveles de dominio</p>
        </div>

        <?php if (isset($_GET['guardado'])): ?>
            <div class="alert-success">✅ Cambios guardados correctamente.</div>
        <?php endif; ?>

        <!-- Formulario agregar -->
        <form method="POST" class="form-card mb-30">
            <div class="form-header">➕ Agregar Nueva Tecnología</div>

            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="nombre" placeholder="ej: PHP"
                    class="form-control" required>
            </div>
            <div class="form-group">
                <label>Porcentaje</label>
                <input type="number" name="porcentaje" placeholder="ej: 85"
                    class="form-control" min="0" max="100" style="max-width:120px;" required>
            </div>
            <div class="form-group">
                <label>Nivel</label>
                <select name="nivel" class="form-control" style="max-width:200px;" required>
                    <option value="">-- Seleccionar --</option>
                    <option value="avanzado">Avanzado</option>
                    <option value="intermedio">Intermedio</option>
                    <option value="basico">Básico</option>
                </select>
            </div>
            <div class="form-group">
                <label>Color</label>
                <input type="color" name="color" value="#e91e63" class="input-color">
            </div>

            <div class="form-actions">
                <button type="submit" name="agregar" class="btn-save">➕ Agregar Tecnología</button>
            </div>
        </form>

        <!-- Tabla -->
        <div class="form-card">
            <div class="form-header">
                📋 Tecnologías Registradas
                <span class="header-count">(<?= count($tecnologias) ?> registros)</span>
            </div>

            <?php if (empty($tecnologias)): ?>
                <div class="empty-state">No hay tecnologías registradas aún.</div>
            <?php else: ?>
                <table class="panel-table">
                    <thead>
                        <tr>
                            <th style="width:40px;">#</th>
                            <th>Nombre</th>
                            <th style="width:90px;">%</th>
                            <th style="width:150px;">Nivel</th>
                            <th style="width:80px; text-align:center;">Color</th>
                            <th style="text-align:right;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tecnologias as $t): ?>
                            <tr>
                                <form method="POST">
                                    <input type="hidden" name="id" value="<?= $t['id'] ?>">
                                    <td class="td-id"><?= $t['id'] ?></td>
                                    <td><input type="text" name="nombre"
                                            value="<?= htmlspecialchars($t['nombre']) ?>"
                                            class="table-input"></td>
                                    <td><input type="number" name="porcentaje"
                                            value="<?= htmlspecialchars($t['porcentaje']) ?>"
                                            class="table-input" min="0" max="100"></td>
                                    <td>
                                        <select name="nivel" class="table-input">
                                            <option value="avanzado" <?= $t['nivel'] === 'avanzado'   ? 'selected' : '' ?>>Avanzado</option>
                                            <option value="intermedio" <?= $t['nivel'] === 'intermedio' ? 'selected' : '' ?>>Intermedio</option>
                                            <option value="basico" <?= $t['nivel'] === 'basico'     ? 'selected' : '' ?>>Básico</option>
                                        </select>
                                    </td>
                                    <td style="text-align:center;">
                                        <input type="color" name="color"
                                            value="<?= htmlspecialchars($t['color']) ?>"
                                            class="input-color-sm">
                                    </td>
                                    <td style="text-align:right; white-space:nowrap;">
                                        <button type="submit" name="editar" class="btn-save btn-sm">💾 Guardar</button>
                                </form>
                                <a href="?eliminar=<?= $t['id'] ?>"
                                    class="btn-danger btn-sm"
                                    onclick="return confirm('¿Eliminar esta tecnología?')">🗑 Eliminar</a>
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
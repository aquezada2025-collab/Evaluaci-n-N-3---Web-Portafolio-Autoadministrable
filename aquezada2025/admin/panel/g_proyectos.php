<?php
if (session_status() == PHP_SESSION_NONE) { session_start(); }

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: /aquezada2025/admin/autch/login.php");
    exit();
}

require_once '../db_config.php';

if (isset($_POST['agregar'])) {
    $stmt = $pdo->prepare("INSERT INTO proyectos (titulo, descripcion, imagen, enlace_demo, enlace_github, tags) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$_POST['titulo'], $_POST['descripcion'], $_POST['imagen'], $_POST['enlace_demo'], $_POST['enlace_github'], $_POST['tags']]);
    header("Location: g_proyectos.php?guardado=1");
    exit();
}

if (isset($_POST['editar'])) {
    $stmt = $pdo->prepare("UPDATE proyectos SET titulo = ?, descripcion = ?, imagen = ?, enlace_demo = ?, enlace_github = ?, tags = ? WHERE id = ?");
    $stmt->execute([$_POST['titulo'], $_POST['descripcion'], $_POST['imagen'], $_POST['enlace_demo'], $_POST['enlace_github'], $_POST['tags'], $_POST['id']]);
    header("Location: g_proyectos.php?guardado=1");
    exit();
}

if (isset($_GET['eliminar'])) {
    $pdo->prepare("DELETE FROM proyectos WHERE id = ?")->execute([$_GET['eliminar']]);
    header("Location: g_proyectos.php");
    exit();
}

$proyectos = $pdo->query("SELECT * FROM proyectos ORDER BY id ASC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestionar Proyectos</title>
    <link rel="stylesheet" href="../../assets/css/admin.css?v=<?= time(); ?>">
    <link rel="stylesheet" href="../../assets/css/g_tabla.css?v=<?= time(); ?>">
    <style>
        /* Tabla proyectos: inputs compactos para que quepan todo */
        #tabla-proyectos input[type="text"] {
            min-width: 0;
            width: 100%;
        }
        #tabla-proyectos { table-layout: fixed; width: 100%; }
        #tabla-proyectos col.col-id    { width: 36px;  }
        #tabla-proyectos col.col-titulo { width: 14%;  }
        #tabla-proyectos col.col-desc  { width: 20%;  }
        #tabla-proyectos col.col-demo  { width: 13%;  }
        #tabla-proyectos col.col-github{ width: 13%;  }
        #tabla-proyectos col.col-tags  { width: 12%;  }
        #tabla-proyectos col.col-acciones { width: 90px; }
    </style>
</head>
<body>

    <?php include '../../includes/sidebar.php'; ?>

    <main id="content">
        <div class="panel-header">
            <h2 class="panel-titulo">📁 Gestión de Proyectos</h2>
            <p class="panel-subtitulo">Administra los proyectos de tu portafolio</p>
        </div>

        <?php if (isset($_GET['guardado'])): ?>
            <div class="alert-success">✅ Cambios guardados correctamente.</div>
        <?php endif; ?>

        <!-- Formulario agregar -->
        <form method="POST" class="form-card mb-30">
            <div class="form-header">➕ Agregar Nuevo Proyecto</div>

            <div class="form-group">
                <label>Título</label>
                <input type="text" name="titulo" placeholder="Nombre del proyecto"
                       class="form-control" required>
            </div>
            <div class="form-group">
                <label>URL Imagen</label>
                <input type="text" name="imagen" placeholder="ruta/imagen.jpg"
                       class="form-control">
            </div>
            <div class="form-group">
                <label>Tags</label>
                <input type="text" name="tags" placeholder="PHP,MySQL,Bootstrap"
                       class="form-control">
            </div>
            <div class="form-group">
                <label>Link Demo</label>
                <input type="text" name="enlace_demo" placeholder="https://..."
                       class="form-control">
            </div>
            <div class="form-group">
                <label>Link GitHub</label>
                <input type="text" name="enlace_github" placeholder="https://github.com/..."
                       class="form-control">
            </div>
            <div class="form-group">
                <label>Descripción</label>
                <textarea name="descripcion" placeholder="Descripción del proyecto..."
                          class="form-control" style="height:80px; resize:vertical;"></textarea>
            </div>

            <div class="form-actions">
                <button type="submit" name="agregar" class="btn-save">➕ Agregar Proyecto</button>
            </div>
        </form>

        <!-- Tabla registros -->
        <div class="form-card">
            <div class="form-header">
                📋 Proyectos Registrados
                <span class="header-count">(<?= count($proyectos) ?> registros)</span>
            </div>

            <?php if (empty($proyectos)): ?>
                <div class="empty-state">No hay proyectos registrados aún.</div>
            <?php else: ?>
            <div style="overflow-x: auto;">
            <table class="panel-table" id="tabla-proyectos">
                <colgroup>
                    <col class="col-id">
                    <col class="col-titulo">
                    <col class="col-desc">
                    <col class="col-demo">
                    <col class="col-github">
                    <col class="col-tags">
                    <col class="col-acciones">
                </colgroup>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th>Demo</th>
                        <th>GitHub</th>
                        <th>Tags</th>
                        <th style="text-align:right;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($proyectos as $p): ?>
                    <tr>
                        <form method="POST">
                            <input type="hidden" name="id"     value="<?= $p['id'] ?>">
                            <input type="hidden" name="imagen" value="<?= htmlspecialchars($p['imagen']) ?>">
                            <td class="td-id"><?= $p['id'] ?></td>
                            <td><input type="text" name="titulo"
                                       value="<?= htmlspecialchars($p['titulo']) ?>"></td>
                            <td><input type="text" name="descripcion"
                                       value="<?= htmlspecialchars($p['descripcion']) ?>"></td>
                            <td><input type="text" name="enlace_demo"
                                       value="<?= htmlspecialchars($p['enlace_demo']) ?>"></td>
                            <td><input type="text" name="enlace_github"
                                       value="<?= htmlspecialchars($p['enlace_github']) ?>"></td>
                            <td><input type="text" name="tags"
                                       value="<?= htmlspecialchars($p['tags']) ?>"></td>
                            <td style="text-align:right; white-space:nowrap;">
                                <button type="submit" name="editar" class="btn-save btn-sm">💾</button>
                        </form>
                                <a href="?eliminar=<?= $p['id'] ?>"
                                   class="btn-danger btn-sm"
                                   onclick="return confirm('¿Eliminar este proyecto?')"
                                   style="display:inline-block; text-decoration:none;">🗑</a>
                            </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            </div>
            <?php endif; ?>
        </div>
    </main>

</body>
</html>
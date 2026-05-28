<?php
session_start();
require_once '../db_config.php';

$error = "";

if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: ../panel/g_biografia.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email    = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT password FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch();

    if ($usuario && $password == $usuario['password']) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: ../panel/g_biografia.php");
        exit();
    } else {
        $error = "Las credenciales no existen o son incorrectas.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Acceso Administrativo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/autch.css">
</head>
<body>

<div class="login-wrapper">
    <div class="login-card">

        <div class="login-icono">🔐</div>
        <p class="login-title">Área Administrativa</p>
        <p class="login-subtitle">Acceso restringido solo para administrador</p>

        <?php if ($error): ?>
            <div class="login-error">❌ <?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label class="login-label">Usuario / Email</label>
                <input type="email" name="email" class="login-input"
                       placeholder="admin@correo.cl" required>
            </div>
            <div class="mb-3">
                <label class="login-label">Contraseña</label>
                <input type="password" name="password" class="login-input"
                       placeholder="••••••••••" required>
            </div>
            <button type="submit" class="btn-login">🔓 Iniciar Sesión</button>
        </form>

        <a href="../../index.php" class="login-volver">← Volver al sitio</a>
    </div>
</div>

</body>
</html>
<?php
$host = 'localhost';
$db   = 'aquezada_db2';
$user = 'aquezada'; // Usuario por defecto en local
$pass = '';     // Contraseña por defecto en local

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
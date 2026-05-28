<?php
$host = 'localhost';
$db   = 'aquezada_db2';
$user = 'aquezada'; 
$pass = 'AqX91mQ0#';     

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>

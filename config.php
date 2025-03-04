<?php
// config.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "laserranita";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . htmlspecialchars($conn->connect_error, ENT_QUOTES, 'UTF-8'));
}

// Establecer el conjunto de caracteres a UTF-8
$conn->set_charset("utf8mb4");
?>

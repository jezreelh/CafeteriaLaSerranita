<?php
session_start();

// Verificar que el usuario esté autenticado
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'No autorizado']);
    exit();
}

// Conectar a la base de datos
require 'database.php'; // Incluye tu archivo de conexión a la base de datos

$user_id = $_SESSION['user_id']; // Suponiendo que el ID del usuario se guarda en la sesión

// Consulta para obtener la información del usuario
$query = $pdo->prepare("SELECT username FROM users WHERE id = ?");
$query->execute([$user_id]);
$user = $query->fetch(PDO::FETCH_ASSOC);

if ($user) {
    echo json_encode(['username' => $user['username']]);
} else {
    echo json_encode(['error' => 'Usuario no encontrado']);
}
?>

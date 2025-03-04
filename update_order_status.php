<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'administrador') {
    header("Location: index.php");
    exit();
}

$order_id = $_GET['order_id'] ?? null;
$new_status = $_GET['status'] ?? null;

if ($order_id && $new_status) {
    // Actualizar el estado del pedido en la base de datos
    $query = 'UPDATE pedidos SET status = ? WHERE order_id = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('si', $new_status, $order_id);
    $stmt->execute();
    $stmt->close();
    
    // Redirigir a la página de pedidos
    header("Location: pedidos.php");
    exit();
}

// Redirigir a la página de pedidos si falta información
header("Location: pedidos.php");
exit();
?>

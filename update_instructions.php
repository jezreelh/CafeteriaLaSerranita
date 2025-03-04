<?php
session_start();
include 'config.php';

$order_id = $_SESSION['order_id'];
$instructions = $_POST['instructions'];

$conn->query("UPDATE pedidos SET instructions = '$instructions' WHERE order_id = $order_id");

header("Location: cart.php");
exit();
?>

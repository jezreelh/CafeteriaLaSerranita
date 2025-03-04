<?php
session_start();
include 'config.php';

$order_id = $_SESSION['order_id'];
$product_id = $_GET['product_id'];

$conn->query("DELETE FROM detalles_del_pedido WHERE order_id = $order_id AND product_id = $product_id");

header("Location: cart.php");
exit();
?>

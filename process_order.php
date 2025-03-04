<?php
session_start();
include 'config.php';

// Verifica si el usuario está logueado
if (!isset($_SESSION['user_id']) || !isset($_SESSION['order_id'])) {
    echo "<script>alert('Usuario no autenticado.'); window.location.href = 'shop.php';</script>";
    exit();
}

$order_id = $_SESSION['order_id'];
$user_id = $_SESSION['user_id'];
$instructions = trim($_POST['instructions'] ?? '');

// Calcula el subtotal y el costo total
$subtotal = 0;
$shipping_cost = 0; // Asume que tienes una forma de calcular el costo de envío

$query = 'SELECT p.price, d.quantity 
          FROM detalles_del_pedido d
          JOIN productos p ON d.product_id = p.product_id
          WHERE d.order_id = ?';
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $order_id);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $subtotal += $row['price'] * $row['quantity'];
}

$stmt->close();

$total_price = $subtotal + $shipping_cost;

if ($total_price > 150) {
    echo "<script>alert('El total del pedido no puede exceder los 150 pesos.'); window.location.href = 'cart.php';</script>";
    exit();
}

if (empty($instructions)) {
    echo "<script>alert('Por favor, agregue instrucciones de modo de preparación.'); window.location.href = 'cart.php';</script>";
    exit();
}

// Verifica si el usuario ya tiene un pedido en curso o en espera
$query = 'SELECT COUNT(*) as count FROM pedidos WHERE user_id = ? AND status IN ("en curso", "espera") AND order_date IS NOT NULL';
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row['count'] > 0) {
    echo "<script>alert('Solo puedes tener un pedido en curso o en espera.'); window.location.href = 'cart.php';</script>";
    exit();
}

// Elimina los pedidos con datos incompletos o con estado NULL
$query = 'DELETE FROM pedidos WHERE user_id = ? AND (status IS NULL OR order_date IS NULL)';
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$stmt->close();

// Inserta el nuevo pedido
$query = 'INSERT INTO pedidos (user_id, total_price, order_date, status, is_cart, instructions) VALUES (?, ?, NOW(), "espera", 1, ?)';
$stmt = $conn->prepare($query);
$stmt->bind_param('ids', $user_id, $total_price, $instructions);
$stmt->execute();
$new_order_id = $stmt->insert_id;
$stmt->close();

// Actualiza el estado del pedido en detalles_del_pedido
$query = 'UPDATE detalles_del_pedido SET order_id = ? WHERE order_id = ?';
$stmt = $conn->prepare($query);
$stmt->bind_param('ii', $new_order_id, $order_id);
$stmt->execute();
$stmt->close();

// Elimina los productos del carrito
$query = 'DELETE FROM detalles_del_pedido WHERE order_id = ?';
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $order_id);
$stmt->execute();
$stmt->close();

echo "<script>
        alert('Tu pedido ha sido enviado correctamente.');
        window.location.href = 'cart.php';
      </script>";
exit();
?>

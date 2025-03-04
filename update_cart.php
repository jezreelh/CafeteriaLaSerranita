<?php
session_start();
include 'config.php';

// Verificar que el usuario está logueado y que el order_id está definido
if (!isset($_SESSION['user_id']) || !isset($_SESSION['order_id'])) {
    header("Location: shop.php");
    exit();
}

$order_id = $_SESSION['order_id'];

// Preparar la consulta para eliminar productos del carrito
$delete_query = 'DELETE FROM detalles_del_pedido WHERE order_id = ? AND product_id = ?';
$delete_stmt = $conn->prepare($delete_query);

// Preparar la consulta para insertar o actualizar productos en el carrito
$insert_update_query = 'INSERT INTO detalles_del_pedido (order_id, product_id, quantity)
                        VALUES (?, ?, ?)
                        ON DUPLICATE KEY UPDATE quantity = VALUES(quantity)';
$insert_update_stmt = $conn->prepare($insert_update_query);

if ($delete_stmt === false || $insert_update_stmt === false) {
    die('Error en la preparación de la consulta: ' . $conn->error);
}

// Utilizar transacciones para asegurar la integridad de los datos
$conn->begin_transaction();

try {
    foreach ($_POST['quantity'] as $product_id => $quantity) {
        $product_id = intval($product_id);
        $quantity = intval($quantity);

        if ($quantity <= 0) {
            // Eliminar producto del carrito si la cantidad es 0 o negativa
            $delete_stmt->bind_param('ii', $order_id, $product_id);
            $delete_stmt->execute();
        } else {
            // Insertar o actualizar la cantidad del producto en el carrito
            $insert_update_stmt->bind_param('iii', $order_id, $product_id, $quantity);
            $insert_update_stmt->execute();
        }
    }

    // Confirmar la transacción
    $conn->commit();
} catch (Exception $e) {
    // Revertir la transacción en caso de error
    $conn->rollback();
    die('Error en la actualización del carrito: ' . $e->getMessage());
}

// Cerrar las declaraciones y la conexión
$delete_stmt->close();
$insert_update_stmt->close();
$conn->close();

// Redirigir de vuelta al carrito
header("Location: cart.php");
exit();
?>

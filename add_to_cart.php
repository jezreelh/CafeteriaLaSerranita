<?php
session_start();
include 'config.php';

// Verifica si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['message' => 'Usuario no logueado']);
    exit();
}

// Verifica si el ID del producto está presente en la solicitud POST
if (isset($_POST['product_id'])) {
    $product_id = intval($_POST['product_id']);
    $order_id = $_SESSION['order_id'] ?? 0; // Asegúrate de tener el ID del carrito

    // Verifica si el carrito existe
    if ($order_id == 0) {
        // Crear un nuevo carrito si no existe
        $stmt = $conn->prepare("INSERT INTO pedidos (user_id) VALUES (?)");
        $stmt->bind_param('i', $_SESSION['user_id']);
        $stmt->execute();
        $order_id = $conn->insert_id;
        $_SESSION['order_id'] = $order_id;
        $stmt->close();
    }

    // Agregar el producto al carrito o actualizar la cantidad
    $stmt = $conn->prepare("INSERT INTO detalles_del_pedido (order_id, product_id, quantity)
                            VALUES (?, ?, 1)
                            ON DUPLICATE KEY UPDATE quantity = quantity + 1");
    $stmt->bind_param('ii', $order_id, $product_id);
    $stmt->execute();
    $stmt->close();

    // Enviar una respuesta JSON de éxito
    echo json_encode(['message' => 'Producto agregado correctamente!']);
} else {
    // Enviar una respuesta JSON de error si el ID del producto no está presente
    echo json_encode(['message' => 'Error en el producto']);
}
?>

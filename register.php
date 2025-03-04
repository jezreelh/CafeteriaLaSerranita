<?php
// Incluir el archivo de configuración
include 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar y escapar los inputs
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars($_POST['phone']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Verificar que las contraseñas coincidan
    if ($password !== $confirm_password) {
        echo "error:Las contraseñas no coinciden.";
        exit();
    }

    // Verificar el dominio del correo
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match('/@utpn\.edu\.mx$/', $email)) {
        echo "error:El correo debe ser del dominio @utpn.edu.mx";
        exit();
    }

    // Verificar si el correo ya está registrado
    $stmt = $conn->prepare("SELECT email FROM usuarios WHERE email = ?");
    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "error:El correo ya está registrado.";
            exit();
        }

        $stmt->close();
    } else {
        echo "error:Error en la preparación de la consulta";
        exit();
    }

    // Hashear la contraseña
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insertar el nuevo usuario en la base de datos
    $stmt = $conn->prepare("INSERT INTO usuarios (name, email, phone, password, role, banned) VALUES (?, ?, ?, ?, 'cliente', 0)");
    if ($stmt) {
        $stmt->bind_param("ssss", $name, $email, $phone, $hashed_password);

        if ($stmt->execute()) {
            // Redirigir a la página de destino
            $redirectUrl = isset($_SESSION['previousPage']) ? $_SESSION['previousPage'] : 'index.php';
            echo "redirect:" . $redirectUrl;
            exit();
        } else {
            echo "error:Error al registrar: " . htmlspecialchars($stmt->error);
            exit();
        }

        $stmt->close();
    } else {
        echo "error:Error en la preparación de la consulta";
        exit();
    }
}

$conn->close();
?>

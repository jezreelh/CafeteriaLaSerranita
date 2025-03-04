<?php
include 'config.php';
session_start();

header('Content-Type: text/plain'); // Cambiar el tipo de contenido a texto plano

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "error:Correo electrónico inválido";
        exit();
    }

    // Preparar la consulta
    $stmt = $conn->prepare("SELECT user_id, password, role FROM usuarios WHERE email = ?");
    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($user_id, $hashed_password, $role);

        if ($stmt->num_rows > 0) {
            $stmt->fetch();

            // Verificar la contraseña
            if (password_verify($password, $hashed_password)) {
                $_SESSION['user_id'] = $user_id;
                $_SESSION['role'] = $role;

                // Redirigir a la página anterior o al índice
                $redirectUrl = isset($_SESSION['previousPage']) ? $_SESSION['previousPage'] : 'index.php';
                unset($_SESSION['previousPage']);
                echo "redirect:" . $redirectUrl;
                exit();
            } else {
                echo "error:Contraseña incorrecta";
            }
        } else {
            echo "error:No se encontró una cuenta con ese correo";
        }

        $stmt->close();
    } else {
        echo "error:Error en la preparación de la consulta";
    }
}

$conn->close();
?>

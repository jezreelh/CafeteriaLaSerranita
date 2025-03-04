<?php
// Incluir el archivo de configuración
include 'config.php';

// Recoger datos del formulario
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// Preparar la consulta SQL
$sql = "INSERT INTO contactos (name, email, phone, subject, message, contact_date) VALUES (?, ?, ?, ?, ?, NOW())";
$stmt = $conn->prepare($sql);

// Verificar si la preparación de la consulta fue exitosa
if ($stmt === false) {
    die("Error en la preparación de la consulta: " . htmlspecialchars($conn->error, ENT_QUOTES, 'UTF-8'));
}

// Asociar los parámetros
$stmt->bind_param("sssss", $name, $email, $phone, $subject, $message);

// Ejecutar la consulta
if ($stmt->execute()) {
    // Enviar mensaje de éxito y redirigir a la página actual con JavaScript
    echo '<script>
            alert("Mensaje guardado correctamente.");
            window.location.href = document.referrer; // Redirige a la misma página
          </script>';
} else {
    // Enviar mensaje de error y redirigir a la página actual con JavaScript
    echo '<script>
            alert("Error al guardar el mensaje.");
            window.location.href = document.referrer; // Redirige a la misma página
          </script>';
}

// Cerrar la consulta y la conexión
$stmt->close();
$conn->close();
?>

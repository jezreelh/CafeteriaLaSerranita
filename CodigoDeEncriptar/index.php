<?php
$conexion = new mysqli('fdb1028.awardspace.net', '4599139_encriptar', 'Amigo14p?', '4599139_encriptar', 3306);

if ($conexion->connect_error) {
    die('Error de conexión: ' . $conexion->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    // Encriptar la contraseña
    $key = 'clave-secreta';  // Clave de encriptación
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc')); // Vector de inicialización
    $encrypted_password = openssl_encrypt($contrasena, 'aes-256-cbc', $key, 0, $iv);
    $encrypted_password = base64_encode($encrypted_password . '::' . $iv); // Almacenar iv junto con la contraseña

    // Insertar el usuario en la base de datos
    $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, correo, contrasena) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre, $correo, $encrypted_password);
    $stmt->execute();

    echo "Usuario registrado exitosamente";
    $stmt->close();
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuario</title>
</head>
<body>

<h2>Registrar Usuario</h2>
<form method="POST">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required><br>
    <label for="correo">Correo:</label>
    <input type="email" id="correo" name="correo" required><br>
    <label for="contrasena">Contraseña:</label>
    <input type="password" id="contrasena" name="contrasena" required><br>
    <input type="submit" value="Registrar">
</form>
<h2><a href="Desencriptar.php">Ver Usuarios y Desencriptar Contraseñas</a></h2>

</body>
</html>

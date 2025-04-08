<?php
$conexion = new mysqli('fdb1028.awardspace.net', '4599139_encriptar', 'Amigo14p?', '4599139_encriptar', 3306);

if ($conexion->connect_error) {
    die('Error de conexión: ' . $conexion->connect_error);
}

$resultado = $conexion->query("SELECT * FROM usuarios");

$key = 'clave-secreta';  // Clave de encriptación

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios Registrados</title>
    <style>
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 30px auto;
            font-family: Arial, sans-serif;
        }
        th, td {
            border: 1px solid #aaa;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #333;
            color: white;
        }
        h2 {
            text-align: center;
            font-family: Arial;
        }
    </style>
</head>
<body>

<h2>Lista de Usuarios Registrados</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Correo</th>
        <th>Contraseña (Original)</th>
    </tr>

    <?php
    while ($fila = $resultado->fetch_assoc()) {
        // Desencriptar la contraseña
        list($encrypted_password, $iv) = explode('::', base64_decode($fila['contrasena']));
        $decrypted_password = openssl_decrypt($encrypted_password, 'aes-256-cbc', $key, 0, $iv);
        ?>
        <tr>
            <td><?php echo $fila['id']; ?></td>
            <td><?php echo $fila['nombre']; ?></td>
            <td><?php echo $fila['correo']; ?></td>
            <td><?php echo $decrypted_password; ?></td>
        </tr>
    <?php } ?>
</table>

</body>
</html>

<?php
$conexion->close();
?>

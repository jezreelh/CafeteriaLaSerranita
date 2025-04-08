<?php
function desencriptar($texto_encriptado_base64, $clave) {
    $metodo = 'AES-256-CBC';
    $datos = base64_decode($texto_encriptado_base64);

    $iv_longitud = openssl_cipher_iv_length($metodo);
    $iv = substr($datos, 0, $iv_longitud);
    $texto_encriptado = substr($datos, $iv_longitud);

    return openssl_decrypt($texto_encriptado, $metodo, $clave, 0, $iv);
}

// USO:
$clave_secreta = "mi_clave_super_segura_123";
$encriptado_recibido = "código_base64_generado_por_encriptar.php"; // Reemplaza con tu string real

$desencriptado = desencriptar($encriptado_recibido, $clave_secreta);

echo "Texto desencriptado: " . $desencriptado;
?>

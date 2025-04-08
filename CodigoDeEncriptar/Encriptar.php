<?php
function encriptar($texto_plano, $clave) {
    $metodo = 'AES-256-CBC';
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($metodo));

    $texto_encriptado = openssl_encrypt($texto_plano, $metodo, $clave, 0, $iv);

    // Empaquetar IV y texto encriptado en una sola cadena para almacenarlo
    return base64_encode($iv . $texto_encriptado);
}

// USO:
$clave_secreta = "mi_clave_super_segura_123";
$texto = "mi_contraseña";

$encriptado = encriptar($texto, $clave_secreta);

echo "Texto encriptado: " . $encriptado;
?>

<?php
require_once __DIR__ . '/../../../../wp-load.php';

use WPMailSMTP\Helpers\Crypto;

function decrypt_smtp_password($encrypted_base64, $key) {
    $decoded = base64_decode($encrypted_base64);
    if ($decoded === false || strlen($decoded) < 17) {
        return '[Error] Base64 decoding failed or data too short';
    }

    $iv = substr($decoded, 0, 16);
    $ciphertext = substr($decoded, 16);

    $decrypted = openssl_decrypt($ciphertext, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
    return $decrypted ?: '[Error] Decryption failed';
}

$key = Crypto::get_secret_key();
$encrypted = 'y/Kw8JhwASfVkQ/hDRRq5hyT6PJouQeUUa+dPQyKbGSy+koYCmOpwAj7sdhRdvI4yVdOeZ4pP4Kjo5dhrssbnjO7P9EuO2ugffpQf9rdqb9F0LuZ0';

echo "Decrypted SMTP Password: " . decrypt_smtp_password($encrypted, $key) . PHP_EOL;

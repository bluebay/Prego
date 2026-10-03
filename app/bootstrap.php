<?php
declare(strict_types=1);

$config = require __DIR__ . '/config.php';
$products = require __DIR__ . '/products.php';
header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: strict-origin-when-cross-origin');
header("Content-Security-Policy: default-src 'self'; img-src 'self'; style-src 'self'; script-src 'self'; font-src 'self'; base-uri 'self'; form-action 'self' https://wa.me; frame-ancestors 'none'; object-src 'none'");
header('Cache-Control: no-store');
session_start([
    'cookie_httponly' => true,
    'cookie_secure' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
    'cookie_samesite' => 'Lax',
    'use_strict_mode' => true,
]);
$_SESSION['csrf'] ??= bin2hex(random_bytes(32));

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function field(string $key): string
{
    $value = $_POST[$key] ?? '';
    return is_string($value) ? trim($value) : '';
}

function whatsapp(string $text): string
{
    global $config;
    return 'https://wa.me/' . $config['whatsapp'] . '?text=' . rawurlencode($text);
}

$errors = [];
$values = ['name' => '', 'email' => '', 'product' => 'asesoria', 'dimensions' => '', 'message' => ''];
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    foreach ($values as $key => $_) {
        $values[$key] = field($key);
    }
    if (!hash_equals($_SESSION['csrf'], field('csrf')) || field('website') !== '') {
        $errors[] = 'No pudimos validar la consulta. Actualiza la página e inténtalo nuevamente.';
    }
    if ($values['name'] === '' || strlen($values['name']) > 320) {
        $errors[] = 'Escribe tu nombre (máximo 80 caracteres).';
    }
    if ($values['email'] !== '' && (strlen($values['email']) > 254 || !filter_var($values['email'], FILTER_VALIDATE_EMAIL))) {
        $errors[] = 'Revisa el formato de tu correo electrónico.';
    }
    if ($values['product'] !== 'asesoria' && !isset($products[$values['product']])) {
        $errors[] = 'Selecciona uno de los acabados del catálogo.';
    }
    if (strlen($values['dimensions']) > 320 || strlen($values['message']) > 4000) {
        $errors[] = 'La consulta es demasiado extensa. Usa hasta 80 caracteres para medidas y 1000 para el mensaje.';
    }
    if (!$errors) {
        $productName = $products[$values['product']]['name'] ?? 'Asesoría para elegir una cubierta';
        $text = "Hola PREGO, soy {$values['name']}. Me gustaría cotizar una cubierta de mesa.\nAcabado: {$productName}.";
        if ($values['dimensions'] !== '') $text .= "\nMedidas aproximadas: {$values['dimensions']}.";
        if ($values['email'] !== '') $text .= "\nMi correo: {$values['email']}.";
        if ($values['message'] !== '') $text .= "\n{$values['message']}";
        header('Location: ' . whatsapp($text), true, 303);
        exit;
    }
    http_response_code(422);
}

// Enlaces a fichas siguen funcionando aunque JavaScript esté desactivado.
$selectedId = $_GET['producto'] ?? null;
$selectedProduct = is_string($selectedId) ? ($products[$selectedId] ?? null) : null;
if ($selectedId !== null && !$selectedProduct) http_response_code(404);

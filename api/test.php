<?php
// api/test.php - Test API endpoints
require_once __DIR__ . '/../config.php';
require_once INCLUDES_PATH . '/functions.php';

header('Content-Type: application/json');

// Test database connection
$pdo = getDBConnection();
$dbStatus = $pdo ? 'Connected' : 'Failed';

// Test session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Test cart
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Test products
global $products;
$productCount = count($products);

echo json_encode([
    'status' => 'success',
    'database' => $dbStatus,
    'session_id' => session_id(),
    'cart_count' => count($_SESSION['cart']),
    'cart_items' => $_SESSION['cart'],
    'product_count' => $productCount,
    'first_product' => $products[0] ?? null,
    'php_version' => phpversion(),
    'server' => $_SERVER['SERVER_SOFTWARE'] ?? 'unknown'
], JSON_PRETTY_PRINT);
?>
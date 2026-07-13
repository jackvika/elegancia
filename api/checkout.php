<?php
// api/checkout.php - Checkout API
require_once __DIR__ . '/../config.php';
require_once INCLUDES_PATH . '/functions.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    echo json_encode(['success' => false, 'message' => 'Invalid data']);
    exit;
}

// Validate required fields
$required = ['name', 'email', 'phone', 'address'];
foreach ($required as $field) {
    if (empty($input[$field])) {
        echo json_encode(['success' => false, 'message' => "Please fill in your $field"]);
        exit;
    }
}

// Validate email
if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Please enter a valid email address']);
    exit;
}

// Validate phone (10 digits)
if (!preg_match('/^[0-9]{10}$/', $input['phone'])) {
    echo json_encode(['success' => false, 'message' => 'Please enter a valid 10-digit phone number']);
    exit;
}

// Check cart
$cart = $_SESSION['cart'] ?? [];
if (empty($cart)) {
    echo json_encode(['success' => false, 'message' => 'Your cart is empty']);
    exit;
}

// Calculate total
$total = 0;
foreach ($cart as $item) {
    $total += $item['price'] * $item['qty'];
}

// Generate order ID
$orderId = 'ORD-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));

// Prepare order data
$orderData = [
    'order_id' => $orderId,
    'name' => htmlspecialchars(trim($input['name'])),
    'email' => htmlspecialchars(trim($input['email'])),
    'phone' => htmlspecialchars(trim($input['phone'])),
    'address' => htmlspecialchars(trim($input['address'])),
    'items' => $cart,
    'total' => $total
];

// Save to database
$saved = saveOrder($orderData);

// Send emails
if ($saved) {
    sendOrderConfirmation($orderData);
}

// Clear cart
$_SESSION['cart'] = [];

echo json_encode([
    'success' => true,
    'message' => 'Order placed successfully! We will contact you shortly.',
    'data' => [
        'order_id' => $orderId
    ]
]);
?>
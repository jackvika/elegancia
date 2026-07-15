<?php
// api/cart.php - Cart API with Pinterest compatibility
require_once __DIR__ . '/../config.php';

// Start session if not started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

// Initialize cart
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Get products from config
global $all_products;

function sendResponse($success, $message, $data = null) {
    echo json_encode([
        'success' => $success,
        'message' => $message,
        'data' => $data
    ]);
    exit;
}

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'add':
        $input = json_decode(file_get_contents('php://input'), true);
        if (!$input) {
            sendResponse(false, 'Invalid input data');
        }
        
        $productId = $input['product_id'] ?? '';
        $qty = max(1, intval($input['qty'] ?? 1));
        $name = $input['name'] ?? '';
        $price = floatval($input['price'] ?? 0);
        $image = $input['image'] ?? '';
        
        // Find product in global data
        $product = null;
        global $all_products;
        foreach ($all_products as $p) {
            if ((string)$p['id'] === (string)$productId) {
                $product = $p;
                break;
            }
        }
        
        if (!$product) {
            // Use provided data if product not found
            $product = [
                'id' => $productId,
                'name' => $name,
                'price' => $price,
                'image' => $image,
                'unit' => 'unit'
            ];
        }
        
        // Add to cart
        $found = false;
        foreach ($_SESSION['cart'] as &$item) {
            if ((string)$item['id'] === (string)$productId) {
                $item['qty'] += $qty;
                $found = true;
                break;
            }
        }
        
        if (!$found) {
            $_SESSION['cart'][] = [
                'id' => (string)$product['id'],
                'name' => $product['name'],
                'price' => floatval($product['price']),
                'qty' => $qty,
                'image' => $product['image'] ?? '',
                'unit' => $product['unit'] ?? 'unit'
            ];
        }
        
        // Calculate totals
        $total = 0;
        $count = 0;
        foreach ($_SESSION['cart'] as $item) {
            $total += $item['price'] * $item['qty'];
            $count += $item['qty'];
        }
        
        sendResponse(true, 'Product added to cart', [
            'cart' => array_values($_SESSION['cart']),
            'total' => $total,
            'count' => $count
        ]);
        break;
        
    case 'remove':
        $input = json_decode(file_get_contents('php://input'), true);
        $productId = $input['product_id'] ?? '';
        
        $_SESSION['cart'] = array_values(array_filter($_SESSION['cart'], function($item) use ($productId) {
            return (string)$item['id'] !== (string)$productId;
        }));
        
        $total = 0;
        $count = 0;
        foreach ($_SESSION['cart'] as $item) {
            $total += $item['price'] * $item['qty'];
            $count += $item['qty'];
        }
        
        sendResponse(true, 'Product removed from cart', [
            'cart' => array_values($_SESSION['cart']),
            'total' => $total,
            'count' => $count
        ]);
        break;
        
    case 'update':
        $input = json_decode(file_get_contents('php://input'), true);
        $productId = $input['product_id'] ?? '';
        $qty = intval($input['qty'] ?? 0);
        
        if ($qty <= 0) {
            $_SESSION['cart'] = array_values(array_filter($_SESSION['cart'], function($item) use ($productId) {
                return (string)$item['id'] !== (string)$productId;
            }));
        } else {
            foreach ($_SESSION['cart'] as &$item) {
                if ((string)$item['id'] === (string)$productId) {
                    $item['qty'] = $qty;
                    break;
                }
            }
        }
        
        $total = 0;
        $count = 0;
        foreach ($_SESSION['cart'] as $item) {
            $total += $item['price'] * $item['qty'];
            $count += $item['qty'];
        }
        
        sendResponse(true, 'Cart updated', [
            'cart' => array_values($_SESSION['cart']),
            'total' => $total,
            'count' => $count
        ]);
        break;
        
    case 'clear':
        $_SESSION['cart'] = [];
        sendResponse(true, 'Cart cleared', [
            'cart' => [],
            'total' => 0,
            'count' => 0
        ]);
        break;
        
    case 'get':
        $total = 0;
        $count = 0;
        foreach ($_SESSION['cart'] as $item) {
            $total += $item['price'] * $item['qty'];
            $count += $item['qty'];
        }
        
        sendResponse(true, 'Cart retrieved', [
            'cart' => array_values($_SESSION['cart']),
            'total' => $total,
            'count' => $count
        ]);
        break;
        
    default:
        sendResponse(false, 'Invalid action. Available: add, remove, update, clear, get');
}
?>
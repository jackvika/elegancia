<?php
// includes/functions.php - Helper functions

/**
 * Send email - Works with localhost without SMTP
 */
function sendEmail($to, $subject, $message, $isHTML = true) {
    $headers = "From: " . SMTP_FROM_NAME . " <" . SMTP_FROM . ">\r\n";
    $headers .= "Reply-To: " . SMTP_FROM . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: " . ($isHTML ? "text/html" : "text/plain") . "; charset=UTF-8\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();
    
    // Try to send email
    $sent = @mail($to, $subject, $message, $headers);
    
    // Always log for debugging
    logEmailToFile($to, $subject, $message);
    
    return $sent;
}

/**
 * Log email to file
 */
function logEmailToFile($to, $subject, $message) {
    $logDir = __DIR__ . '/../logs/';
    if (!is_dir($logDir)) {
        @mkdir($logDir, 0777, true);
    }
    
    $logFile = $logDir . 'emails.log';
    $content = "========================================\n";
    $content .= "Date: " . date('Y-m-d H:i:s') . "\n";
    $content .= "To: $to\n";
    $content .= "Subject: $subject\n";
    $content .= "Message:\n$message\n";
    $content .= "========================================\n\n";
    
    @file_put_contents($logFile, $content, FILE_APPEND);
}

/**
 * Send order confirmation email
 */
function sendOrderConfirmation($orderData) {
    $subject = "New Order Received - Elegancia Premium Interiors";
    
    $itemsHtml = '';
    foreach ($orderData['items'] as $item) {
        $itemsHtml .= "
            <tr>
                <td>" . htmlspecialchars($item['name']) . "</td>
                <td>" . $item['qty'] . "</td>
                <td>₹" . number_format($item['price']) . "</td>
                <td>₹" . number_format($item['price'] * $item['qty']) . "</td>
            </tr>";
    }
    
    $message = "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; color: #f0ede4; background: #0c0c0c; padding: 20px; }
            .container { max-width: 600px; margin: 0 auto; background: #1a1a1a; padding: 30px; border-radius: 12px; }
            .header { text-align: center; border-bottom: 1px solid rgba(213,168,81,0.06); padding-bottom: 20px; }
            .header h1 { color: #d5a851; font-size: 24px; }
            .order-details { margin: 20px 0; }
            .order-details table { width: 100%; border-collapse: collapse; }
            .order-details th, .order-details td { padding: 10px; text-align: left; border-bottom: 1px solid rgba(213,168,81,0.04); }
            .order-details th { color: #d5a851; }
            .total { font-size: 18px; font-weight: bold; color: #d5a851; text-align: right; margin-top: 15px; }
            .footer { margin-top: 30px; padding-top: 20px; border-top: 1px solid rgba(213,168,81,0.06); text-align: center; color: #848461; font-size: 12px; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h1>🛍️ New Order Received</h1>
                <p style='color:#848461;'>Order #" . $orderData['order_id'] . "</p>
            </div>
            <div class='order-details'>
                <h3 style='color:#d5a851;'>Customer Details</h3>
                <p><strong>Name:</strong> " . htmlspecialchars($orderData['name']) . "</p>
                <p><strong>Email:</strong> " . htmlspecialchars($orderData['email']) . "</p>
                <p><strong>Phone:</strong> " . htmlspecialchars($orderData['phone']) . "</p>
                <p><strong>Address:</strong> " . nl2br(htmlspecialchars($orderData['address'])) . "</p>
                <h3 style='color:#d5a851; margin-top:20px;'>Order Items</h3>
                <table>
                    <tr>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                    $itemsHtml
                </table>
                <div class='total'>Total: ₹" . number_format($orderData['total']) . "</div>
            </div>
            <div class='footer'>
                <p>Thank you for choosing Elegancia Premium Interiors</p>
                <p>This is an automated confirmation. Our team will contact you shortly.</p>
            </div>
        </div>
    </body>
    </html>";
    
    // Send to admin
    sendEmail(COMPANY_EMAIL, $subject, $message, true);
    
    // Send to customer
    sendEmail($orderData['email'], "Order Confirmation - Elegancia Premium Interiors", $message, true);
}

/**
 * Send contact form email
 */
function sendContactEmail($data) {
    $subject = "New Contact Form Submission - Elegancia";
    
    $message = "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; color: #f0ede4; background: #0c0c0c; padding: 20px; }
            .container { max-width: 500px; margin: 0 auto; background: #1a1a1a; padding: 25px; border-radius: 12px; }
            .header { text-align: center; border-bottom: 1px solid rgba(213,168,81,0.06); padding-bottom: 15px; }
            .header h1 { color: #d5a851; font-size: 20px; }
            .field { margin: 12px 0; }
            .field label { color: #d5a851; font-weight: bold; }
            .field p { margin: 4px 0 0 10px; color: #c4c1b0; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h1>📩 New Contact Form Submission</h1>
            </div>
            <div class='field'><label>Name:</label><p>" . htmlspecialchars($data['name']) . "</p></div>
            <div class='field'><label>Email:</label><p>" . htmlspecialchars($data['email']) . "</p></div>
            <div class='field'><label>Phone:</label><p>" . htmlspecialchars($data['phone']) . "</p></div>
            <div class='field'><label>Subject:</label><p>" . htmlspecialchars($data['subject']) . "</p></div>
            <div class='field'><label>Message:</label><p>" . nl2br(htmlspecialchars($data['message'])) . "</p></div>
        </div>
    </body>
    </html>";
    
    return sendEmail(COMPANY_EMAIL, $subject, $message, true);
}

// ========== DATABASE FUNCTIONS ==========

/**
 * Save order to database
 */
function saveOrder($orderData) {
    $pdo = getDBConnection();
    if (!$pdo) {
        error_log("Database connection failed");
        return false;
    }
    
    try {
        $stmt = $pdo->prepare("
            INSERT INTO orders (order_id, name, email, phone, address, items, total) 
            VALUES (:order_id, :name, :email, :phone, :address, :items, :total)
        ");
        
        return $stmt->execute([
            ':order_id' => $orderData['order_id'],
            ':name' => $orderData['name'],
            ':email' => $orderData['email'],
            ':phone' => $orderData['phone'],
            ':address' => $orderData['address'],
            ':items' => json_encode($orderData['items']),
            ':total' => $orderData['total']
        ]);
    } catch (PDOException $e) {
        error_log("Save order error: " . $e->getMessage());
        return false;
    }
}

/**
 * Save contact to database
 */
function saveContact($data) {
    $pdo = getDBConnection();
    if (!$pdo) {
        error_log("Database connection failed");
        return false;
    }
    
    try {
        $stmt = $pdo->prepare("
            INSERT INTO contacts (name, email, phone, subject, message) 
            VALUES (:name, :email, :phone, :subject, :message)
        ");
        
        return $stmt->execute([
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':phone' => $data['phone'] ?? '',
            ':subject' => $data['subject'] ?? 'General',
            ':message' => $data['message']
        ]);
    } catch (PDOException $e) {
        error_log("Save contact error: " . $e->getMessage());
        return false;
    }
}

// ========== ORDER FUNCTIONS ==========

/**
 * Generate unique order ID
 */
function generateOrderId() {
    return 'ORD-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
}

/**
 * Calculate cart total
 */
function calculateCartTotal($cart) {
    $total = 0;
    foreach ($cart as $item) {
        $total += $item['price'] * $item['qty'];
    }
    return $total;
}

// ========== SECURITY FUNCTIONS ==========

/**
 * Sanitize input data
 */
function sanitizeInput($data) {
    if (is_array($data)) {
        return array_map('sanitizeInput', $data);
    }
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

/**
 * Validate email
 */
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * Validate phone number (Indian)
 */
function validatePhone($phone) {
    return preg_match('/^[0-9]{10}$/', $phone);
}

// ========== JSON RESPONSE FUNCTIONS ==========

/**
 * Send JSON response
 */
function jsonResponse($success, $message, $data = null) {
    header('Content-Type: application/json');
    echo json_encode([
        'success' => $success,
        'message' => $message,
        'data' => $data
    ]);
    exit;
}
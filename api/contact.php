<?php
// api/contact.php - Contact form API
require_once __DIR__ . '/../config.php';
require_once INCLUDES_PATH . '/functions.php';

header('Content-Type: application/json');

// Enable CORS
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Only accept POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonResponse(false, 'Method not allowed');
}

$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    jsonResponse(false, 'Invalid data');
}

// Validate required fields
$required = ['name', 'email', 'message'];
foreach ($required as $field) {
    if (empty($data[$field])) {
        jsonResponse(false, "Please fill in your $field");
    }
}

// Sanitize inputs
$name = sanitizeInput($data['name']);
$email = sanitizeInput($data['email']);
$phone = sanitizeInput($data['phone'] ?? '');
$subject = sanitizeInput($data['subject'] ?? 'General');
$message = sanitizeInput($data['message']);

// Validate email
if (!validateEmail($email)) {
    jsonResponse(false, 'Please enter a valid email address');
}

// Validate phone if provided
if (!empty($phone) && !validatePhone($phone)) {
    jsonResponse(false, 'Please enter a valid 10-digit phone number');
}

// Save to database
$saved = saveContact([
    'name' => $name,
    'email' => $email,
    'phone' => $phone,
    'subject' => $subject,
    'message' => $message
]);

// Send email
$emailSent = sendContactEmail([
    'name' => $name,
    'email' => $email,
    'phone' => $phone,
    'subject' => $subject,
    'message' => $message
]);

jsonResponse(true, 'Your message has been sent! We will get back to you shortly.');
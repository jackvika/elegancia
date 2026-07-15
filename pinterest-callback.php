<?php
// pinterest-callback.php - OAuth callback handler
// DO NOT REMOVE OR MODIFY ANYTHING IN THIS FILE

require_once 'config.php';
require_once 'config/pinterest.php';

if (isset($_GET['code'])) {
    $code = $_GET['code'];
    
    // Exchange code for access token
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.pinterest.com/v5/oauth/token');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        'grant_type' => 'authorization_code',
        'code' => $code,
        'redirect_uri' => PINTEREST_REDIRECT_URI
    ]));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Basic ' . base64_encode(PINTEREST_APP_ID . ':' . PINTEREST_APP_SECRET),
        'Content-Type: application/x-www-form-urlencoded'
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);
    
    if (isset($data['access_token'])) {
        // Save token securely (in database or encrypted file)
        file_put_contents(__DIR__ . '/.pinterest_token', $data['access_token']);
        
        echo "<h1>Success!</h1>";
        echo "<p>You have successfully authenticated with Pinterest.</p>";
        echo "<p>Access Token: " . substr($data['access_token'], 0, 20) . "...</p>";
        echo "<p>You can now use the Pinterest API.</p>";
    } else {
        echo "<h1>Error</h1>";
        echo "<p>Failed to get access token: " . ($data['error'] ?? 'Unknown error') . "</p>";
    }
} else {
    // Redirect to Pinterest OAuth
    $authUrl = 'https://www.pinterest.com/oauth/?' . http_build_query([
        'client_id' => PINTEREST_APP_ID,
        'redirect_uri' => PINTEREST_REDIRECT_URI,
        'response_type' => 'code',
        'scope' => 'catalogs:read,catalogs:write,ads:read,ads:write'
    ]);
    header('Location: ' . $authUrl);
    exit;
}
?>
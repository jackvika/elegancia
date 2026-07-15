<?php
// api/pinterest-sync.php - Sync products to Pinterest
// DO NOT REMOVE OR MODIFY ANYTHING IN THIS FILE

require_once __DIR__ . '/../config.php';
require_once INCLUDES_PATH . '/PinterestAPI.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// Only allow POST requests for security
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

// Verify API key for security
$apiKey = $_POST['api_key'] ?? $_GET['api_key'] ?? '';
$expectedKey = 'your-secret-api-key'; // Change this to a secure key

if ($apiKey !== $expectedKey) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

try {
    $pinterest = new PinterestAPI();

    // Get all products
    global $all_products;
    $products = $all_products;

    // Sync products to Pinterest
    $result = $pinterest->syncProducts($products);

    // Also create product groups for each series
    $seriesResults = [];
    foreach ($series_data as $code => $series) {
        $filter = $pinterest->createSeriesFilter($code);
        try {
            $groupResult = $pinterest->createProductGroup(
                $series['name'] . ' - ' . date('Y-m-d'),
                $filter
            );
            $seriesResults[$code] = $groupResult;
        } catch (Exception $e) {
            $seriesResults[$code] = ['error' => $e->getMessage()];
        }
    }

    echo json_encode([
        'success' => true,
        'message' => 'Products synced successfully',
        'sync_result' => $result,
        'product_groups' => $seriesResults,
        'total_products' => count($products)
    ]);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Error syncing products: ' . $e->getMessage()
    ]);
}
?>
<?php
// includes/PinterestAPI.php - Pinterest API Helper Class
// DO NOT REMOVE OR MODIFY ANYTHING IN THIS FILE

require_once __DIR__ . '/../config/pinterest.php';

class PinterestAPI {
    private $accessToken;
    private $adAccountId;
    private $baseUrl;
    private $adsBaseUrl;
    private $catalogId;
    private $feedId;

    public function __construct() {
        $this->accessToken = PINTEREST_ACCESS_TOKEN;
        $this->adAccountId = PINTEREST_AD_ACCOUNT_ID;
        $this->baseUrl = PINTEREST_API_BASE;
        $this->adsBaseUrl = PINTEREST_ADS_BASE;
        $this->catalogId = PINTEREST_CATALOG_ID;
        $this->feedId = PINTEREST_FEED_ID;
    }

    private function request($method, $endpoint, $data = null, $useAds = false) {
        $base = $useAds ? $this->adsBaseUrl : $this->baseUrl;
        $url = $base . $endpoint;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

        $headers = [
            'Authorization: Bearer ' . $this->accessToken,
            'Content-Type: application/json',
            'Accept: application/json'
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        if ($data !== null) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode >= 400) {
            throw new Exception("Pinterest API Error: " . $response . " (HTTP " . $httpCode . ")");
        }

        return json_decode($response, true);
    }

    // ===== CATALOG MANAGEMENT =====

    /**
     * Create a new catalog
     */
    public function createCatalog($name, $description = '') {
        $data = [
            'catalog_type' => 'RETAIL',
            'name' => $name,
            'description' => $description
        ];
        return $this->request('POST', '/catalogs', $data);
    }

    /**
     * Get catalog details
     */
    public function getCatalog($catalogId = null) {
        $id = $catalogId ?? $this->catalogId;
        return $this->request('GET', '/catalogs/' . $id);
    }

    /**
     * List all catalogs
     */
    public function listCatalogs($pageSize = 25) {
        return $this->request('GET', '/catalogs?page_size=' . $pageSize);
    }

    /**
     * Delete a catalog
     */
    public function deleteCatalog($catalogId = null) {
        $id = $catalogId ?? $this->catalogId;
        return $this->request('DELETE', '/catalogs/' . $id);
    }

    // ===== FEED MANAGEMENT =====

    /**
     * Create a feed for your catalog
     */
    public function createFeed($name, $location, $format = 'CSV', $defaultCurrency = 'INR') {
        $data = [
            'name' => $name,
            'location' => $location,
            'format' => $format,
            'default_currency' => $defaultCurrency,
            'catalog_id' => $this->catalogId
        ];
        return $this->request('POST', '/feeds', $data);
    }

    /**
     * Get feed details
     */
    public function getFeed($feedId = null) {
        $id = $feedId ?? $this->feedId;
        return $this->request('GET', '/feeds/' . $id);
    }

    /**
     * List all feeds
     */
    public function listFeeds($pageSize = 25) {
        return $this->request('GET', '/feeds?page_size=' . $pageSize);
    }

    /**
     * Update feed
     */
    public function updateFeed($feedId, $data) {
        return $this->request('PATCH', '/feeds/' . $feedId, $data);
    }

    /**
     * Delete feed
     */
    public function deleteFeed($feedId = null) {
        $id = $feedId ?? $this->feedId;
        return $this->request('DELETE', '/feeds/' . $id);
    }

    /**
     * Get feed processing results
     */
    public function getFeedProcessingResults($feedId = null, $pageSize = 25) {
        $id = $feedId ?? $this->feedId;
        return $this->request('GET', '/feeds/' . $id . '/processing_results?page_size=' . $pageSize);
    }

    /**
     * Ingest feed items (manual trigger)
     */
    public function ingestFeedItems($feedId = null) {
        $id = $feedId ?? $this->feedId;
        return $this->request('POST', '/feeds/' . $id . '/ingest');
    }

    // ===== PRODUCT GROUP MANAGEMENT =====

    /**
     * Create a product group
     */
    public function createProductGroup($name, $filter, $catalogId = null) {
        $data = [
            'name' => $name,
            'catalog_id' => $catalogId ?? $this->catalogId,
            'feed_id' => $this->feedId,
            'filters' => $filter
        ];
        return $this->request('POST', '/product_groups', $data);
    }

    /**
     * Get product group
     */
    public function getProductGroup($groupId) {
        return $this->request('GET', '/product_groups/' . $groupId);
    }

    /**
     * List product groups
     */
    public function listProductGroups($catalogId = null, $pageSize = 25) {
        $id = $catalogId ?? $this->catalogId;
        return $this->request('GET', '/catalogs/' . $id . '/product_groups?page_size=' . $pageSize);
    }

    /**
     * Update product group
     */
    public function updateProductGroup($groupId, $data) {
        return $this->request('PATCH', '/product_groups/' . $groupId, $data);
    }

    /**
     * Delete product group
     */
    public function deleteProductGroup($groupId) {
        return $this->request('DELETE', '/product_groups/' . $groupId);
    }

    // ===== BATCH ITEM OPERATIONS =====

    /**
     * Get catalog items (POST)
     */
    public function getCatalogItems($itemIds) {
        $data = ['item_ids' => $itemIds];
        return $this->request('POST', '/catalogs/' . $this->catalogId . '/items/get', $data);
    }

    /**
     * Operate on item batch (Create/Update/Delete)
     */
    public function operateOnItemsBatch($items, $operation = 'UPSERT') {
        $data = [
            'items' => $items,
            'operation' => $operation
        ];
        return $this->request('POST', '/catalogs/' . $this->catalogId . '/items/batch', $data);
    }

    /**
     * Generate product feed CSV content from Elegancia products
     */
    public function generateFeedCSV($products) {
        $csv = "id,title,description,link,image_link,availability,price,sale_price,brand,condition,google_product_category,product_type,color,material,pattern,gender,age_group,size,size_type,size_system\n";

        foreach ($products as $product) {
            $row = [
                $product['id'],
                $product['name'],
                $product['description'],
                'https://yourdomain.com/product.php?product=' . $product['id'],
                $product['image'],
                'in stock',
                'INR ' . number_format($product['price'], 2),
                '',
                'Elegancia',
                'new',
                'Home & Garden > Decor > Wall Decor',
                'Interior Decor > ' . ucfirst($product['category']),
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                ''
            ];

            // Escape fields with commas or quotes
            foreach ($row as &$field) {
                if (strpos($field, ',') !== false || strpos($field, '"') !== false || strpos($field, "\n") !== false) {
                    $field = '"' . str_replace('"', '""', $field) . '"';
                }
            }

            $csv .= implode(',', $row) . "\n";
        }

        return $csv;
    }

    /**
     * Upload feed file to Pinterest
     */
    public function uploadFeedFile($filePath) {
        $ch = curl_init();
        $url = $this->baseUrl . '/feeds/' . $this->feedId . '/upload';

        // Create multipart form data
        $postData = [
            'file' => new CURLFile($filePath)
        ];

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

        $headers = [
            'Authorization: Bearer ' . $this->accessToken,
            'Accept: application/json'
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode >= 400) {
            throw new Exception("Upload failed: " . $response);
        }

        return json_decode($response, true);
    }

    // ===== SHOPPING ADS =====

    /**
     * Create campaign for shopping ads
     */
    public function createShoppingCampaign($name, $budget, $startDate, $endDate = null) {
        $data = [
            'name' => $name,
            'objective_type' => 'CATALOG_SALES',
            'budget' => $budget,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'status' => 'ACTIVE'
        ];
        return $this->request('POST', '/ad_accounts/' . $this->adAccountId . '/campaigns', $data, true);
    }

    /**
     * Create ad group
     */
    public function createAdGroup($campaignId, $name, $budget, $productGroupId) {
        $data = [
            'name' => $name,
            'campaign_id' => $campaignId,
            'budget' => $budget,
            'product_group_id' => $productGroupId,
            'status' => 'ACTIVE'
        ];
        return $this->request('POST', '/ad_accounts/' . $this->adAccountId . '/ad_groups', $data, true);
    }

    /**
     * Create product group promotion
     */
    public function createProductGroupPromotion($adGroupId, $productGroupId) {
        $data = [
            'ad_group_id' => $adGroupId,
            'product_group_id' => $productGroupId
        ];
        return $this->request('POST', '/ad_accounts/' . $this->adAccountId . '/product_group_promotions', $data, true);
    }

    /**
     * Sync products to Pinterest catalog
     */
    public function syncProducts($products) {
        $items = [];
        foreach ($products as $product) {
            $items[] = [
                'item_id' => $product['id'],
                'title' => $product['name'],
                'description' => $product['description'],
                'link' => 'https://yourdomain.com/product.php?product=' . $product['id'],
                'image_link' => $product['image'],
                'availability' => 'in stock',
                'price' => 'INR ' . number_format($product['price'], 2),
                'brand' => 'Elegancia',
                'condition' => 'new',
                'google_product_category' => 'Home & Garden > Decor > Wall Decor',
                'product_type' => 'Interior Decor > ' . ucfirst($product['category'])
            ];
        }

        return $this->operateOnItemsBatch($items, 'UPSERT');
    }

    /**
     * Create series product group filter
     */
    public function createSeriesFilter($seriesCode) {
        return [
            'all_of' => [
                [
                    'operand' => 'custom_label_0',
                    'operator' => 'EQUALS',
                    'value' => $seriesCode
                ]
            ]
        ];
    }

    /**
     * Create category product group filter
     */
    public function createCategoryFilter($category) {
        return [
            'all_of' => [
                [
                    'operand' => 'product_type',
                    'operator' => 'CONTAINS',
                    'value' => $category
                ]
            ]
        ];
    }
}
?>
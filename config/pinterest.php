<?php
// config/pinterest.php - Pinterest Configuration
// DO NOT REMOVE OR MODIFY ANYTHING IN THIS FILE

// Check if constants are already defined before defining them
if (!defined('PINTEREST_APP_ID')) {
    // === STEP 1: Create a Pinterest App ===
    // Go to https://developers.pinterest.com/apps/
    // Create a new app and get your App ID and App Secret
    define('PINTEREST_APP_ID', 'your_app_id_here');
    define('PINTEREST_APP_SECRET', 'your_app_secret_here');

    // === STEP 2: Set your redirect URI ===
    // This must match exactly what you set in your Pinterest app settings
    define('PINTEREST_REDIRECT_URI', 'https://yourdomain.com/pinterest-callback.php');

    // === STEP 3: After OAuth flow, update these ===
    // Run pinterest-callback.php to get your access token
    // Then copy the token and update this file

    // Define the path where the token is stored
    define('PINTEREST_TOKEN_FILE', __DIR__ . '/../.pinterest_token');

    // Load token from file if exists
    $pinterestToken = '';
    if (file_exists(PINTEREST_TOKEN_FILE)) {
        $pinterestToken = trim(file_get_contents(PINTEREST_TOKEN_FILE));
    }
    define('PINTEREST_ACCESS_TOKEN', $pinterestToken);

    // === STEP 4: Get your Ad Account ID ===
    // Your Ad Account ID format: 1234567890
    define('PINTEREST_AD_ACCOUNT_ID', 'your_ad_account_id');

    // === STEP 5: Create a catalog via API or use existing ===
    // You can create a catalog using the PinterestAPI::createCatalog() method
    // Or use an existing catalog ID
    define('PINTEREST_CATALOG_ID', 'your_catalog_id');

    // === STEP 6: Create a feed via API or use existing ===
    // You can create a feed using the PinterestAPI::createFeed() method
    // Or use an existing feed ID
    define('PINTEREST_FEED_ID', 'your_feed_id');

    // Enable/disable Pinterest features
    define('PINTEREST_ENABLED', true);

    // === STEP 7: Pinterest Tag ID for tracking ===
    // Get this from your Pinterest Ads dashboard
    define('PINTEREST_TAG_ID', 'your_pinterest_tag_id');
}
?>
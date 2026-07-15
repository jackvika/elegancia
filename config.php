<?php
// config.php - Simplified with series-based products only
// DO NOT REMOVE OR MODIFY ANYTHING IN THIS FILE

// Define base path for includes
define('BASE_PATH', __DIR__);
define('INCLUDES_PATH', BASE_PATH . '/includes');

// Base URL - Change this to your domain
define('BASE_URL', '');

// Site name
define('SITE_NAME', 'Elegancia Premium Interiors');

// Company details
define('COMPANY_NAME', 'Swastik Moulding & Plastics');
define('COMPANY_CEO', 'Monak Goyal');
define('COMPANY_ADDRESS', '3km Stone, Sehnal Road, Ratia - 125051, Fatehabad, Haryana, India');
define('COMPANY_PHONE', '08047643386');
define('COMPANY_EMAIL', 'info@elegancia.in');
define('COMPANY_GST', '06ACYFS5052N1Z9');
define('COMPANY_IEC', 'ACYFS5052N');
define('COMPANY_BANKER', 'HDFC BANK');

// Social Media Links
define('SOCIAL_FACEBOOK', '#');
define('SOCIAL_INSTAGRAM', '#');
define('SOCIAL_LINKEDIN', '#');
define('SOCIAL_TWITTER', '#');
define('SOCIAL_YOUTUBE', '#');

// WhatsApp Number
define('WHATSAPP_NUMBER', '918047643386');

// Google Maps Embed URL
define('GOOGLE_MAPS_URL', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3492.345678901234!2d75.5774!3d29.4672!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391226a9f0d0f9c5%3A0x5d0b8c1e5a7b8a9f!2sRatia%2C%20Fatehabad%2C%20Haryana%20125051!5e0!3m2!1sen!2sin!4v1700000000000');

// ========== DATABASE CONFIGURATION ==========
define('DB_HOST', 'localhost');
define('DB_NAME', 'elegancia_db');
define('DB_USER', 'root');
define('DB_PASS', '');

// ========== EMAIL CONFIGURATION ==========
define('SMTP_HOST', '');
define('SMTP_PORT', 0);
define('SMTP_USER', '');
define('SMTP_PASS', '');
define('SMTP_FROM', 'info@elegancia.in');
define('SMTP_FROM_NAME', 'Elegancia Premium Interiors');

// ========== DATABASE CONNECTION FUNCTION ==========
function getDBConnection() {
    try {
        $pdo = new PDO(
            "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
            DB_USER,
            DB_PASS,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ]
        );
        return $pdo;
    } catch (PDOException $e) {
        error_log("Database connection failed: " . $e->getMessage());
        return null;
    }
}

// ========== SERIES AND PRODUCT DATA ==========
$series_data = [
    '5100' => [
        'name' => '5100 Series',
        'description' => 'Premium wall panel series with elegant finishes',
        'image' => 'https://placehold.co/600x400/1a1a1a/d5a851?text=5100+Series',
        'items' => 16,
        'products' => []
    ],
    '3100' => [
        'name' => '3100 Series',
        'description' => 'Classic moulding designs for timeless interiors',
        'image' => 'https://placehold.co/600x400/1a1a1a/d5a851?text=3100+Series',
        'items' => 9,
        'products' => []
    ],
    '4200' => [
        'name' => '4200 Series',
        'description' => 'Contemporary cornices for modern spaces',
        'image' => 'https://placehold.co/600x400/1a1a1a/d5a851?text=4200+Series',
        'items' => 9,
        'products' => []
    ],
    '8100' => [
        'name' => '8100 Series',
        'description' => 'Premium decorative mouldings collection',
        'image' => 'https://placehold.co/600x400/1a1a1a/d5a851?text=8100+Series',
        'items' => 7,
        'products' => []
    ],
    '8200' => [
        'name' => '8200 Series',
        'description' => 'Luxury wall panel designs for premium interiors',
        'image' => 'https://placehold.co/600x400/1a1a1a/d5a851?text=8200+Series',
        'items' => 8,
        'products' => []
    ]
];

// Generate products for each series
$unit_map = [
    '5100' => 'sq ft',
    '3100' => 'meter',
    '4200' => 'meter',
    '8100' => 'meter',
    '8200' => 'sq ft'
];

$base_prices = [
    '5100' => 1099,
    '3100' => 380,
    '4200' => 560,
    '8100' => 450,
    '8200' => 1299
];

$all_products = [];
$product_id_counter = 1;

foreach ($series_data as $series_code => &$series) {
    $count = $series['items'];
    $base_price = $base_prices[$series_code] ?? 500;
    $unit = $unit_map[$series_code] ?? 'unit';
    
    for ($i = 1; $i <= $count; $i++) {
        // Generate product code without leading zeros for display (3101 instead of 310001)
        $product_code_display = $series_code . $i;
        $product_code_full = $series_code . str_pad($i, 2, '0', STR_PAD_LEFT);
        $price_variation = 1 + (($i - 1) * 0.03);
        $price = round($base_price * $price_variation, 0);
        
        $product = [
            'id' => (string)$product_id_counter,
            'series' => $series_code,
            'code' => 'EWP-' . $product_code_full,
            'code_display' => $product_code_display,
            'name' => $series_code . ' Series - ' . $product_code_display,
            'price' => $price,
            'unit' => $unit,
            'image' => 'https://placehold.co/400x400/1a1a1a/d5a851?text=' . $product_code_display,
            'description' => 'Premium product from the ' . $series_code . ' series with superior finish and durability.',
            'category' => 'series'
        ];
        
        $all_products[] = $product;
        $series['products'][] = $product;
        $product_id_counter++;
    }
}
unset($series);

// ========== PRODUCT DATA (Legacy compatibility) ==========
$products = $all_products;

// ========== BLOG DATA ==========
$blogs = [
    [
        'category' => 'trends',
        'title' => '5 Interior Design Trends That Will Define 2026',
        'date' => 'March 15, 2026',
        'image' => 'https://placehold.co/600x400/2a2a2a/848461?text=Trends+2026',
        'excerpt' => 'From biophilic design to textured wall panels, discover the top trends shaping modern interiors this year.'
    ],
    [
        'category' => 'tips',
        'title' => 'How to Choose the Perfect Wall Panels for Your Space',
        'date' => 'March 10, 2026',
        'image' => 'https://placehold.co/600x400/1a1a1a/7e7c64?text=Wall+Panel+Guide',
        'excerpt' => 'Expert advice on selecting the right materials, finishes, and styles to elevate any room in your home.'
    ],
    [
        'category' => 'innovation',
        'title' => 'Manufacturing Excellence: Inside Swastik Moulds',
        'date' => 'March 5, 2026',
        'image' => 'https://placehold.co/600x400/2a2a2a/848461?text=Manufacturing',
        'excerpt' => 'Take a behind-the-scenes look at the technology and craftsmanship that powers Elegancia\'s premium products.'
    ],
    [
        'category' => 'projects',
        'title' => 'Luxury Hotel Redesign: A Case Study in Elegance',
        'date' => 'February 28, 2026',
        'image' => 'https://placehold.co/600x400/1a1a1a/7e7c64?text=Luxury+Hotel',
        'excerpt' => 'How Elegancia\'s wall panels and cornices transformed a heritage hotel into a modern luxury destination.'
    ],
    [
        'category' => 'trends',
        'title' => 'The Rise of Minimalist Luxury in Interior Design',
        'date' => 'February 20, 2026',
        'image' => 'https://placehold.co/600x400/2a2a2a/848461?text=Minimalist',
        'excerpt' => 'Explore how clean lines, natural materials, and subtle elegance are redefining modern living spaces.'
    ],
    [
        'category' => 'tips',
        'title' => 'Skirting Boards: The Finishing Touch Your Home Needs',
        'date' => 'February 14, 2026',
        'image' => 'https://placehold.co/600x400/1a1a1a/7e7c64?text=Skirting+Guide',
        'excerpt' => 'Learn how to choose and install skirting boards that complement your interior style perfectly.'
    ]
];

// ========== GALLERY DATA ==========
$gallery_items = [
    [
        'category' => 'living',
        'title' => 'Modern Elegance Living',
        'description' => 'Premium wall panels & cornices',
        'image' => 'https://placehold.co/600x450/2a2a2a/848461?text=Living+Room+1'
    ],
    [
        'category' => 'living',
        'title' => 'Contemporary Living Space',
        'description' => 'Decorative mouldings & panels',
        'image' => 'https://placehold.co/600x450/1a1a1a/7e7c64?text=Living+Room+2'
    ],
    [
        'category' => 'bedroom',
        'title' => 'Serene Bedroom Retreat',
        'description' => 'Ceiling cornices & wall accents',
        'image' => 'https://placehold.co/600x450/2a2a2a/848461?text=Bedroom+1'
    ],
    [
        'category' => 'bedroom',
        'title' => 'Minimalist Bedroom',
        'description' => 'Elegant skirting & panels',
        'image' => 'https://placehold.co/600x450/1a1a1a/7e7c64?text=Bedroom+2'
    ],
    [
        'category' => 'office',
        'title' => 'Corporate Office Interior',
        'description' => 'Wall panels & decorative mouldings',
        'image' => 'https://placehold.co/600x450/2a2a2a/848461?text=Office+1'
    ],
    [
        'category' => 'office',
        'title' => 'Executive Office Space',
        'description' => 'Premium cornices & skirting',
        'image' => 'https://placehold.co/600x450/1a1a1a/7e7c64?text=Office+2'
    ],
    [
        'category' => 'hospitality',
        'title' => 'Luxury Hotel Lobby',
        'description' => 'Decorative panels & cornices',
        'image' => 'https://placehold.co/600x450/2a2a2a/848461?text=Hotel+1'
    ],
    [
        'category' => 'hospitality',
        'title' => 'Fine Dining Restaurant',
        'description' => 'Wall mouldings & decorative accents',
        'image' => 'https://placehold.co/600x450/1a1a1a/7e7c64?text=Restaurant+1'
    ],
    [
        'category' => 'retail',
        'title' => 'Boutique Retail Store',
        'description' => 'Modern wall panels & mouldings',
        'image' => 'https://placehold.co/600x450/2a2a2a/848461?text=Retail+1'
    ],
    [
        'category' => 'retail',
        'title' => 'Product Showroom',
        'description' => 'Ceiling cornices & wall panels',
        'image' => 'https://placehold.co/600x450/1a1a1a/7e7c64?text=Showroom+1'
    ]
];

// ========== TESTIMONIALS ==========
$testimonials = [
    [
        'name' => 'Kanhaiya Agrawal',
        'location' => 'Rajnandgaon, Chhattisgarh',
        'text' => '"Excellent experience..owner is very co.operative & helpful. product quality is best."',
        'rating' => 5
    ],
    [
        'name' => 'Rajendra Yadav',
        'location' => 'Pune, Maharashtra',
        'text' => '"Decorative Wall Panel – excellent quality. Highly recommended."',
        'rating' => 5
    ],
    [
        'name' => 'Sohil',
        'location' => 'Valsad, Gujarat',
        'text' => '"Charcoal Wall Panels – great finish and fast delivery."',
        'rating' => 5
    ]
];

// ========== APPLICATIONS DATA ==========
$applications = [
    [
        'category' => 'Residential',
        'title' => 'Living Room',
        'description' => 'Elevate your living space with elegant wall panels and mouldings that create a sophisticated, welcoming atmosphere.',
        'image' => 'https://placehold.co/600x400/2a2a2a/848461?text=Living+Room'
    ],
    [
        'category' => 'Residential',
        'title' => 'Bedroom',
        'description' => 'Create a serene retreat with our decorative cornices and wall panels, adding warmth and character to your personal space.',
        'image' => 'https://placehold.co/600x400/1a1a1a/7e7c64?text=Bedroom'
    ],
    [
        'category' => 'Residential',
        'title' => 'Kitchen & Dining',
        'description' => 'Add a touch of elegance to your kitchen and dining area with our durable, easy-to-clean mouldings and panels.',
        'image' => 'https://placehold.co/600x400/2a2a2a/848461?text=Kitchen'
    ],
    [
        'category' => 'Commercial',
        'title' => 'Office Spaces',
        'description' => 'Impress clients and boost productivity with professional, aesthetically pleasing wall solutions and decorative accents.',
        'image' => 'https://placehold.co/600x400/1a1a1a/7e7c64?text=Office'
    ],
    [
        'category' => 'Commercial',
        'title' => 'Retail & Showrooms',
        'description' => 'Enhance brand perception with premium interior finishes that create an inviting and memorable customer experience.',
        'image' => 'https://placehold.co/600x400/2a2a2a/848461?text=Retail'
    ],
    [
        'category' => 'Hospitality',
        'title' => 'Hotels & Resorts',
        'description' => 'Deliver luxury and comfort with our extensive range of decorative products, designed for high-traffic hospitality environments.',
        'image' => 'https://placehold.co/600x400/1a1a1a/7e7c64?text=Hotel'
    ],
    [
        'category' => 'Hospitality',
        'title' => 'Restaurants & Cafes',
        'description' => 'Set the perfect ambiance with our decorative cornices and wall panels, creating a unique dining experience.',
        'image' => 'https://placehold.co/600x400/2a2a2a/848461?text=Restaurant'
    ],
    [
        'category' => 'Commercial',
        'title' => 'Reception Areas',
        'description' => 'Make a powerful first impression with elegant wall mouldings and decorative panels that reflect your brand\'s identity.',
        'image' => 'https://placehold.co/600x400/1a1a1a/7e7c64?text=Reception'
    ]
];

// ========== COMPANY FACTSHEET ==========
$company_factsheet = [
    'Nature of Business' => 'Manufacturer',
    'Additional Business' => 'Factory / Manufacturing',
    'Company CEO' => 'Monak Goyal',
    'Registered Address' => 'Ratia, Fatehabad, Haryana - 125051',
    'Total Employees' => '11 to 25 People',
    'GST Registration Date' => '01-07-2017',
    'Legal Status' => 'Partnership',
    'Annual Turnover' => '1.5 - 5 Cr',
    'GST No.' => '06ACYFS5052N1Z9',
    'IEC Code' => 'ACYFS5052N',
    'Banker' => 'HDFC BANK',
    'Payment Mode' => 'Cash, Credit Card, Cheque, DD',
    'Shipment Mode' => 'By Road',
    'GST Partner' => 'Ashwani Kumar, Monak Goel'
];

// Get current page name
$current_page = basename($_SERVER['PHP_SELF']);

// ========== SESSION START ==========
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ========== PINTEREST INITIALIZATION ==========
function initPinterestCatalog() {
    if (!defined('PINTEREST_ENABLED') || !PINTEREST_ENABLED || empty(PINTEREST_ACCESS_TOKEN)) {
        return null;
    }
    
    try {
        require_once INCLUDES_PATH . '/PinterestAPI.php';
        return new PinterestAPI();
    } catch (Exception $e) {
        error_log('Pinterest initialization failed: ' . $e->getMessage());
        return null;
    }
}

// Create tables on first run
$pdo = getDBConnection();
if ($pdo) {
    try {
        $stmt = $pdo->query("SHOW TABLES LIKE 'orders'");
        if ($stmt->rowCount() == 0) {
            require_once INCLUDES_PATH . '/functions.php';
            if (function_exists('createDatabaseTables')) {
                createDatabaseTables();
            }
        }
    } catch (Exception $e) {
        // Tables might not exist yet
    }
}
?>
<?php
// config.php - Global configuration file
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

// ========== DATABASE CONFIGURATION (LOCALHOST) ==========
define('DB_HOST', 'localhost');
define('DB_NAME', 'elegancia_db');
define('DB_USER', 'root');
define('DB_PASS', ''); // Leave empty for localhost (XAMPP/WAMP)

// ========== EMAIL CONFIGURATION (LOCALHOST) ==========
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

// ========== PRODUCT DATA (FIXED WITH CORRECT IDs) ==========
$products = [
    [
        'id' => '1',
        'category' => 'panels',
        'name' => '5300 Series Wall Panel',
        'code' => 'EWP-5300',
        'price' => 1299,
        'unit' => 'sq ft',
        'image' => 'https://placehold.co/400x400/2a2a2a/848461?text=5300+Series'
    ],
    [
        'id' => '2',
        'category' => 'panels',
        'name' => '5100 Series Wall Panel',
        'code' => 'EWP-5100',
        'price' => 1099,
        'unit' => 'sq ft',
        'image' => 'https://placehold.co/400x400/1a1a1a/7e7c64?text=5100+Series'
    ],
    [
        'id' => '3',
        'category' => 'mouldings',
        'name' => 'Photo Frame Moulding',
        'code' => 'EPM-220',
        'price' => 450,
        'unit' => 'meter',
        'image' => 'https://placehold.co/400x400/2a2a2a/848461?text=Photo+Frame+Moulding'
    ],
    [
        'id' => '4',
        'category' => 'mouldings',
        'name' => 'Decorative Wall Moulding',
        'code' => 'EPM-310',
        'price' => 380,
        'unit' => 'meter',
        'image' => 'https://placehold.co/400x400/1a1a1a/7e7c64?text=Wall+Moulding'
    ],
    [
        'id' => '5',
        'category' => 'cornices',
        'name' => 'Ceiling Cornice 4200',
        'code' => 'ECC-4200',
        'price' => 560,
        'unit' => 'meter',
        'image' => 'https://placehold.co/400x400/2a2a2a/848461?text=Ceiling+Cornice'
    ],
    [
        'id' => '6',
        'category' => 'cornices',
        'name' => 'PU Decorative Cornice',
        'code' => 'EPC-210',
        'price' => 720,
        'unit' => 'meter',
        'image' => 'https://placehold.co/400x400/1a1a1a/7e7c64?text=PU+Cornice'
    ],
    [
        'id' => '7',
        'category' => 'skirting',
        'name' => 'Premium Skirting Board',
        'code' => 'ESK-120',
        'price' => 320,
        'unit' => 'meter',
        'image' => 'https://placehold.co/400x400/2a2a2a/848461?text=Skirting'
    ],
    [
        'id' => '8',
        'category' => 'adhesives',
        'name' => 'Griptech Nail Free Adhesive',
        'code' => 'EAD-101',
        'price' => 280,
        'unit' => 'unit',
        'image' => 'https://placehold.co/400x400/1a1a1a/7e7c64?text=Adhesive'
    ],
    [
        'id' => '9',
        'category' => 'adhesives',
        'name' => 'Silicone Sealant',
        'code' => 'ESS-200',
        'price' => 350,
        'unit' => 'unit',
        'image' => 'https://placehold.co/400x400/2a2a2a/848461?text=Sealant'
    ],
    [
        'id' => '10',
        'category' => 'panels',
        'name' => 'Charcoal Wall Panel',
        'code' => 'EWP-2100',
        'price' => 1450,
        'unit' => 'sq ft',
        'image' => 'https://placehold.co/400x400/1a1a1a/7e7c64?text=Charcoal+Panel'
    ],
    [
        'id' => '11',
        'category' => 'mouldings',
        'name' => 'Wooden Frame Moulding',
        'code' => 'EPM-440',
        'price' => 520,
        'unit' => 'meter',
        'image' => 'https://placehold.co/400x400/2a2a2a/848461?text=Wood+Moulding'
    ],
    [
        'id' => '12',
        'category' => 'cornices',
        'name' => 'Modern Ceiling Cornice',
        'code' => 'ECC-5100',
        'price' => 680,
        'unit' => 'meter',
        'image' => 'https://placehold.co/400x400/1a1a1a/7e7c64?text=Cornice+Modern'
    ]
];

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
    ],
    [
        'category' => 'innovation',
        'title' => 'Sustainable Interiors: Eco-Friendly Decorative Solutions',
        'date' => 'February 8, 2026',
        'image' => 'https://placehold.co/600x400/2a2a2a/848461?text=Eco+Friendly',
        'excerpt' => 'Discover how Elegancia is leading the way with sustainable materials and responsible manufacturing.'
    ],
    [
        'category' => 'projects',
        'title' => 'Modern Office Design: Boosting Productivity with Elegance',
        'date' => 'February 1, 2026',
        'image' => 'https://placehold.co/600x400/1a1a1a/7e7c64?text=Office+Design',
        'excerpt' => 'How the right interior solutions can create a workspace that inspires creativity and efficiency.'
    ],
    [
        'category' => 'trends',
        'title' => 'Color Trends: The Palettes Shaping Interior Design',
        'date' => 'January 25, 2026',
        'image' => 'https://placehold.co/600x400/2a2a2a/848461?text=Color+Trends',
        'excerpt' => 'From warm earth tones to bold jewel hues, explore the color trends making waves in interior design.'
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
    ],
    [
        'category' => 'living',
        'title' => 'Open Plan Living',
        'description' => 'Decorative wall solutions',
        'image' => 'https://placehold.co/600x450/2a2a2a/848461?text=Living+Room+3'
    ],
    [
        'category' => 'bedroom',
        'title' => 'Master Bedroom Suite',
        'description' => 'Premium wall panels & cornices',
        'image' => 'https://placehold.co/600x450/1a1a1a/7e7c64?text=Bedroom+3'
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

// Category icons mapping
$category_icons = [
    'panels' => 'fa-palette',
    'mouldings' => 'fa-ruler-combined',
    'cornices' => 'fa-archway',
    'skirting' => 'fa-border-all',
    'adhesives' => 'fa-flask'
];

// Get current page name
$current_page = basename($_SERVER['PHP_SELF']);

// ========== SESSION START ==========
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Create tables on first run
$pdo = getDBConnection();
if ($pdo) {
    try {
        // Check if tables exist
        $stmt = $pdo->query("SHOW TABLES LIKE 'orders'");
        if ($stmt->rowCount() == 0) {
            require_once INCLUDES_PATH . '/functions.php';
            createDatabaseTables();
        }
    } catch (Exception $e) {
        // Tables might not exist yet
    }
}
?>
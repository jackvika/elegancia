<?php
// admin/pinterest-dashboard.php - Pinterest Management Dashboard
// DO NOT REMOVE OR MODIFY ANYTHING IN THIS FILE

require_once __DIR__ . '/../config.php';
require_once INCLUDES_PATH . '/PinterestAPI.php';

$page_title = 'Pinterest Dashboard';
$current_page = 'admin';
$additional_css = '
<style>
  .admin-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
  }
  .admin-header {
    padding: 120px 0 30px;
    border-bottom: 1px solid rgba(213,168,81,0.06);
    margin-bottom: 30px;
  }
  .admin-header h1 {
    color: var(--text-strong);
    font-size: 2rem;
  }
  .admin-header .status {
    display: inline-block;
    padding: 4px 16px;
    border-radius: 50px;
    font-size: 0.8rem;
    font-weight: 600;
  }
  .status.online { background: rgba(45, 138, 78, 0.2); color: #2d8a4e; }
  .status.offline { background: rgba(231, 76, 60, 0.2); color: #e74c3c; }
  
  .dashboard-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 20px;
    margin-top: 20px;
  }
  .dashboard-card {
    background: var(--dark-light);
    border-radius: var(--radius);
    padding: 24px;
    border: 1px solid rgba(213,168,81,0.06);
  }
  .dashboard-card h3 {
    color: var(--text-strong);
    font-size: 1rem;
    margin-bottom: 12px;
  }
  .dashboard-card .stat {
    font-size: 2rem;
    font-weight: 700;
    color: var(--gold);
  }
  .dashboard-card .label {
    color: var(--text-muted);
    font-size: 0.8rem;
  }
  .btn-pinterest {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 24px;
    background: #e60023;
    color: #fff;
    border: none;
    border-radius: 50px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
  }
  .btn-pinterest:hover {
    background: #b8001c;
    transform: translateY(-2px);
  }
  .btn-pinterest.secondary {
    background: var(--dark);
    border: 1px solid rgba(213,168,81,0.1);
    color: var(--text-strong);
  }
  .btn-pinterest.secondary:hover {
    border-color: var(--gold);
    color: var(--gold);
  }
  .sync-status {
    margin-top: 12px;
    padding: 12px;
    border-radius: var(--radius-sm);
    background: var(--dark);
    font-size: 0.85rem;
  }
  .sync-status.success { border-left: 3px solid #2d8a4e; }
  .sync-status.error { border-left: 3px solid #e74c3c; }
</style>
';

include INCLUDES_PATH . '/header.php';

// Initialize Pinterest API
$pinterest = null;
$isConnected = false;
$statusMessage = '';

if (defined('PINTEREST_ENABLED') && PINTEREST_ENABLED && !empty(PINTEREST_ACCESS_TOKEN)) {
    try {
        $pinterest = new PinterestAPI();
        $isConnected = true;
        // Test connection by getting catalog
        try {
            $catalogInfo = $pinterest->getCatalog();
            $statusMessage = 'Connected to Pinterest API';
        } catch (Exception $e) {
            $statusMessage = 'Connected but catalog not found: ' . $e->getMessage();
        }
    } catch (Exception $e) {
        $statusMessage = 'Error connecting to Pinterest: ' . $e->getMessage();
    }
} else {
    $statusMessage = 'Pinterest is not configured or no access token found.';
}

// Handle sync request
$syncResult = null;
if ($_POST['action'] ?? '' === 'sync' && $isConnected) {
    try {
        global $all_products;
        $result = $pinterest->syncProducts($all_products);
        $syncResult = ['success' => true, 'message' => 'Products synced successfully!', 'data' => $result];
    } catch (Exception $e) {
        $syncResult = ['success' => false, 'message' => 'Sync failed: ' . $e->getMessage()];
    }
}

// Handle create product groups
if ($_POST['action'] ?? '' === 'create_groups' && $isConnected) {
    try {
        $groupsCreated = [];
        foreach ($series_data as $code => $series) {
            $filter = $pinterest->createSeriesFilter($code);
            $groupResult = $pinterest->createProductGroup(
                $series['name'] . ' - ' . date('Y-m-d'),
                $filter
            );
            $groupsCreated[$code] = $groupResult;
        }
        $syncResult = ['success' => true, 'message' => 'Product groups created successfully!', 'data' => $groupsCreated];
    } catch (Exception $e) {
        $syncResult = ['success' => false, 'message' => 'Failed to create product groups: ' . $e->getMessage()];
    }
}

// Get product groups
$productGroups = [];
if ($isConnected) {
    try {
        $productGroups = $pinterest->listProductGroups();
    } catch (Exception $e) {
        // Ignore
    }
}
?>

<div class="admin-container">
    <div class="admin-header">
        <h1>Pinterest Catalog Management</h1>
        <div style="display: flex; align-items: center; gap: 12px; margin-top: 8px;">
            <span class="status <?php echo $isConnected ? 'online' : 'offline'; ?>">
                <?php echo $isConnected ? '✓ Connected' : '✗ Disconnected'; ?>
            </span>
            <span style="color: var(--text-muted); font-size: 0.85rem;"><?php echo $statusMessage; ?></span>
        </div>
    </div>

    <?php if ($syncResult): ?>
    <div class="sync-status <?php echo $syncResult['success'] ? 'success' : 'error'; ?>">
        <strong><?php echo $syncResult['success'] ? '✓' : '✗'; ?></strong>
        <?php echo $syncResult['message']; ?>
    </div>
    <?php endif; ?>

    <div style="display: flex; gap: 12px; flex-wrap: wrap; margin-bottom: 20px;">
        <form method="POST" style="display: inline;">
            <input type="hidden" name="action" value="sync" />
            <button type="submit" class="btn-pinterest">
                <i class="fas fa-sync"></i> Sync Products to Pinterest
            </button>
        </form>
        <form method="POST" style="display: inline;">
            <input type="hidden" name="action" value="create_groups" />
            <button type="submit" class="btn-pinterest secondary">
                <i class="fas fa-layer-group"></i> Create Product Groups
            </button>
        </form>
        <a href="pinterest-callback.php" class="btn-pinterest secondary">
            <i class="fas fa-key"></i> Re-authenticate
        </a>
    </div>

    <!-- Dashboard Stats -->
    <div class="dashboard-grid">
        <div class="dashboard-card">
            <h3>Total Products</h3>
            <div class="stat"><?php echo count($all_products); ?></div>
            <div class="label">Products in catalog</div>
        </div>
        <div class="dashboard-card">
            <h3>Product Series</h3>
            <div class="stat"><?php echo count($series_data); ?></div>
            <div class="label">Product series</div>
        </div>
        <div class="dashboard-card">
            <h3>Product Groups</h3>
            <div class="stat"><?php echo isset($productGroups['items']) ? count($productGroups['items']) : 0; ?></div>
            <div class="label">Pinterest product groups</div>
        </div>
        <div class="dashboard-card">
            <h3>Catalog ID</h3>
            <div style="font-size: 0.85rem; color: var(--text-muted); word-break: break-all;">
                <?php echo defined('PINTEREST_CATALOG_ID') ? PINTEREST_CATALOG_ID : 'Not set'; ?>
            </div>
            <div class="label">Current catalog</div>
        </div>
    </div>

    <!-- Product Groups -->
    <?php if (isset($productGroups['items']) && count($productGroups['items']) > 0): ?>
    <div style="margin-top: 30px;">
        <h3 style="color: var(--text-strong); margin-bottom: 16px;">Product Groups</h3>
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 12px;">
            <?php foreach ($productGroups['items'] as $group): ?>
            <div style="background: var(--dark); padding: 16px; border-radius: var(--radius-sm); border: 1px solid rgba(213,168,81,0.04);">
                <strong style="color: var(--text-strong);"><?php echo htmlspecialchars($group['name']); ?></strong>
                <div style="font-size: 0.75rem; color: var(--text-muted);">
                    ID: <?php echo $group['id']; ?>
                </div>
                <div style="font-size: 0.7rem; color: var(--text-muted); margin-top: 4px;">
                    Products: <?php echo $group['product_count'] ?? 'N/A'; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- Product List -->
    <div style="margin-top: 30px;">
        <h3 style="color: var(--text-strong); margin-bottom: 16px;">Product Catalog Preview</h3>
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; font-size: 0.85rem;">
                <thead>
                    <tr style="border-bottom: 1px solid rgba(213,168,81,0.06);">
                        <th style="padding: 10px 12px; text-align: left; color: var(--text-muted);">ID</th>
                        <th style="padding: 10px 12px; text-align: left; color: var(--text-muted);">Code</th>
                        <th style="padding: 10px 12px; text-align: left; color: var(--text-muted);">Name</th>
                        <th style="padding: 10px 12px; text-align: left; color: var(--text-muted);">Series</th>
                        <th style="padding: 10px 12px; text-align: left; color: var(--text-muted);">Price</th>
                        <th style="padding: 10px 12px; text-align: left; color: var(--text-muted);">Category</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (array_slice($all_products, 0, 20) as $product): ?>
                    <tr style="border-bottom: 1px solid rgba(213,168,81,0.02);">
                        <td style="padding: 8px 12px; color: var(--text-body);"><?php echo $product['id']; ?></td>
                        <td style="padding: 8px 12px; color: var(--text-body);"><?php echo $product['code']; ?></td>
                        <td style="padding: 8px 12px; color: var(--text-strong);"><?php echo $product['name']; ?></td>
                        <td style="padding: 8px 12px; color: var(--text-body);"><?php echo $product['series']; ?></td>
                        <td style="padding: 8px 12px; color: var(--gold);">₹<?php echo number_format($product['price']); ?></td>
                        <td style="padding: 8px 12px; color: var(--text-body);"><?php echo $product['category']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php if (count($all_products) > 20): ?>
            <div style="padding: 12px; text-align: center; color: var(--text-muted); font-size: 0.8rem;">
                Showing 20 of <?php echo count($all_products); ?> products
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include INCLUDES_PATH . '/footer.php'; ?>
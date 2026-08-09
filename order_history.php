<?php
session_start();
require_once 'connection.php';

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['id'];
$username = $_SESSION['username'] ?? 'User';

// Ensure orders table exists
$conn->query("CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    mess_id INT NOT NULL,
    user_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    address TEXT NOT NULL,
    payment_method VARCHAR(50) NOT NULL,
    location VARCHAR(100) NOT NULL,
    status VARCHAR(50) DEFAULT 'Pending',
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

$stmt = $conn->prepare("SELECT o.*, m.mess_name, m.menu_name, m.menu_price FROM orders o LEFT JOIN mess m ON o.mess_id = m.id WHERE o.user_id = ? ORDER BY o.id DESC");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$orders = [];
while ($row = $result->fetch_assoc()) {
    $orders[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="assets/css/complete-style.css">
    <link rel="stylesheet" href="assets/css/main-style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders - TiffinElite</title>
    <link rel="stylesheet" href="assets/css/tokens.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
        body {
            background-color: var(--color-bg);
            font-family: var(--font-base);
            color: var(--color-text);
        }
        .order-container {
            max-width: 1000px;
            margin: var(--space-4) auto;
            padding: 0 20px;
        }
        .page-title {
            font-size: var(--font-size-xl);
            margin-bottom: var(--space-3);
            color: var(--color-secondary);
        }
        .order-card {
            background: var(--color-surface);
            border-radius: var(--card-radius);
            box-shadow: var(--card-shadow);
            border: 1px solid var(--color-border);
            padding: var(--space-4);
            margin-bottom: var(--space-3);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: var(--space-3);
        }
        .status-badge {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
        }
        .status-pending { background: #FEF3C7; color: #D97706; }
        .status-confirmed { background: #E0F2FE; color: #0284C7; }
        .status-delivered { background: #DCFCE7; color: #16A34A; }
    </style>
</head>
<body>
    <header style="background: var(--color-secondary); padding: 15px 30px; display: flex; align-items: center; justify-content: space-between;">
        <div class="header-logo">
            <a href="home.php"><img src="assets/img/logo.jpg" alt="TiffinElite" style="height: 40px;"></a>
        </div>
        <nav style="display: flex; gap: 20px; align-items: center;">
            <a href="home.php" style="color: #fff; text-decoration: none;">Home</a>
            <a href="cart.php" style="color: #fff; text-decoration: none;">Cart</a>
            <a href="order_history.php" style="color: var(--color-primary); font-weight: 700; text-decoration: none;">My Orders</a>
            <a href="logout.php" style="color: #fff; text-decoration: none;">Logout</a>
        </nav>
    </header>

    <div class="order-container">
        <h1 class="page-title"><i class="fa-solid fa-bag-shopping"></i> My Orders History</h1>

        <?php if (count($orders) > 0): ?>
            <?php foreach ($orders as $order): ?>
                <div class="order-card">
                    <div>
                        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 6px;">
                            <h3 style="margin: 0; font-size: var(--font-size-lg);"><?php echo htmlspecialchars($order['mess_name'] ?? 'Tiffin Service'); ?></h3>
                            <span class="status-badge status-<?php echo strtolower($order['status'] ?? 'pending'); ?>">
                                <?php echo htmlspecialchars($order['status'] ?? 'Pending'); ?>
                            </span>
                        </div>
                        <p style="color: var(--color-text-muted); font-size: var(--font-size-sm); margin-bottom: 4px;">
                            <strong>Menu:</strong> <?php echo htmlspecialchars($order['menu_name'] ?? 'Standard Meal'); ?>
                        </p>
                        <p style="color: var(--color-text-muted); font-size: var(--font-size-sm);">
                            <i class="fa-solid fa-location-dot"></i> <?php echo htmlspecialchars($order['address']); ?> (<?php echo htmlspecialchars($order['location']); ?>)
                        </p>
                        <span style="font-size: 0.75rem; color: #9CA3AF; display: block; margin-top: 6px;">
                            Ordered on: <?php echo htmlspecialchars($order['order_date'] ?? date('Y-m-d')); ?> | Payment: <?php echo htmlspecialchars($order['payment_method']); ?>
                        </span>
                    </div>
                    <div style="text-align: right;">
                        <span class="price" style="font-size: 1.5rem; font-weight: 800; color: var(--color-primary);">₹<?php echo number_format($order['menu_price'] ?? 150, 2); ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div style="background: white; padding: 40px; text-align: center; border-radius: 12px; box-shadow: var(--card-shadow);">
                <i class="fa-solid fa-utensils" style="font-size: 3rem; color: #D1D5DB; margin-bottom: 15px;"></i>
                <h2>No Orders Yet</h2>
                <p style="color: var(--color-text-muted); margin-top: 8px;">Explore mess, hotel, and hostel listings to place your first order!</p>
                <a href="home.php" class="btn-primary" style="display: inline-block; margin-top: 20px; padding: 10px 24px;">Browse Listings</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>

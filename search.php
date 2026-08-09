<?php
session_start();
require_once 'connection.php';

$query = isset($_GET['q']) ? trim($_GET['q']) : '';
$results = [];

if (!empty($query)) {
    $search_term = "%" . $query . "%";
    
    // Mess search
    $stmt = $conn->prepare("SELECT id, mess_name AS name, menu_name, menu_price AS price, description, service_type, menu_photos FROM mess WHERE mess_name LIKE ? OR menu_name LIKE ? OR description LIKE ?");
    $stmt->bind_param("sss", $search_term, $search_term, $search_term);
    $stmt->execute();
    $res = $stmt->get_result();
    while ($row = $res->fetch_assoc()) {
        $photos = @unserialize($row['menu_photos']);
        $photo = (is_array($photos) && !empty($photos)) ? $photos[0] : 'assets/img/default-food.png';
        $results[] = [
            'id' => $row['id'],
            'type' => 'Mess',
            'title' => $row['name'],
            'subtitle' => 'Menu: ' . $row['menu_name'],
            'price' => '₹' . number_format($row['price'], 2),
            'description' => $row['description'],
            'service_type' => $row['service_type'],
            'image' => $photo
        ];
    }

    // Hotel search
    $stmt = $conn->prepare("SELECT id, hotel_name AS name, room_type, room_price AS price, amenities, service_type FROM hotel WHERE hotel_name LIKE ? OR room_type LIKE ? OR amenities LIKE ?");
    $stmt->bind_param("sss", $search_term, $search_term, $search_term);
    $stmt->execute();
    $res = $stmt->get_result();
    while ($row = $res->fetch_assoc()) {
        $results[] = [
            'id' => $row['id'],
            'type' => 'Hotel',
            'title' => $row['name'],
            'subtitle' => 'Room: ' . $row['room_type'],
            'price' => '₹' . number_format($row['price'], 2),
            'description' => $row['amenities'],
            'service_type' => $row['service_type'],
            'image' => 'assets/img/default-hotel.png'
        ];
    }

    // Hostel search
    $stmt = $conn->prepare("SELECT id, hostel_name AS name, room_type, room_price AS price, amenities, service_type FROM hostel WHERE hostel_name LIKE ? OR room_type LIKE ? OR amenities LIKE ?");
    $stmt->bind_param("sss", $search_term, $search_term, $search_term);
    $stmt->execute();
    $res = $stmt->get_result();
    while ($row = $res->fetch_assoc()) {
        $results[] = [
            'id' => $row['id'],
            'type' => 'Hostel',
            'title' => $row['name'],
            'subtitle' => 'Room: ' . $row['room_type'],
            'price' => '₹' . number_format($row['price'], 2),
            'description' => $row['amenities'],
            'service_type' => $row['service_type'],
            'image' => 'assets/img/default-hostel.png'
        ];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results - TiffinElite</title>
    <link rel="stylesheet" href="assets/css/tokens.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <style>
        .search-header {
            background: linear-gradient(135deg, var(--color-secondary), #111827);
            color: #fff;
            padding: var(--space-5) 20px;
            text-align: center;
        }
        .search-header h1 {
            font-size: var(--font-size-xl);
            margin-bottom: var(--space-2);
        }
        .container {
            max-width: 1200px;
            margin: var(--space-4) auto;
            padding: 0 20px;
        }
        .no-results {
            text-align: center;
            padding: var(--space-5);
            background: var(--color-surface);
            border-radius: var(--card-radius);
            box-shadow: var(--card-shadow);
        }
    </style>
</head>
<body>
    <header style="background: var(--color-secondary); padding: 15px 30px; display: flex; align-items: center; justify-content: space-between;">
        <div class="header-logo">
            <a href="home.php"><img src="assets/img/logo.jpg" alt="TiffinElite" style="height: 40px;"></a>
        </div>
        <form action="search.php" method="GET" class="header-search-form">
            <input type="text" name="q" value="<?php echo htmlspecialchars($query); ?>" placeholder="Search for Mess, Hotel, or Hostel..." required>
            <button type="submit">Search</button>
        </form>
        <nav style="display: flex; gap: 20px;">
            <a href="home.php" style="color: #fff; text-decoration: none;">Home</a>
            <a href="cart.php" style="color: #fff; text-decoration: none;">Cart</a>
            <a href="logout.php" style="color: #fff; text-decoration: none;">Logout</a>
        </nav>
    </header>

    <div class="search-header">
        <h1>Search Results</h1>
        <p><?php echo !empty($query) ? "Showing results for: <strong>\"" . htmlspecialchars($query) . "\"</strong>" : "Enter a search keyword above"; ?></p>
    </div>

    <div class="container">
        <?php if (!empty($query)): ?>
            <?php if (count($results) > 0): ?>
                <div class="service-grid">
                    <?php foreach ($results as $item): ?>
                        <div class="service-card">
                            <div class="card-img-wrapper">
                                <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>" onerror="this.src='assets/img/default-food.png';">
                            </div>
                            <div class="service-card-body">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                    <span class="badge"><?php echo htmlspecialchars($item['type']); ?></span>
                                    <span style="font-size: 0.8rem; color: var(--color-text-muted);"><?php echo htmlspecialchars($item['service_type']); ?></span>
                                </div>
                                <h3 class="service-card-title"><?php echo htmlspecialchars($item['title']); ?></h3>
                                <p style="font-weight: 600; font-size: 0.9rem; color: var(--color-primary-dark); margin-bottom: 6px;"><?php echo htmlspecialchars($item['subtitle']); ?></p>
                                <p class="service-card-desc"><?php echo htmlspecialchars($item['description']); ?></p>
                                <div class="service-card-meta">
                                    <span class="price"><?php echo $item['price']; ?></span>
                                    <button class="btn-primary" onclick="alert('Viewing <?php echo htmlspecialchars($item['title']); ?>')">View Details</button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="no-results">
                    <h2>No matches found</h2>
                    <p style="color: var(--color-text-muted); margin-top: 8px;">We couldn't find any mess, hotel, or hostel matching "<?php echo htmlspecialchars($query); ?>". Try searching for "Mess", "Single", "AC", or "Nashik".</p>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</body>
</html>

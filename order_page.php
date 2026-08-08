<?php
// Database connection configuration
require_once 'connection.php';
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Handle creating a new order (POST request)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    // Get order details from the front end (the data sent by the user)
    $hotel_id = $data['hotel_id'];  // Hotel ID (from hotelmenus)
    $user_name = $data['user_name']; // User details from the request
    $user_address = $data['user_address'];
    $payment_method = $data['payment_method'];
    $user_location = $data['user_location'];
    $order_date = date('Y-m-d H:i:s'); // Set the current date and time

    // Fetch hotel details (like price, dish name) from the hotelmenus table using hotel_id
    $sql = "SELECT * FROM hotelmenus WHERE id = :hotel_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':hotel_id', $hotel_id);
    $stmt->execute();
    $hotel = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$hotel) {
        echo json_encode(["success" => false, "message" => "Hotel not found"]);
        exit;
    }

    // Extract the necessary details from the fetched hotel menu data
    $hotel_name = $hotel['mess_name'];  // Hotel name from mess_name in hotelmenus
    $menu_name = $hotel['menu_name'];   // Menu name from menu_name in hotelmenus
    $price = $hotel['menu_price'];      // Menu price from menu_price in hotelmenus

    // SQL query to insert the order into the orders table
    $sql = "INSERT INTO allorders (hotel_id, hotel_name, menu_name, price, user_name, user_address, payment_method, user_location, order_date, order_status)
            VALUES (:hotel_id, :hotel_name, :menu_name, :price, :user_name, :user_address, :payment_method, :user_location, :order_date, :order_status)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':hotel_id', $hotel_id);
    $stmt->bindParam(':hotel_name', $hotel_name);
    $stmt->bindParam(':menu_name', $menu_name);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':user_name', $user_name);
    $stmt->bindParam(':user_address', $user_address);
    $stmt->bindParam(':payment_method', $payment_method);
    $stmt->bindParam(':user_location', $user_location);
    $stmt->bindParam(':order_date', $order_date);
    $stmt->bindParam(':order_status', $order_status);

    // Execute the query and return a response
    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to place order"]);
    }
    exit;
}
?>

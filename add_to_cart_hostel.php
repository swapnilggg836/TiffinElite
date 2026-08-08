<?php
header("Content-Type: application/json");

// Database configuration
require_once 'connection.php';
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $e->getMessage()]);
    exit;
}

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the JSON data from the request body
    $input = file_get_contents("php://input");
    $cartItem = json_decode($input, true);

    // Validate the input data
    if (!isset($cartItem['hotel_id'], $cartItem['hotel_name'], $cartItem['hotel_price'])) {
        echo json_encode(['success' => false, 'message' => 'Invalid input data.']);
        exit;
    }

    // Assuming user ID is fixed for now (use session for dynamic user_id)
    $user_id = 1; // Replace this with the actual logged-in user ID if available

    try {
        // Insert the cart item into the database
        $stmt = $pdo->prepare("
            INSERT INTO carthostel (hotel_id, hotel_name, hotel_price, user_id)
            VALUES (:hotel_id, :hotel_name, :hotel_price, :user_id)
        ");
        $stmt->execute([
            ':hotel_id' => $cartItem['hotel_id'],
            ':hotel_name' => $cartItem['hotel_name'],
            ':hotel_price' => $cartItem['hotel_price'],
            ':user_id' => $user_id
        ]);

        echo json_encode(['success' => true, 'message' => 'Item added to cart successfully.']);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Failed to add item to cart: ' . $e->getMessage()]);
    }
} else {
    // If the request is not a POST request, return an error
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>

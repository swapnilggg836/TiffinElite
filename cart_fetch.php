<?php
header("Content-Type: application/json");

// Database configuration
require_once 'connection.php';
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $e->getMessage()]);
    exit;
}

// Handle different request methods
$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestMethod === 'GET') {
    // Fetch data from all tables
    try {
        $cartQuery = $pdo->query("SELECT mess_id, mess_name, mess_price FROM cart");
        $cartData = $cartQuery->fetchAll(PDO::FETCH_ASSOC);

        $carthotelQuery = $pdo->query("SELECT hotel_id, hotel_name, hotel_price FROM carthotel");
        $carthotelData = $carthotelQuery->fetchAll(PDO::FETCH_ASSOC);

        $carthostelQuery = $pdo->query("SELECT * FROM carthostel");
        $carthostelData = $carthotelQuery->fetchAll(PDO::FETCH_ASSOC);


        // Uncomment the following lines if 'carthostel' data is needed
        // $carthostelQuery = $pdo->query("SELECT * FROM carthostel");
        // $carthostelData = $carthostelQuery->fetchAll(PDO::FETCH_ASSOC);

        $response = [
            'success' => true,
            'cart' => $cartData,
            'carthotel' => $carthotelData,
           
            'carthostel' => $carthostelData,
        ];

        echo json_encode($response);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Failed to fetch data: ' . $e->getMessage()]);
    }
} elseif ($requestMethod === 'DELETE') {
    $input = json_decode(file_get_contents("php://input"), true);

    if (!isset($input['id'], $input['table'])) {
        echo json_encode(['success' => false, 'message' => 'Invalid input data.']);
        exit;
    }

    $id = $input['id'];
    $table = $input['table'];
    $allowedTables = [
        'cart' => 'mess_id',
        'carthotel' => 'hotel_id',
        'carthostel' => 'hostel_id'
    ];

    if (!array_key_exists($table, $allowedTables)) {
        echo json_encode(['success' => false, 'message' => 'Invalid table name.']);
        exit;
    }

    $idColumn = $allowedTables[$table];

    try {
        $stmt = $pdo->prepare("DELETE FROM $table WHERE $idColumn = :id");
        $stmt->execute([':id' => $id]);

        echo json_encode(['success' => true, 'message' => 'Record deleted successfully.']);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Failed to delete record: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>

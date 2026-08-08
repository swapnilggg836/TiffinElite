<?php
session_start();
include "connection.php";

// Check if the request method is DELETE
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Read the input JSON data
    $input = json_decode(file_get_contents("php://input"), true);

    // Validate the input
    if (isset($input['id']) && isset($input['table'])) {
        $id = intval($input['id']);
        $table = $input['table'];

        // Whitelist table names to prevent SQL injection
        $allowedTables = ['cart', 'carthotel', 'carthostel'];
        if (!in_array($table, $allowedTables)) {
            echo json_encode(['success' => false, 'message' => 'Invalid table name.']);
            exit();
        }

        // Prepare the delete query
        $sql = "DELETE FROM $table WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Item deleted successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete item.']);
        }
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid input data.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>

<?php
header('Content-Type: application/json');
require_once 'connection.php';

// Check connection
if ($conn->connect_error) {
    echo json_encode([]);
    exit;
}

// Get user type from the request
$user_type = isset($_GET['user_type']) ? $_GET['user_type'] : '';

if ($user_type) {
    $sql = "SELECT id, username FROM admin_users WHERE user_type = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user_type);
    $stmt->execute();
    $result = $stmt->get_result();

    $admins = [];
    while ($row = $result->fetch_assoc()) {
        $admins[] = $row;
    }

    echo json_encode($admins);
} else {
    echo json_encode([]);
}

$conn->close();
?>

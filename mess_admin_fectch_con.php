<?php
header('Content-Type: application/json');
require_once 'connection.php';

// Check connection
if ($conn->connect_error) {
    echo json_encode([]);
    exit;
}

// Fetch messages for mess admins
$sql = "SELECT name, email, phone, message FROM contact_messages WHERE admin_id IN (SELECT id FROM admin_users WHERE user_type = 'mess')";
$result = $conn->query($sql);

$messages = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }
}

echo json_encode($messages);

$conn->close();
?>

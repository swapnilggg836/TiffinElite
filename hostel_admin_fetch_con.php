<?php 
header('Content-Type: application/json');
require_once 'connection.php';

// Check connection
if ($conn->connect_error) {
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Fetch messages for hostel admins
    $sql = "SELECT id, name, email, phone, message FROM contact_messages WHERE admin_id IN (SELECT id FROM admin_users WHERE user_type = 'hostel')";
    $result = $conn->query($sql);

    $messages = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $messages[] = $row;
        }
    }

    echo json_encode($messages);
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Delete a message
    parse_str(file_get_contents("php://input"), $data);
    $messageId = $data['id'] ?? null;

    if ($messageId) {
        $stmt = $conn->prepare("DELETE FROM contact_messages WHERE id = ?");
        $stmt->bind_param("i", $messageId);
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['error' => 'Failed to delete message']);
        }
        $stmt->close();
    } else {
        echo json_encode(['error' => 'Invalid message ID']);
    }
}

$conn->close();
?>

<?php
session_start();

// Database connection
require_once 'connection.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sign-up logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password for security
    $user_type = $_POST['user_type'];

    // Check if username or email already exists
    $sql = "SELECT * FROM admin_users WHERE username = ? OR email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Username or Email already exists.";
    } else {
        // Insert new user into the database
        $sql = "INSERT INTO admin_users (username, email, password, user_type) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $username, $email, $password, $user_type);
        
        if ($stmt->execute()) {
            echo "Sign-up successful! You can now <a href='signin.php'>Sign In</a>";
        } else {
            echo "Error: " . $stmt->error;
        }
    }
}

$conn->close();
?>

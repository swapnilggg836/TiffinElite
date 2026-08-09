<?php
session_start();
require 'connection.php'; // Include database connection file

// Check if the user is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin.php");
    exit();
}

// Fetch user details
$admin_id = $_SESSION['admin_id'];
$query = "SELECT * FROM admin_user WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $admin_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];

    // Update user details
    $update_query = "UPDATE admin_user SET username = ?, email = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("ssi", $username, $email, $admin_id);

    if ($update_stmt->execute()) {
        echo "Profile updated successfully!";
    } else {
        echo "Error updating profile!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="assets/css/complete-style.css">
    <link rel="stylesheet" href="assets/css/main-style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Edit Profile</h1>
    <form method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
        
        <button type="submit">Update Profile</button>
    </form>
</body>
</html>

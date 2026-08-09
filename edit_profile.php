<?php
session_start();
include "connection.php";

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile_photo'])) {
    $userId = $_SESSION['id'];
    $targetDir = "uploads/";

    // Ensure the upload directory exists
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    // Generate a unique file name
    $fileName = uniqid() . "_" . basename($_FILES['profile_photo']['name']);
    $targetFile = $targetDir . $fileName;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

    // Validate file type
    if (!in_array($imageFileType, $allowedTypes)) {
        $message = "Only JPG, JPEG, PNG, and GIF files are allowed.";
    } elseif (move_uploaded_file($_FILES['profile_photo']['tmp_name'], $targetFile)) {
        // Update the database
        $sql = "UPDATE users SET profile_photo = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $targetFile, $userId);
        if ($stmt->execute()) {
            // Redirect to home.php after successful update
            header("Location: home.php");
            exit();
        } else {
            $message = "Database update failed.";
        }
    } else {
        $message = "Failed to upload the file.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="assets/css/main-style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .edit-profile-container {
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .input-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #666;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #005bb5;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #003366;
        }

        .message {
            margin-bottom: 15px;
            padding: 10px;
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="edit-profile-container">
        <h2>Edit Profile</h2>
        <?php if ($message): ?>
            <div class="message"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <label for="profile_photo">Upload Profile Photo:</label>
            <input type="file" id="profile_photo" name="profile_photo" required>
            <button type="submit">Update Photo</button>
        </form>
    </div>
</body>
</html>

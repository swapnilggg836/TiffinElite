<?php
session_start();

// Database connection
require_once 'connection.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $fullname = htmlspecialchars(trim($_POST['fullname']));
    $username = htmlspecialchars(trim($_POST['username']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = $_POST['password'];
    $confirmPassword = $_POST['cpass'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email format.";
    } elseif ($password !== $confirmPassword) {
        $message = "Passwords do not match.";
    } else {
        // Check if email already exists
        $check = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($check);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $message = "This email is already in use. Try another one!";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (fullname, username, email, password) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $fullname, $username, $email, $hashedPassword);

            if ($stmt->execute()) {
                $message = "Registration successful! <a href='login.php'>Login Now</a>";
            } else {
                $message = "Something went wrong. Please try again later.";
            }
        }
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
    <title>Sign Up</title>
    <link rel="stylesheet" href="assets/css/tokens.css">
    <link rel="stylesheet" href="assets/css/components.css">
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.8), rgba(0, 0, 0, 0.8)), url('assets/img/your-background-image.jpg');
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .signup-container {
            background: #ffffff;
            padding: 30px;

            border-radius: 10px;
            box-shadow: 0 0 30px #99ccff;
            width: 100%;
            max-width: 400px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #003366;
        }
        .input-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #003366;
        }
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #1d1a1a;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #003366;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #005bb5;
        }
        .message {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border: 1px solid #f5c6cb;
            border-radius: 4px;
            margin-bottom: 15px;
            text-align: center;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
        }
        .input-group p {
            text-align: center;
            margin-top: 10px;
            color: black;
        }
        .input-group a {
            color: #003366;
            text-decoration: none;
        }
        .input-group a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    
    <div class="signup-container">
        <h2>Sign Up</h2>
        <?php if (isset($message)): ?>
            <div class="alert <?php echo isset($success) ? 'alert-success' : 'alert-error'; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        <form action="" method="POST">
            <div class="input-group">
                <label for="fullname">Full Name:</label>
                <input type="text" id="fullname" name="fullname" required>
            </div>
            <div class="input-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="input-group">
                <label for="cpass">Confirm Password:</label>
                <input type="password" id="cpass" name="cpass" required>
            </div>
            <div class="input-group">
                <button type="submit" name="register">Sign Up</button>
            </div>
            <div class="input-group">
                <p>Already have an account? <a href="login.php">Login here</a></p>
            </div>
        </form>
    </div>
</body>
</html>

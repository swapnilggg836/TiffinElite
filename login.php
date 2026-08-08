<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<style>
    body {
        background-color: #f4f4f9;
        font-family: Arial, sans-serif;
    }
    .header-search {
        display: none;
    }
    .contact1 {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.8), rgba(0, 0, 0, 0.8)), url('assets/img/your-background-image.jpg');
        height: 720px;
        color: #ffffff;
        align-items: center;
        justify-content: center;
        padding-top: 20px;
        display: flex;
    }
    .form1 {
        background-color: #ffffff;
        padding: 30px;
        border-radius: 10px;
        width: 90%;
        max-width: 400px;
        box-shadow: 0 0 30px #99ccff;
        align-items: center;
        justify-content: center;
    }
    .login-container {
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 300px;
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
        padding: 8px;
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
    .input-group p {
        text-align: center;
        margin-top: 10px;
        color:black;
    }
    .input-group a {
        color: #003366;
        text-decoration: none;
    }
    .input-group a:hover {
        text-decoration: underline;
    }

    /* Profile Dropdown Menu */
    .profile-dropdown {
        position: absolute;
        top: 40px;
        right: 0;
        background-color: #003366;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        display: none;
        padding: 10px;
        width: 180px;
    }

    .profile-dropdown a {
        color: #FFD700;
        padding: 5px 10px;
        display: block;
        text-decoration: none;
    }

    .profile-dropdown a:hover {
        background-color: #555;
    }

    .header-nav li:hover .profile-dropdown {
        display: block;
    }

</style>
<body class="bodyaa">
    <header>
        <div class="header-logo" id="home1">
            <a href="/">
                <img src="assets/img/logo.jpg" alt="YumDabba">
            </a>
        </div>
        <div class="header-search">
            <input type="text" placeholder="Search for Tiffin Services">
            <button>Search</button>
        </div>
        <nav class="header-nav">
            <ul>
                
                <li><a href="login.php">Login</a></li>
                <li><a href="sinup.php">Sign Up</a></li>
            </ul>
        </nav>
    </header>
      
    <?php
    session_start();
    include "connection.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
        $username = htmlspecialchars($_POST['username']);
        $password = $_POST['password'];

        // Prepare statement to prevent SQL injection
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashedPassword = $row['password'];

            // Verify password
            if (password_verify($password, $hashedPassword)) {
                $_SESSION['id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                header("Location: home.php");
                exit();
            } else {
                echo "<div class='message'><p>Incorrect Password</p></div>";
            }
        } else {
            echo "<div class='message'><p>Incorrect Username or Password</p></div>";
        }
    }
    ?>

    <section class="contact1" id="contact">
        <div class="login-container">
            <h2>Login</h2>
            <form action="" method="POST" class="form1">
                <div class="input-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="input-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="input-group">
                    <button type="submit" name="login" class="btn">Login</button>
                </div>
                <div class="input-group">
                    <p>Don't have an account? <a href="sinup.php">Register here</a></p>
                </div>
            </form>
        </div>
    </section>
</body>
</html>

<?php
session_start();

// Database connection
require_once 'connection.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Contact form logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $admin_id = $_POST['admin_id'];
    $message = $_POST['message'];

    // Validate admin existence
    $sql = "SELECT * FROM admin_users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $admin_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        echo "Invalid admin selected.";
    } else {
        // Insert message into the database
        $sql = "INSERT INTO contact_messages (name, email, phone, admin_id, message) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssds", $name, $email, $phone, $admin_id, $message);

        if ($stmt->execute()) {
            echo "Message sent successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }
    }
}

$conn->close();
?>
<?php

include "connection.php";

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Fetch user data
$userId = $_SESSION['id'];
$sql = "SELECT username, profile_photo FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$profilePhoto = $user['profile_photo'] ?? 'assets/img/default-profile.png';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="assets/css/main-style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f9f9f9;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.8), rgba(0, 0, 0, 0.8));
        }

        form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 30px 50px rgba(229, 235, 237, 0.1);
           
            max-width: 600px;
            margin: auto;
        }

        form h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        form input, form select, form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        form button {
            background-color: #003366;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        form button:hover {
            background-color: #005bb5;
        }
           /* Header Styles */
           header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background-color: black;
            color: #FFD700;
            border-radius:10px;
        }

        .header-logo img {
            height: 40px;
            border-radius: 50%;
            box-shadow: 0 0 20px yellow;
        }

        .header-search {
            display: flex;
            align-items: center;
            margin: 0 10px;
        }

        .header-search input[type="text"] {
            padding: 10px;
            border: 1px solid #FFD700;
            border-radius: 5px;
            font-size: 14px;
            width: 300px;
            outline: none;
        }

        .header-search button {
            padding: 10px;
            background-color: #FFD700;
            color: #000;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .header-search button:hover {
            background-color:rgb(13, 78, 106);
        }

        .header-nav ul {
            display: flex;
            list-style: none;
        }

        .header-nav li {
            margin: 0 10px;
            position: relative;
        }

        .header-nav a {
            color: #FFD700;
            text-decoration: none;
            font-size: 14px;
        }

        .header-nav a:hover {
            text-decoration: underline;
        }
        
        /* Profile Dropdown Menu */
        .profile-dropdown {
            position: absolute;
            top: 40px;
            right: 0;
            background-color: #000;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            display: none;
            padding: 10px;
            width: 180px;
        }

        .profile-dropdown a {
            color:rgb(161, 237, 246);
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

        /* Profile Image */
        .profile-image {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 10px;
        }

       /* Footer Styles */
.foot {
    background-color:rgb(7, 8, 8);
    text-align: center;
    padding: 20px;
    color: #fff;
    margin-top: 20px;
    box-shadow: 0 -4px 6px rgba(0, 0, 0, 0.1);
}

.footer-links a {
    color: #fff;
    text-decoration: none;
    font-size: 14px;
    margin: 0 10px;
    transition: color 0.3s;
}

.footer-links a:hover {
    color: #FFD700;
}

.social-icons a {
    color: #fff;
    font-size: 24px;
    margin: 0 5px;
    transition: color 0.3s;
}

.social-icons a:hover {
    color: #FFD700;
}

/* Animations */
@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

/* Responsive Design */
@media (max-width: 768px) {
    .header-search input[type="text"] {
        width: 200px;
    }

    .main-content h1 {
        font-size: 32px;
    }

    .section {
        grid-template-columns: 1fr 1fr;
    }
}

@media (max-width: 480px) {
    .section {
        grid-template-columns: 1fr;
    }

    .header-search input[type="text"] {
        width: 150px;
    }

        }
    </style>
</head>
<body>
<header>
        <div class="header-logo">
            <a href="/">
                <img src="assets/img/logo.jpg" alt="YumDabba">
            </a>
        </div>
        
        <nav class="header-nav">
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="cart.php">cart</a></li>
                <li><a href="admin.php">admin</a></li>
                <li>
                    <a href="#" class="drop-down">
                        <img src="<?php echo htmlspecialchars($profilePhoto); ?>" alt="User Photo" class="profile-image">
                        
                    </a>
                    <div class="profile-dropdown">
                        <a href="edit_profile.php">Edit Profile</a>
                        <a href="settings.php">Settings</a>
                        <a href="privacy.php">Privacy</a>
                        <a href="help.php">Help and Support</a>
                        <a href="display_accessibility.php">Display & Accessibility</a>
                        <a href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
    </header>
    <form action="contact.php" method="POST">
        <h2>Contact Admin</h2>
        <label for="name">Your Name:</label>
        <input type="text" id="name" name="name" placeholder="Enter your name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" placeholder="Enter your phone number" required>

        <label for="user_type">Admin Type:</label>
        <select id="user_type" onchange="fetchAdmins()" required>
            <option value="">Select Type</option>
            <option value="hotel">Hotel</option>
            <option value="mess">Mess</option>
            <option value="hostel">Hostel</option>
        </select>

        <label for="admin_id">Select Admin:</label>
        <select id="admin_id" name="admin_id" required>
            <option value="">Select Admin</option>
        </select>

        <label for="message">Message:</label>
        <textarea id="message" name="message" rows="5" placeholder="Enter your message" required></textarea>

        <button type="submit">Send Message</button>
    </form>
    <footer class="foot">
        <div class="footer-links">
            <a href="settings.php">Settings</a>
            <a href="privacy.php">Privacy</a>
            <a href="help.php">Help & Support</a>
            <a href="display_accessibility.php">Display & Accessibility</a>
            <a href="supplier.php">Supplier</a>
        </div>
        <div class="social-icons" style="color:white;">
            <a href="https://github.com" target="_blank" style="color:white;" ><i class="fa-brands fa-instagram"></i></a>
            <a href="https://instagram.com" target="_blank" style="color:white;"><i class="fa-brands fa-github"></i></a>
            <a href="https://linkedin.com" target="_blank" style="color:white;"><i class="fa-brands fa-github"></i></a>
            <a href="https://twitter.com" target="_blank" style="color:white;"><i class="fa-brands fa-github"></i></a>
        </div>
        <h5 style="color:white;">@created by group 6</h5>
    </footer>
    <script>
        function fetchAdmins() {
            const userType = document.getElementById('user_type').value;
            const adminSelect = document.getElementById('admin_id');

            // Clear previous options
            adminSelect.innerHTML = '<option value="">Select Admin</option>';

            if (userType) { 
                fetch(`fetchadmin.php?user_type=${userType}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(admin => {
                            const option = document.createElement('option');
                            option.value = admin.id;
                            option.textContent = admin.username;
                            adminSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error fetching admins:', error));
            }
        }
    </script>
</body>
</html>

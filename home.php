
<?php
session_start();
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiffin Services</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets\css\fetchdata.css">
    <link rel="stylesheet" href="assets\css\fetchdatahotel.css">
    <link rel="stylesheet" href="assets\css\fetchdatahostel.css">
    <style>
        /* Reset and Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            
        }

        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.8), rgba(0, 0, 0, 0.8)), url('assets/img/your-background-image.jpg');
            color: #fff;
            margin: 0;
            
            
        }

        /* Header Styles */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: blue;
            color: #FFD700;
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

       
/* Main Section Styles */
.main-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 40px 20px;
}

.main-content h1 {
    font-size: 42px;
    font-weight: bold;
    color:white;
    margin-bottom: 20px;
    animation: fadeIn 1.5s ease;
}

.main-content p {
    font-size: 18px;
    color:white;
}

header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
    background-color: rgba(0, 0, 0, 0.7); /* Transparent black for header */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5); /* Adding box shadow to header */
}

header img {
    height: 50px;
}

header .header-search input {
    padding: 5px;
    border-radius: 5px;
    border: none;
}

header .header-search button {
    padding: 5px 10px;
    background-color: #ffcc00;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

header nav ul {
    display: flex;
    list-style: none;
    gap: 15px;
}

header nav ul li a {
    text-decoration: none;
    color: #fff;
    font-size: 16px;
}
/* Section Styles */
.section {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    padding: 40px 20px;
    width: 90%;
    max-width: 1200px;
    margin: auto;
}

.section a {
    text-decoration: none;
    color:white;
    display: block;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease-in-out, box-shadow 0.3s;
    overflow: hidden;
}

.section a:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.section img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 8px 8px 0 0;
    transition: transform 0.3s;
}

.section a:hover img {
    transform: scale(1.1);
}

.section h6 {
    font-size: 20px;
    color: #1E90FF;
    margin: 10px;
    text-align: center;
    padding: 10px;
    transition: color 0.3s;
}

.section a:hover h6 {
    color: #FFD700;
}

/* Slider Styles */
.slider-container {
    position: relative;
    width: 100%;
    max-width: 800px;
    margin: auto;
    overflow: hidden;
    margin-top: 40px;
    border-radius: 10px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.slider {
    display: flex;
    transition: transform 0.5s ease-in-out;
}

.slide img {
    width: 100%;
    display: block;
    border-radius: 10px;
}

.slider-controls button {
    background-color: rgba(255, 255, 255, 0.8);
    color: #1E90FF;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.slider-controls button:hover {
    background-color:rgb(6, 7, 7);
    color: #fff;
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
        <div class="header-search">
            <input type="text" placeholder="Search for Tiffin Services">
            <button>Search</button>
        </div>
        <nav class="header-nav">
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="srevices.php">Services</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="#menu_a">Menu</a></li>
                <li><a href="admin.php">Admin</a></li>
                <li><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
                
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

    <!-- Main Content -->
    <div class="main-content">
        <h1 style="color:black;">Welcome to TiffinElite</h1>
        <p style="color:black;">Your trusted partner for quality tiffin services.</p>
    </div>

    <!-- Section: Hotels, Mess, Hostel -->
    <div class="section">
        <a href="hotelm.php">
            <img src="mess/hot.jpg" alt="Hotels/Mess">
            <h6>Hotels / Mess</h6>
        </a>
        <a href="hoemess.php">
            <img src="mess/kit.jpg" alt="Home Mess">
            <h6>Home Mess</h6>
        </a>
        <a href="restaurant.php">
            <img src="mess/res.jpg" alt="Restaurant / PG / Hostels">
            <h6>Restaurant / PG / Hostels</h6>
        </a>
    </div>
    <hr>

    <!-- Available Menu Section -->
    <div id="menu_a">
    <div class="container">
        <h1 style="color:black;">Available Home Mess Menu</h1>
        <div class="card-container" id="card-container">
            <!-- Cards will be dynamically inserted here -->
        </div>
    </div>
    <hr>

    <!-- Hotel Menu Section -->
    <div>
        <div class="hotel-container">
            <h1 style="color:black;">Available Hotel and Foods</h1>
            <div class="hotel-card-container" id="hotel-card-container">
                <!-- Cards will be dynamically inserted here -->
            </div>
        </div>
    </div>
    <hr>
     <!-- Hotel Menu Section -->
    <div>
        <div class="hotel-container">
            <h1 style="color:black;">Available Hostel and restaurants</h1>
            <div class="hotel-card-container" id="hotel-card-containerr">
                <!-- Cards will be dynamically inserted here -->
            </div>
        </div>
    </div>
    <hr>
    <!-- Modal for Order Details -->
    <!-- Modal for Order Details -->
<div class="hotel-modal-overlay" id="hotel-modal-overlay"></div>
<div class="hotel-modal" id="hotel-order-modal">
    <div class="hotel-modal-header">Order Details</div>
    <div class="hotel-modal-body">
        <label>
            Name:
            <input type="text" id="hotel-user-name" required>
        </label>
        <br>
        <label>
            Address:
            <textarea id="hotel-user-address" required></textarea>
        </label>
        <br>
        <label>
            Payment Method:
            <select id="hotel-payment-method">
                <option value="cash">Cash</option>
                <option value="online">Online</option>
            </select>
        </label>
        <br>
        <label>
            Location:
            <input type="text" id="hotel-user-location" required>
        </label>
    </div>
    <div class="hotel-modal-footer">
        <button class="hotel-cancel-btn" id="hotel-cancel-order">Cancel</button>
        <button class="hotel-order-btn" id="hotel-confirm-order">Place Order</button>
    </div>
</div>

    <!-- Footer -->
    <footer class="foot">
        <div class="footer-links">
            <a href="setting.php">Settings</a>
            <a href="setting.php">Privacy</a>
            <a href="setting.php">Help & Support</a>
            <a href="setting.php">Display & Accessibility</a>
            <a href="setting.php">Supplier</a>
        </div>
        <div class="social-icons">
            <a href="https://github.com" target="_blank"><i class="fa-brands fa-instagram"></i></a>
            <a href="#" target="_blank"><i class="fa-brands fa-github"></i></a>
      <a href="#" target="_blank"><i class="fa-brands fa-facebook"></i></a>
      <a href="#" target="_blank"><i class="fa-brands fa-whatsapp"></i></a>
      
        </div>
        <h5>@created by group 6</h5>
    </footer>

    

    <script src="js/fetchdata.js"></script>
    <script src="js/fetchdatahotel.js"></script>
    <script src="js/fetchdatahostel.js"></script>
</body>
</html>

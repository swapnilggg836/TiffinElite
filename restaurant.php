<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="assets/css/main-style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets\css\fetchdatahostel.css">
    <link rel="stylesheet" href="assets\css\fetchdatahotel.css">
    <style>


/* Show Modal */
.hotel-modal-overlay.show,
.hotel-modal.show {
    display: block;
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
        .body1{

        }
    </style>
</head>
<body class=""body1>
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
                        <img src="assets/img/pexels-chanwalrus-958545 (1).jpg" alt="User Photo" class="profile-image">
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
    <div>
        <div class="hotel-container">
            <h1 style="color:black;">Available Hostel and restaurants</h1>
            <div class="hotel-card-container" id="hotel-card-containerr">
                <!-- Cards will be dynamically inserted here -->
            </div>
        </div>
    </div>
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
    <footer class="foot">
        <div class="footer-links">
            <a href="setting.php">Settings</a>
            <a href="setting.php">Privacy</a>
            <a href="setting.php">Help & Support</a>
            <a href="setting.php">Display & Accessibility</a>
            <a href="setting.php">Supplier</a>
        </div>
        <div class="social-icons" style="color:white;">
            <a href="https://github.com" target="_blank" style="color:white;" ><i class="fa-brands fa-instagram"></i></a>
            <a href="https://instagram.com" target="_blank" style="color:white;"><i class="fa-brands fa-github"></i></a>
            <a href="https://linkedin.com" target="_blank" style="color:white;"><i class="fa-brands fa-github"></i></a>
            <a href="https://twitter.com" target="_blank" style="color:white;"><i class="fa-brands fa-github"></i></a>
        </div>
        <h5 style="color:white;">@created by group 6</h5>
    </footer>
    <script src="js\fetchdatahostel.js"></script>
    <script src="js\fetchdatahotel.js"></script>
</body>
</html>
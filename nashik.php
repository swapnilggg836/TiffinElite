<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="assets/css/main-style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiffin Services</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/contact.css">
    <style>
  

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
</head>
<body id="mainaa">
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
                <li><a href="provider.php">Provider</a></li>
                <li>
                    <a href="#" class="drop-down">
                        <img src="assets/img/user_photo.jpg" alt="User Photo" class="profile-image">
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
    <div class="breadcrumb">
        <ul>
            <li><a href="#">Nashik</a></li>
            <li><a href="#">Tiffin Services in Nashik</a></li>
            <li><a href="#">50+ Listings</a></li>
        </ul>
    </div>
    <div class="page-title">
        Best Tiffin Services in Nashik - Order Food Online
        <span>Find the best options for your daily meals</span>
    </div>
    <div class="filter-container">
        <button class="filter-nav-btn prev-btn">&laquo; Prev</button>
        <ul class="filter-menu">
            <li class="filter-item"><ul class="filter">
                <li class="filter-item">
                    Sort by:
                    <select id="sort-options" onchange="applySorting()">
                        <option value="default">Default</option>
                        <option value="priceLowHigh">Price (Low to High)</option>
                        <option value="priceHighLow">Price (High to Low)</option>
                        <option value="ratingHighLow">Rating (High to Low)</option>
                        <option value="ratingLowHigh">Rating (Low to High)</option>
                    </select>
                </li>
            </ul></li>
            
            <li class="filter-item">Ratings</li>
            <li class="filter-item">Online Ordering</li>
            <li class="filter-item">Trending</li>
            <li class="filter-item">Top Rated</li>
           
            <li class="filter-item all-filters">All Filters</li>
        </ul>
        <button class="filter-nav-btn next-btn">Next &raquo;</button>
    </div>
    <div class="section">
        <div class="sectiona"><img src="#" alt="sa"><h6>Hotels/Mess</h6></div>
        <div class="sectiona"><img src="#" alt="fa"><h6>HomeMess</h6></div>
        <div class="sectiona"><img src="#" alt="ga"><h6>Restaurant/PG/Hostels</h6></div>
     
    </div>


    <div class="container">
        <div class="left">
            <img src="https://via.placeholder.com/400x300" alt="Hotel Image" id="image-slider">
            <div class="nav-buttons">
                <button id="prev">Previous</button>
                <button id="next">Next</button>
            </div>
        </div>
        <div class="right">
            <div class="hotel-info">
                <h2 style="color: black;">Gaikwad Hotel</h2>
                <div class="rating">Rating: <span>★★★★☆</span></div>
                <div class="address">Address: 123 Main Street, City, Country</div>
                <div class="open-close">Open: 9:00 AM - Close: 10:00 PM</div>
            </div>
            <div class="contact">
                <input type="text" placeholder="Enter your query">
                <a href="tel:+123456789">Call: +123456789</a>
                <a href="https://wa.me/123456789">WhatsApp</a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="left">
            <img src="https://via.placeholder.com/400x300" alt="Hotel Image" id="image-slider">
            <div class="nav-buttons">
                <button id="prev">Previous</button>
                <button id="next">Next</button>
            </div>
        </div>
        <div class="right">
            <div class="hotel-info">
                <h2 style="color: black;">Gaikwad Hotel</h2>
                <div class="rating">Rating: <span>★★★★☆</span></div>
                <div class="address">Address: 123 Main Street, City, Country</div>
                <div class="open-close">Open: 9:00 AM - Close: 10:00 PM</div>
            </div>
            <div class="contact">
                <input type="text" placeholder="Enter your query">
                <a href="tel:+123456789">Call: +123456789</a>
                <a href="https://wa.me/123456789">WhatsApp</a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="left">
            <img src="https://via.placeholder.com/400x300" alt="Hotel Image" id="image-slider">
            <div class="nav-buttons">
                <button id="prev">Previous</button>
                <button id="next">Next</button>
            </div>
        </div>
        <div class="right">
            <div class="hotel-info">
                <h2 style="color: black;">Gaikwad Hotel</h2>
                <div class="rating">Rating: <span>★★★★☆</span></div>
                <div class="address">Address: 123 Main Street, City, Country</div>
                <div class="open-close">Open: 9:00 AM - Close: 10:00 PM</div>
            </div>
            <div class="contact">
                <input type="text" placeholder="Enter your query">
                <a href="tel:+123456789">Call: +123456789</a>
                <a href="https://wa.me/123456789">WhatsApp</a>
            </div>
        </div>
    </div>
   








<footer class="foot" ">
    <h5 style="color: azure;"> @created by group 6</h5>
</footer>

    <script src="js\index.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="assets\css\styles.css">
    <style>
          <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    .car-gallery {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
        padding: 20px;
    }
    .car-box {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 10px;
        width: 300px;
        text-align: center;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .car-box img {
        width: 100%;
        border-radius: 8px;
    }
      /* Section for Mess, Hotel, Hostel */
      .section {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            padding: 40px 20px;
            width: 90%;
            max-width: 1200px;
        }

        .section a {
            text-decoration: none;
            color: inherit;
            display: block;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out, background-color 0.3s ease;
        }

        .section a:hover {
            transform: scale(1.05);
            background-color: #f3fb0e;
        }

        .section img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .section h6 {
            font-size: 18px;
            color: #333;
            margin-top: 10px;
            text-align: center;
            padding: 10px;
        }

    .footer-links, .social-icons {
        display: flex;
        justify-content: center;
        gap: 15px;
        padding: 10px;
    }
    .foot {
        background: #f8f9fa;
        padding: 20px;
        text-align: center;
    }
</style>

    </style>
</head>
<body>
<header>
        <div class="header-logo" id="home1">
            <a href="/">
                <img src="assets\img\logo.jpg" alt="YumDabba">
            </a>
        </div>
        <div class="header-search">
            <input type="text" placeholder="Search for Tiffin Services">
            <button>Search</button>
        </div>
        <nav class="header-nav">
            <ul>
            <li><a href="index.php">Home</a></li>
                <li><a href="srevices.php">Services</a></li>
                <li><a href="indexpp.php">practice</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="sinup.php">sign up</a></li>
                
            </ul>
        </nav>
    </header>
    <section id="services-section">
        <div class="car-gallery">
            <div class="car-box">
                <img src="service1.jpg" alt="Daily Tiffin Service">
                <h3>Daily Tiffin Service</h3>
                <p>Fresh and healthy tiffin delivered to your doorstep every day.</p>
                <button onclick="orderNow('login.php')">Order Now</button>
            </div>
            <div class="car-box">
                <img src="service2.jpg" alt="Weekly Tiffin Plan">
                <h3>Weekly Tiffin Plan</h3>
                <p>Enjoy a week's worth of nutritious meals with our weekly plan.</p>
                <button onclick="orderNow('login.php')">Order Now</button>
            </div>
            <div class="car-box">
                <img src="service3.jpg" alt="Custom Meal Plan">
                <h3>Custom Meal Plan</h3>
                <p>Get a personalized meal plan based on your preferences.</p>
                <button onclick="orderNow('login.php')">Order Now</button>
            </div>
            <div class="car-box">
                <img src="service1.jpg" alt="Daily Tiffin Service">
                <h3>Daily Tiffin Service</h3>
                <p>Fresh and healthy tiffin delivered to your doorstep every day.</p>
                <button onclick="orderNow('login.php')">Order Now</button>
            </div>
            <div class="car-box">
                <img src="service2.jpg" alt="Weekly Tiffin Plan">
                <h3>Weekly Tiffin Plan</h3>
                <p>Enjoy a week's worth of nutritious meals with our weekly plan.</p>
                <button onclick="orderNow('login.php')">Order Now</button>
            </div>
            <div class="car-box">
                <img src="service3.jpg" alt="Custom Meal Plan">
                <h3>Custom Meal Plan</h3>
                <p>Get a personalized meal plan based on your preferences.</p>
                <button onclick="orderNow('login.php')">Order Now</button>
            </div>
        </div>
        

        
    
    </section>
    
    <section class="section">
        <a href="hotelm.php">
            <img src="assets/img/pexels-chanwalrus-958545 (1).jpg" alt="Hotels/Mess">
            <h6>Hotels / Mess</h6>
        </a>
        <a href="hoemess.php">
            <img src="assets/img/pexels-chanwalrus-958545 (1).jpg" alt="Home Mess">
            <h6>Home Mess</h6>
        </a>
        <a href="restaurant.php">
            <img src="assets/img/pexels-chanwalrus-958545 (1).jpg" alt="Restaurant / PG / Hostels">
            <h6>Restaurant / PG / Hostels</h6>
        </a>
    
    </section>


    <footer class="foot">
        <div class="footer-links">
            <a href="setting.php">Settings</a>
            <a href="setting.php">Privacy</a>
            <a href="setting.php">Help & Support</a>
            <a href="setting.php">Display & Accessibility</a>
            <a href="setting.php">Supplier</a>
        </div>
        <div class="social-icons">
            <a href="https://github.com" target="_blank" ><i class="fa-brands fa-instagram"></i></a>
            <a href="https://instagram.com" target="_blank"><i class="fa-brands fa-github"></i></a>
            <a href="https://linkedin.com" target="_blank"><i class="fa-brands fa-github"></i></a>
            <a href="https://twitter.com" target="_blank"><i class="fa-brands fa-github"></i></a>
        </div>
        <h5>@created by group 6</h5>
    </footer>
    
</body>
</html>
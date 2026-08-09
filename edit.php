
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="assets/css/complete-style.css">
    <link rel="stylesheet" href="assets/css/main-style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiffin Services</title>
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        body {
            height: 100%;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #ffcc00, #000);
            color: #fff;
        }
        header {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            background-color: #000;
            color: #FFD700;
            padding: 10px 20px;
        }
        .header-logo img {
            height: 40px;
            border-radius: 50%;
            box-shadow: 0 0 20px yellow;
        }
        .header-search {
            display: flex;
            align-items: center;
            flex: 1;
            justify-content: center;
            margin: 10px 0;
        }
        .header-search input[type="text"] {
            padding: 10px;
            border: 1px solid #FFD700;
            border-radius: 5px 0 0 5px;
            outline: none;
            font-size: 14px;
            width: 70%;
        }
        .header-search button {
            padding: 10px;
            background-color: #FFD700;
            color: #000;
            border: none;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
            font-size: 14px;
        }
        .header-search button:hover {
            background-color: #FFC107;
        }
        .header-nav ul {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
        }
        .header-nav li {
            margin: 0 10px;
        }
        .header-nav a {
            color: #FFD700;
            text-decoration: none;
            font-size: 14px;
        }
        .header-nav a:hover {
            text-decoration: underline;
        }
        .container {
            display: flex;
            width: 90%;
            background: #fdf089;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin: 20px auto;
            justify-content: center;
            align-items: center;
        }
        .left {
            flex: 1;
            position: relative;
            background: #eaeaea;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .left img {
            width: 100%;
            height: auto;
            max-height: 300px;
            object-fit: cover;
        }
        .nav-buttons {
            position: absolute;
            width: 100%;
            display: flex;
            justify-content: space-between;
            top: 50%;
            transform: translateY(-50%);
        }
        .nav-buttons button {
            background: rgba(0, 0, 0, 0.5);
            color: #fff;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
        }
        .nav-buttons button:hover {
            background: rgba(0, 0, 0, 0.8);
        }
        .right {
            flex: 1;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .hotel-info {
            margin-bottom: 20px;
        }
        .hotel-info h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        .rating span {
            color: #ffc107;
            font-size: 18px;
        }
        .address {
            margin-bottom: 10px;
            color: #555;
        }
        .open-close {
            margin-bottom: 20px;
            font-size: 14px;
            color: #333;
        }
        .contact {
            display: flex;
            flex-direction: column;
        }
        .contact a {
            text-decoration: none;
            color: #fff;
            background: #28a745;
            padding: 10px;
            text-align: center;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .contact a:hover {
            background: #218838;
        }
        .contact input[type="text"] {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
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
            <li><a href="services.php">Services</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="provider.php">Provider</a></li>
        </ul>
    </nav>
</header>
<div class="container">
    <div class="left">
        <img src="assets/img/dish1.jpg" alt="Dish Image" id="dish-image">
        <div class="nav-buttons">
            <button id="prev">Previous</button>
            <button id="next">Next</button>
        </div>
    </div>
    <div class="right">
        <div class="hotel-info">
            <h2 id="hotel-name">Gaikwad Hotel</h2>
            <h3 id="dish-name">Rice Plate</h3>
            <div class="rating">Rating: <span id="dish-rating">★★★★☆</span></div>
            <div class="address">Address: <span id="hotel-address">123 Main Street, City</span></div>
            <div class="open-close">Open: 9:00 AM - Close: 10:00 PM</div>
        </div>
        <div class="contact">
            <input type="text" placeholder="Enter your query">
            <a href="tel:+123456789">Call: +123456789</a>
            <a href="https://wa.me/123456789">WhatsApp</a>
            <form method="POST" action="order.php">
                <input type="hidden" name="hotel_name" id="form-hotel-name" value="Gaikwad Hotel">
                <input type="hidden" name="dish_name" id="form-dish-name" value="Rice Plate">
                <input type="hidden" name="dish_rating" id="form-dish-rating" value="★★★★☆">
                <input type="hidden" name="dish_price" id="form-dish-price" value="150">
                <input type="hidden" name="contact_number" id="form-contact-number" value="+123456789">
                <button type="submit" name="order-now">Order Now</button>
            </form>
        </div>
    </div>
</div>
<script>
    const images = ["assets/img/dish1.jpg", "assets/img/dish2.jpg", "assets/img/dish3.jpg"];
    const hotelNames = ["Gaikwad Hotel", "Punjabi Delight", "Maharashtrian Spice"];
    const dishNames = ["Rice Plate", "Punjabi Thali", "Maharashtrian Thali"];
    const dishRatings = ["★★★★☆", "★★★★★", "★★★☆☆"];
    const dishPrices = ["150", "250", "200"];
    const dishAddresses = ["123 Main Street, City", "456 Central Avenue, Town", "789 Market Road, Village"];

    let currentIndex = 0;

    document.getElementById("next").addEventListener("click", () => {
        currentIndex = (currentIndex + 1) % images.length;
        updateContent();
    });

    document.getElementById("prev").addEventListener("click", () => {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        updateContent();
    });

    function updateContent() {
        document.getElementById("dish-image").src = images[currentIndex];
        document.getElementById("hotel-name").innerText = hotelNames[currentIndex];
        document.getElementById("dish-name").innerText = dishNames[currentIndex];
        document.getElementById("dish-rating").innerText = dishRatings[currentIndex];
        document.getElementById("hotel-address").innerText = dishAddresses[currentIndex];
        document.getElementById("form-hotel-name").value = hotelNames[currentIndex];
        document.getElementById("form-dish-name").value = dishNames[currentIndex];
        document.getElementById("form-dish-rating").value = dishRatings[currentIndex];
        document.getElementById("form-dish-price").value = dishPrices[currentIndex];
    }
</script>
</body>
</html>

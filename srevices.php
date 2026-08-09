<?php
session_start();
$user_id = $_SESSION['user_id'] ?? 1; // Assuming user is logged in
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="assets/css/complete-style.css">
    <link rel="stylesheet" href="assets/css/main-style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Tiffin Services</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.8), rgba(0, 0, 0, 0.8));
            color: #fff;
        }
        .car-gallery {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }
        .car-box {
            background: rgba(0, 0, 0, 0.8);
            padding: 20px;
            width: 280px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
            transition: transform 0.3s;
        }
        .car-box:hover {
            transform: translateY(-10px);
        }
        .car-box img {
            width: 100%;
            height: 180px;
            border-radius: 10px;
            object-fit: cover;
            margin-bottom: 10px;
        }
        .car-box h3 {
            font-size: 20px;
            color: #ffcc00;
            margin: 10px 0;
        }
        .car-box button {
            padding: 10px 15px;
            background-color: #ffcc00;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: #333;
            font-size: 14px;
            margin-top: 10px;
        }
        .car-box button:hover {
            background-color: #ffaa00;
        }
        /* Form Styling */
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            justify-content: center;
            align-items: center;
        }
        .form-box {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            width: 300px;
            color: #000;
        }
        .form-box input {
            width: 100%;
            padding: 8px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-box button {
            padding: 10px;
            background-color: #ffcc00;
            border: none;
            cursor: pointer;
            width: 100%;
        }
        .form-box button:hover {
            background-color: #ffaa00;
        }
    </style>
</head>
<body>

    <div class="car-gallery">
        <div class="car-box">
            <img src="hotel/t2.jpg" alt="Daily Tiffin Service">
            <h3>Daily Tiffin Service</h3>
            <button onclick="openForm('Daily Tiffin Service')">Get Service</button>
        </div>
        <div class="car-box">
            <img src="hotel/t.jpg" alt="Weekly Tiffin Plan">
            <h3>Weekly Tiffin Plan</h3>
            <button onclick="openForm('Weekly Tiffin Plan')">Get Service</button>
        </div>
        <div class="car-box">
            <img src="hotel/d.jpg" alt="Custom Meal Plan">
            <h3>Custom Meal Plan</h3>
            <button onclick="openForm('Custom Meal Plan')">Get Service</button>
        </div>
        <div class="car-box">
            <img src="hotel/t2.jpg" alt="Montly Tiffin Service">
            <h3>Montly Tiffin Service</h3>
            <button onclick="openForm('Montly Tiffin Service')">Get Service</button>
        </div>
        <div class="car-box">
            <img src="hotel/t.jpg" alt="Year subscription Plan">
            <h3>Year subscription Plan</h3>
            <button onclick="openForm('Year subscription Plan')">Get Service</button>
        </div>
        <div class="car-box">
            <img src="hotel/d.jpg" alt="tahli">
            <h3>tahli</h3>
            <button onclick="openForm('thahli')">Get Service</button>
        </div>
    </div>

    <!-- Order Form -->
    <div class="overlay" id="orderForm">
        <div class="form-box">
            <h2>Order Tiffin Service</h2>
            <input type="text" id="user_name" placeholder="Your Name">
            <input type="email" id="email" placeholder="Your Email">
            <input type="text" id="phone" placeholder="Your Phone Number">
            <input type="text" id="address" placeholder="Your Address">
            <button onclick="submitOrder()">Submit</button>
            <button onclick="closeForm()" style="background: red;">Cancel</button>
        </div>
    </div>

    <script>
        let selectedService = "";

        function openForm(serviceName) {
            selectedService = serviceName;
            document.getElementById('orderForm').style.display = 'flex';
        }

        function closeForm() {
            document.getElementById('orderForm').style.display = 'none';
        }

        function submitOrder() {
            let userId = <?php echo $user_id; ?>;
            let userName = document.getElementById("user_name").value;
            let email = document.getElementById("email").value;
            let phone = document.getElementById("phone").value;
            let address = document.getElementById("address").value;

            if (!userName || !email || !phone || !address) {
                alert("Please fill all the fields.");
                return;
            }

            fetch('services_order.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ 
                    service: selectedService, 
                    user_id: userId, 
                    user_name: userName, 
                    email: email, 
                    phone: phone, 
                    address: address
                })
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                closeForm();
            })
            .catch(error => console.error('Error:', error));
        }
    </script>

</body>
</html>
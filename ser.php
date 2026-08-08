<?php
session_start();
$user_id = $_SESSION['user_id'] ?? 1; // Assuming user is logged in

require_once 'connection.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch services dynamically
$services = [];
$sql = "SELECT * FROM servicesadmin";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $services[] = $row;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
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
        <?php foreach ($services as $service): ?>
            <div class="car-box">
                <img src="<?php echo $service['image_url']; ?>" alt="<?php echo $service['service_name']; ?>">
                <h3><?php echo $service['service_name']; ?></h3>
                <button onclick="openForm('<?php echo $service['service_name']; ?>')">Get Service</button>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Order Form -->
    <div class="overlay" id="orderForm">
        <div class="form-box">
            <h2>Order Tiffin Service</h2>
            <input type="text" id="user_name" placeholder="Your Name">
            <input type="email" id="email" placeholder="Your Email">
            <input type="text" id="phone" placeholder="Your Phone Number">
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

            if (!userName || !email || !phone) {
                alert("Please fill all the fields.");
                return;
            }

            fetch('ser.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ 
                    service: selectedService, 
                    user_id: userId, 
                    user_name: userName, 
                    email: email, 
                    phone: phone 
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
<?php
require_once 'connection.php';

if ($conn->connect_error) {
    die(json_encode(["message" => "Database Connection Failed"]));
}

$data = json_decode(file_get_contents("php://input"), true);
if ($data) {
    $user_id = $data['user_id'];
    $service_name = $data['service'];
    $user_name = $data['user_name'];
    $email = $data['email'];
    $phone = $data['phone'];

    $stmt = $conn->prepare("INSERT INTO oservicessss (user_id, service_name, user_name, email, phone) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $user_id, $service_name, $user_name, $email, $phone);
    
    if ($stmt->execute()) {
        echo json_encode(["message" => "Order Placed Successfully!"]);
    } else {
        echo json_encode(["message" => "Order Failed!"]);
    }
    $stmt->close();
}

$conn->close();
?>


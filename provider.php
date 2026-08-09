<?php 
// Include the database connection file
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $order_status = $_POST['order_status'];

    // Insert the data into the database
    $query = "INSERT INTO services (name, description, order_status) VALUES (:name, :description, :order_status)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':order_status', $order_status);

    if ($stmt->execute()) {
        $message = "Service added successfully!";
    } else {
        $message = "Failed to add service.";
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
    <title>Provider Page</title>
    <style>
        /* Reset and Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #ffcc00, #000); /* Yellow to black gradient */
            color: #fff;
            margin: 0;
        }

        header {
            background-color: #000;
            color: #FFD700;
            padding: 20px;
            text-align: center;
        }

        h1 {
            margin: 0;
            font-size: 28px;
        }

        .container {
            width: 80%;
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
            background-color: #333;
            border-radius: 8px;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        p {
            color: #FFD700;
            text-align: center;
            margin-bottom: 15px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-size: 16px;
            margin-bottom: 8px;
            color: #fff;
        }

        input[type="text"], textarea, select {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #FFD700;
            border-radius: 5px;
            background-color: #222;
            color: #fff;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        button {
            padding: 12px 20px;
            background-color: #FFD700;
            border: none;
            color: #000;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #FFC107;
        }

        /* Media Query for Smaller Screens */
        @media (max-width: 768px) {
            header {
                padding: 15px;
            }

            h1 {
                font-size: 24px;
            }

            .container {
                width: 90%;
                padding: 15px;
            }

            h2 {
                font-size: 20px;
            }
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
<body>
    <header>
        <h1>Provider Panel</h1>
    </header>
    
    <div class="container">
        <h2>Add Tiffin Service</h2>
        <?php if (isset($message)) echo "<p>$message</p>"; ?>

        <form action="provider.php" method="POST">
            <label for="name">Service Name:</label>
            <input type="text" name="name" id="name" required>

            <label for="description">Service Description:</label>
            <textarea name="description" id="description" required></textarea>

            <label for="order_status">Order Status:</label>
            <select name="order_status" id="order_status">
                <option value="Received">Received</option>
                <option value="Pending">Pending</option>
                <option value="Delivered">Delivered</option>
            </select>

            <button type="submit">Add Service</button>
        </form>
    </div>

    <script>
        // JavaScript to handle form submission feedback and possibly other dynamic behaviors
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            form.addEventListener('submit', function(event) {
                const nameInput = document.getElementById('name');
                const descriptionInput = document.getElementById('description');

                if (!nameInput.value || !descriptionInput.value) {
                    event.preventDefault(); // Stop form submission if fields are empty
                    alert("Please fill all fields.");
                }
            });
        });
    </script>
</body>
</html>

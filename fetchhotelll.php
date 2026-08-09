<?php
require_once 'connection.php';

try {
    // Create a PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$db", $username, $password);
    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="assets/css/main-style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Mess Info</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .card {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 300px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
        }
        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .card-content {
            padding: 15px;
        }
        .card h3 {
            margin: 0;
            font-size: 1.2rem;
            color: #333;
        }
        .card p {
            margin: 8px 0;
            font-size: 0.9rem;
            color: #555;
        }
        .card .price {
            font-weight: bold;
            color: #28a745;
        }
        .card .delete-btn {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 12px;
            background: #dc3545;
            color: #fff;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .card .delete-btn:hover {
            background: #c82333;
        }
    </style>
</head>
<body>
    <h1>Hostel Mess Info</h1>
    <div class="card-container">
        <!-- Cards will be populated here -->
        <?php include 'fetch_hostel.php'; ?>
    </div>

    <script>
        // JavaScript for delete confirmation
        document.addEventListener("DOMContentLoaded", () => {
            const deleteButtons = document.querySelectorAll(".delete-btn");

            deleteButtons.forEach(button => {
                button.addEventListener("click", event => {
                    event.preventDefault(); // Prevent default link behavior
                    const confirmDelete = confirm("Are you sure you want to delete this card?");
                    if (confirmDelete) {
                        // Redirect to the delete URL if confirmed
                        window.location.href = button.getAttribute("href");
                    }
                });
            });
        });
    </script>
</body>
</html>

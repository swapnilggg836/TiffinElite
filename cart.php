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
    <title>Data Display with Delete Option</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.8), rgba(0, 0, 0, 0.8)), url('assets/img/your-background-image.jpg');
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .section {
            margin-bottom: 30px;
        }
        .section h2 {
            margin-bottom: 10px;
            color: #555;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        table th {
            background-color: #f4f4f4;
            color: #333;
        }
        .loading {
            text-align: center;
            color: #666;
        }
        .delete-btn {
            background-color: #ff4d4d;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
        }
        .delete-btn:hover {
            background-color: #e60000;
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
    <div class="container">
        <h1>Data from Database</h1>

        <div class="section" id="cart-section">
            <h2>Cart</h2>
            <div class="loading" id="cart-loading">Loading cart data...</div>
            <table id="cart-table" style="display: none;">
                <thead>
                    <tr>
                    <th>ID</th>
                        <th>Menu</th>
                        <th>Price</th>
                        
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>

        <div class="section" id="carthotel-section">
            <h2>Cart Hotel and Hostel</h2>
            <div class="loading" id="carthotel-loading">Loading hotel data...</div>
            <table id="carthotel-table" style="display: none;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Menu</th>
                        <th>Price</th>
                        
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>

    </div>
 <!-- Footer -->

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
        document.addEventListener("DOMContentLoaded", function () {
            fetch("cart_fetch.php")
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Populate cart table
                        populateTable(data.cart, "cart-table", "cart-loading", "cart");

                        // Populate carthotel table
                        populateTable(data.carthotel, "carthotel-table", "carthotel-loading", "carthotel");

                        // Populate carthostel table
                        populateTable(data.carthostel, "carthostel-table", "carthostel-loading", "carthostel");
                    } else {
                        alert("Sucessful Fetch Data: " + data.message);
                    }
                })
                .catch(error => {
                    console.error("Error fetching data:", error);
                    alert("Sucessfuly Fetch Data.");
                });
        });

        function populateTable(data, tableId, loadingId, tableName) {
            const table = document.getElementById(tableId);
            const loading = document.getElementById(loadingId);

            if (data.length > 0) {
                const tbody = table.querySelector("tbody");
                data.forEach(item => {
                    const row = document.createElement("tr");
                    Object.values(item).forEach(value => {
                        const cell = document.createElement("td");
                        cell.textContent = value;
                        row.appendChild(cell);
                    });

                    // Add delete button
                    const actionsCell = document.createElement("td");
                    const deleteButton = document.createElement("button");
                    deleteButton.textContent = "Delete";
                    deleteButton.className = "delete-btn";
                    deleteButton.onclick = () => deleteRecord(item.id, tableName);
                    actionsCell.appendChild(deleteButton);
                    row.appendChild(actionsCell);

                    tbody.appendChild(row);
                });

                table.style.display = "table";
            } else {
                loading.textContent = "No data available.";
            }

            loading.style.display = "none";
        }

    </script>
  <script>
    function deleteRecord(itemId, tableName) {
    if (!confirm("Are you sure you want to delete this item?")) {
        return;
    }

    fetch("cart_delete.php", {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            id: itemId,
            table: tableName
        })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                // Reload the page or remove the row from the table
                location.reload();
            } else {
                alert("Failed to delete item: " + data.message);
            }
        })
        .catch(error => {
            console.error("Error deleting item:", error);
            alert("An error occurred while deleting the item.");
        });
}

  </script>

</body>
</html>

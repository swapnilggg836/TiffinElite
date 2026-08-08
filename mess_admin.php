<?php
// Database connection
require_once 'connection.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $service_type = $_POST['service_type'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("INSERT INTO services (service_type, description) VALUES (?, ?)");
    $stmt->bind_param("ss", $service_type, $description);

    if ($stmt->execute()) {
        echo "<p style='color: green;'>Service added successfully!</p>";
    } else {
        echo "<p style='color: red;'>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page - Tiffin Services</title>
    <link rel="stylesheet" href="styles.css">
    <style>
   * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.8), rgba(0, 0, 0, 0.8));
    display: flex;
}

/* Sidebar Styling */
/* Sidebar Styling */
.sidebar {
    width: 25%;
    height: 100vh;
    background: linear-gradient(135deg, #4a90e2, #50a3d2); /* Subtle blue gradient */
    position: fixed;
    top: 0;
    left: 0;
    padding: 20px;
    box-shadow: 2px 0 10px rgba(0, 0, 0, 0.2); /* Increased shadow for depth */
    overflow-y: auto;
    transition: all 0.3s ease; /* Smooth transition when resizing */
}

.sidebar h2 {
    margin-bottom: 20px;
    color: #fff; /* White text for better contrast */
    font-size: 26px;
    font-weight: bold;
}

.sidebar ul {
    list-style: none;
    padding: 0;
}

.sidebar ul li {
    margin: 15px 0;
}

.sidebar ul li a {
    text-decoration: none;
    color: #fff; /* White text */
    font-weight: 500;
    font-size: 18px;
    transition: color 0.3s ease; /* Smooth color transition on hover */
}

.sidebar ul li a:hover {
    color: #f1c40f; /* Gold color on hover */
}

.sidebar ul li a.active {
    color: #f1c40f; /* Gold color for active link */
    font-weight: bold;
}

.sidebar ul li a:focus {
    outline: none; /* Remove outline when focused */
}

.sidebar ul li a.active:hover {
    color: #fff; /* Ensure active link stays white when hovered */
}


/* Content Styling */
.content {
    margin-left: 25%; /* This pushes the content to the right of the sidebar */
    width: 75%; /* Adjust content width */
    padding: 20px;
    display: flex;
    flex-direction: column;
    align-items: center; /* Centers content horizontally */
}

.content h1 {
    margin-bottom: 20px;
    color: #444;
}

/* Section Styling */
.section {
    display: none;
    margin-bottom: 20px;
    padding: 15px;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.8), rgba(0, 0, 0, 0.8));
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    width: 100%; /* Ensure sections take full width of content */
}

.section h3 {
    margin-bottom: 10px;
    color: #555;
}


/* Add menu section */
.form-container {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    width: 400px;
}

h1 {
    margin-bottom: 20px;
    font-size: 24px;
    color: #333;
}

label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    color: #555;
}

input, textarea, select, button {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button {
    background-color: #007bff;
    color: #fff;
    border: none;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}

/* Fetch data */
.container {
    max-width: 1200px;
    margin: 20px auto;
    padding: 20px;
}

h1 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}

.card-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
}

.card {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    width: 300px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
}

.card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.card-content {
    padding: 15px;
}

.card-content h3 {
    margin: 0 0 10px;
    color: #007bff;
}

.card-content p {
    margin: 5px 0;
    color: #555;
}

.card-content .price {
    font-weight: bold;
    color: #333;
}

.card-content .service-type {
    font-size: 14px;
    color: #888;
}

.delete-btn {
    display: inline-block;
    padding: 8px 12px;
    background-color: #ff4d4d;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    text-align: center;
    margin-top: 10px;
}

.delete-btn:hover {
    background-color: #e60000;
}

#pricing-section {
    font-family: Arial, sans-serif;
    background-color: #f7f7f7;
    margin: 0;
    padding: 20px;
}

/* Pricing Table */
.pricing-container {
    max-width: 900px;
    margin: 0 auto;
    background: #ffffff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table th, table td {
    border: 1px solid #ddd;
    padding: 12px;
    text-align: left;
}

table th {
    background-color: #0056b3;
    color: #fff;
}

/* Form Styling */
.form-container {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    width: 400px;
    margin: 0 auto;
}

h1 {
    margin-bottom: 20px;
    font-size: 24px;
    color: #333;
}

label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    color: #555;
}

input, textarea, select, button {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button {
    background-color: #007bff;
    color: #fff;
    border: none;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}

/* Contact message fetch */
#contact-section {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 20px;
    background-color: #f9f9f9;
}

#contact-section .container {
    max-width: 800px;
    margin: auto;
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

#contact-section .container h2 {
    text-align: center;
    margin-bottom: 20px;
}

#contact-section .container table {
    width: 100%;
    border-collapse: collapse;
}

#contact-section .container table th, table td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
}

#contact-section .container table th {
    background-color: #f4f4f4;
}

/* General Styling */
#mess-info {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f9f9f9;
}

/* Navbar Styling */
.messadmin-navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
    background-color: #333;
    color: #fff;
}

.messadmin-heading {
    font-size: 24px;
    margin: 0;
}

.messadmin-photo {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    border: 2px solid #fff;
}

/* Container Styling */
.messadmin-container {
    padding: 20px;
    max-width: 1200px;
    margin: 0 auto;
    background-color: #fff;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

/* Mess Info Styling */
.messadmin-info {
    margin-bottom: 20px;
}

.messadmin-mess-name {
    font-size: 28px;
    margin-bottom: 10px;
    color: #333;
}

.messadmin-description {
    font-size: 16px;
    color: #555;
}

/* Location Styling */
.messadmin-location {
    margin-bottom: 20px;
}

.messadmin-location-heading {
    font-size: 20px;
    margin-bottom: 5px;
    color: #333;
}

.messadmin-location-address {
    font-size: 16px;
    color: #555;
}

/* Gallery Styling */
.messadmin-gallery {
    margin-bottom: 20px;
}

.messadmin-gallery-heading {
    font-size: 20px;
    margin-bottom: 10px;
    color: #333;
}

.messadmin-gallery-images {
    display: flex;
    gap: 10px;
}

.messadmin-gallery-image {
    width: 150px;
    height: 150px;
    object-fit: cover;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}


</style>
</head>
<body>
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
        <li><a href="#" onclick="showSection('mess-info')">Add Mess Information</a></li>
            <li><a href="#" onclick="showSection('mess-add')">Add Menu</a></li>
            <li><a href="#" onclick="showSection('services-section')">Services</a></li>
            <li><a href="#" onclick="showSection('pricing-section')">Update Pricing</a></li>
            <li><a href="#" onclick="showSection('contact-section')">Contact Information</a></li>
            <li><a href="home.php" >Home</a></li>
            <li><a href="home.php">Logout</a></li>
        </ul>
    </div>

    <div class="content">
        <h1>welcome</h1>
    <div class="section" id="mess-info">
            <h3>Add Mess Information</h3>
            <!-- Add Mess Information content here -->
            <div class="messadmin-navbar">
        <div class="messadmin-nav-left">
            <h1 class="messadmin-heading">Gaikwad Mess</h1>
        </div>
        <div class="messadmin-nav-right">
            <img src="assets/images/logo.jpg" alt="Admin Photo" class="messadmin-photo">
        </div>
    </div>

    <div class="messadmin-container">
        <div class="messadmin-info">
            <h2 class="messadmin-mess-name">Spice House Mess</h2>
            <p class="messadmin-description">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
            </p>
        </div>

        <div class="messadmin-location">
            <h3 class="messadmin-location-heading">Location</h3>
            <p class="messadmin-location-address">123 Main Street, New York, NY 10001</p>
        </div>

        <div class="messadmin-gallery">
            <h3 class="messadmin-gallery-heading">Image Gallery</h3>
            <div class="messadmin-gallery-images">
                <img src="assets/images/food1.jpg" alt="Food 1" class="messadmin-gallery-image">
                <img src="assets/images/food2.jpg" alt="Food 2" class="messadmin-gallery-image">
                <img src="assets/images/food3.jpg" alt="Food 3" class="messadmin-gallery-image">
            </div>
        </div>
    </div>

        </div>

       

        <div class="section" id="mess-add">
            <h3>Add Menu</h3>
            <!-- Add menu content here -->
            <div class="form-container">
        <h1>Add Mess Information</h1>
        <form action="add_mess.php" method="POST" enctype="multipart/form-data">
            <label for="mess_name">Mess Name:</label>
            <input type="text" id="mess_name" name="mess_name" required>

            <label for="menu_name">Menu Name:</label>
            <input type="text" id="menu_name" name="menu_name" required>

            <label for="menu_photos">Menu Photos:</label>
            <input type="file" id="menu_photos" name="menu_photos[]" multiple required>

            <label for="menu_price">Menu Price:</label>
            <input type="number" id="menu_price" name="menu_price" required>

            <label for="address">Address:</label>
            <textarea id="address" name="address" required></textarea>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>

            <label for="opening_time">Opening Time:</label>
            <input type="time" id="opening_time" name="opening_time" required>

            <label for="closing_time">Closing Time:</label>
            <input type="time" id="closing_time" name="closing_time" required>

            <label for="service_type">Service Type:</label>
            <select id="service_type" name="service_type" required>
                <option value="online">Online</option>
                <option value="offline">Offline</option>
            </select>

            <button type="submit">Add Mess</button>
        </form>

    </div>
    <div class="container">
        <h1>Available Mess Services</h1>
        <div class="card-container" id="card-container">
            <!-- Cards will be dynamically inserted here -->
        </div>
    </div>


        </div>

        
        <div class="section" id="menu-section">
            <h3>Menu Section</h3>
            <!-- Menu Section content here -->
        </div>
        <div class="section" id="services-section">
            <h3>Services Section</h3>
            <!-- Contact Information content here -->
            <div class="container">
        <h2>Messages for Mess Admins</h2>
        
    </div>
</div>
        <div class="section" id="pricing-section">
            <h3>Update Pricing</h3>
            <!-- Update Pricing content here -->
            <div class="pricing-container">
    <h1>Update Pricing</h1>
    <table>
        <thead>
        <tr>
            <th>Mess Name</th>
            <th>Menu Name</th>
            <th>Current Price</th>
            <th>New Price</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody id="pricing-table">
        <?php
        // Database connection
        require_once 'connection.php';

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch data for display
        $sql = "SELECT id, mess_name, menu_name, menu_price FROM mess";
        $result = $conn->query($sql);

        $messData = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $messData[] = $row;
            }
        }
        $conn->close();

        // Display rows
        foreach ($messData as $mess) {
            echo "<tr>";
            echo "<td>" . $mess['mess_name'] . "</td>";
            echo "<td>" . $mess['menu_name'] . "</td>";
            echo "<td>₹" . $mess['menu_price'] . "</td>";
            echo "<td><input type='number' class='price-input' data-id='" . $mess['id'] . "' value='" . $mess['menu_price'] . "'></td>";
            echo "<td><button class='update-btn' data-id='" . $mess['id'] . "'>Update</button></td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>
        </div>

        <div class="section" id="contact-section">
            <h3>Contact Information</h3>
            <!-- Contact Information content here -->
            <div class="container">
        <h2>Messages for Mess Admins</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Message</th>
                </tr>
            </thead>
            <tbody id="messMessages"></tbody>
        </table>
    </div>
        </div>

        <div class="section" id="gotohome">
            <h3>Home</h3>
            <!-- Home content here -->
        </div>

        <div class="section" id="logout">
            <h3>Log Out</h3>
     
        </div>
    </div>

    <script >
        function showSection(sectionId) {
    // Hide all sections
    var sections = document.getElementsByClassName('section');
    for (var i = 0; i < sections.length; i++) {
        sections[i].style.display = 'none';
    }

    // Display the selected section
    var sectionToShow = document.getElementById(sectionId);
    if (sectionToShow) {
        sectionToShow.style.display = 'block';
    }
}

    </script>
    <script>
        document.querySelector("form").addEventListener("submit", function (e) {
    const photos = document.getElementById("menu_photos").files;
    if (photos.length === 0) {
        alert("Please upload at least one photo.");
        e.preventDefault();
    }
});

    </script>
    <script>
       document.addEventListener("DOMContentLoaded", function () {
    fetch("fetch_mess.php")
        .then(response => response.json())
        .then(data => {
            const cardContainer = document.getElementById("card-container");
            data.forEach(mess => {
                const card = document.createElement("div");
                card.className = "card";
                card.innerHTML = `
                    <img src="${mess.menu_photos[0]}" alt="${mess.menu_name}">
                    <div class="card-content">
                        <h3>${mess.mess_name}</h3>
                        <p>Menu: ${mess.menu_name}</p>
                        <p>${mess.description}</p>
                        <p class="price">Price: ₹${mess.menu_price}</p>
                        <p class="service-type">Service: ${mess.service_type}</p>
                        <button class="delete-btn" data-id="${mess.id}">Delete</button>
                    </div>
                `;
                cardContainer.appendChild(card);
            });

            // Add event listener for delete buttons
            document.querySelectorAll(".delete-btn").forEach(button => {
                button.addEventListener("click", function () {
                    const messId = this.getAttribute("data-id");
                    fetch(`remove.php?id=${messId}`, { method: "GET" })
                        .then(response => response.text())
                        .then(result => {
                            if (result === "success") {
                                this.closest(".card").remove();
                                alert("Mess deleted successfully!");
                            } else {
                                alert("Failed to delete mess.");
                            }
                        })
                        .catch(error => console.error("Error deleting mess:", error));
                });
            });
        })
        .catch(error => console.error("Error fetching mess data:", error));
});

    </script>
    <script>
    // JavaScript for handling updates
    document.querySelectorAll(".update-btn").forEach(button => {
        button.addEventListener("click", function () {
            const id = this.getAttribute("data-id");
            const input = document.querySelector(`.price-input[data-id="${id}"]`);
            const newPrice = input.value;

            fetch("update.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: `id=${id}&new_price=${newPrice}`
            })
                .then(response => response.text())
                .then(result => {
                    if (result === "success") {
                        alert("Price updated successfully!");
                    } else {
                        alert("Failed to update price.");
                    }
                })
                .catch(error => console.error("Error updating price:", error));
        });
    });
</script>
<script>
        // Fetch messages for mess admins
        fetch('mess_admin_fectch_con.php')
            .then(response => response.json())
            .then(data => {
                const tableBody = document.getElementById('messMessages');
                data.forEach(message => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${message.name}</td>
                        <td>${message.email}</td>
                        <td>${message.phone}</td>
                        <td>${message.message}</td>
                    `;
                    tableBody.appendChild(row);
                });
            })
            .catch(error => console.error('Error fetching messages:', error));
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
    console.log("Admin Mess Info Page Loaded");

    // Example: Add dynamic functionality if needed
    const galleryImages = document.querySelectorAll(".messadmin-gallery-image");
    galleryImages.forEach((image) => {
        image.addEventListener("click", () => {
            alert(`You clicked on ${image.alt}`);
        });
    });
});

    </script>
</body>
</html>

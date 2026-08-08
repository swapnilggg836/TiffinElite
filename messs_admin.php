<?php
session_start();
require_once 'connection.php';

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Fetch orders from database
$sql = "SELECT id, service_name, user_name, email, phone, address, order_date FROM servicesss";
$result = $conn->query($sql);
?>
 <?php
require_once 'connection.php';
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Function to safely fetch counts
function getCount($conn, $query) {
    $result = $conn->query($query);
    return ($result && $row = $result->fetch_assoc()) ? intval($row['count']) : 0;
}

// Fetch total counts
$total_users = getCount($conn, "SELECT COUNT(id) AS count FROM users");
$total_contacts = getCount($conn, "SELECT COUNT(id) AS count FROM contact_messages");
$total_orders = getCount($conn, "SELECT COUNT(id) AS count FROM orders");
$total_products = getCount($conn, "SELECT COUNT(id) AS count FROM mess");
$total_service_users = getCount($conn, "SELECT COUNT(DISTINCT id) AS count FROM servicesss");

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="assets/css/messs_admin.css">
    <style>
        /* Mess Information Section */
#mess-info {
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin: 20px;
}

/* Navbar Styling */
.messadmin-navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color:rgb(229, 234, 238);
    color: white;
    padding: 15px;
    border-radius: 8px;
}

.messadmin-nav-left h1 {
    font-size: 24px;
    margin: 0;
}

.messadmin-photo {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
}

/* Mess Information Container */
.messadmin-container {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-top: 20px;
}

/* Mess Name */
.messadmin-mess-name {
    font-size: 22px;
    color: #003366;
    margin-bottom: 10px;
}

/* Description */
.messadmin-description {
    font-size: 16px;
    color: #555;
    line-height: 1.5;
}

/* Location Section */
.messadmin-location {
    margin-top: 20px;
}

.messadmin-location-heading {
    font-size: 18px;
    color: #003366;
    margin-bottom: 5px;
}

.messadmin-location-address {
    font-size: 16px;
    color: #666;
}

/* Image Gallery */
.messadmin-gallery {
    margin-top: 20px;
}

.messadmin-gallery-heading {
    font-size: 18px;
    color: #003366;
    margin-bottom: 10px;
}

.messadmin-gallery-images {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.messadmin-gallery-image {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 5px;
    border: 1px solid #ddd;
    transition: transform 0.3s ease-in-out;
}

.messadmin-gallery-image:hover {
    transform: scale(1.1);
}

/* Responsive Design */
@media (max-width: 768px) {
    .messadmin-navbar {
        flex-direction: column;
        text-align: center;
    }

    .messadmin-gallery-images {
        justify-content: center;
    }

    .messadmin-gallery-image {
        width: 80px;
        height: 80px;
    }
}
#dash-info{
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #ff416c,rgb(27, 26, 25));
            color: white;
            text-align: center;
            height:100%;
            
        }
        .dashboard {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 50px;
        }
        .card {
            background: rgba(255, 255, 255, 0.2);
            padding: 20px;
            border-radius: 10px;
            width: 200px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        .card p {
            font-size: 30px;
            font-weight: bold;
        }

    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="#" onclick="showSection('mess-info')">Add Mess Information</a></li>
            <li><a href="#" onclick="showSection('dash-info')">Dashboard</a></li>
            <li><a href="#" onclick="showSection('mess-add')">Add Menu</a></li>
            <li><a href="#" onclick="showSection('product-section')">products</a></li>
            <li><a href="#" onclick="showSection('services-section')">services</a></li>
            <li><a href="#" onclick="showSection('servicesorder-section')">services order</a></li>
            <li><a href="#" onclick="showSection('pricing-section')">Update Pricing</a></li>
            <li><a href="#" onclick="showSection('contact-section')">Contact Information</a></li>
            <li><a href="#" onclick="showSection('order-section')">order </a></li>
            <li><a href="home.php">Home</a></li>
            <li><a href="home.php">Logout</a></li>
        </ul>
    </div>

    <!-- Content Area -->
    <div class="content">
        <h1>Welcome</h1>
         <!-- Mess Information Section -->
                
         <div class="section" id="dash-info">
    <h3>Dashboard</h3>
    <div class="dashboard">
        <div class="card">
            <h2>Total Users</h2>
            <p><?php echo $total_users; ?></p>
        </div>
        <div class="card">
            <h2>Total Contacts</h2>
            <p><?php echo $total_contacts; ?></p>
        </div>
        <div class="card">
            <h2>Total Orders</h2>
            <p><?php echo $total_orders; ?></p>
        </div>
        <div class="card">
            <h2>Total Products</h2>
            <p><?php echo $total_products; ?></p>
        </div>
        <div class="card">
            <h2>Service take user</h2>
            <p><?php echo $total_service_users; ?></p>
        </div>
    </div>
</div>
       
        <!-- Mess Information Section -->
        <div class="section" id="mess-info">
            <h3>Add Mess Information</h3>
            <div class="messadmin-navbar">
                <div class="messadmin-nav-left">
                    <h1 class="messadmin-heading">Gaikwad Mess</h1>
                </div>
                <div class="messadmin-nav-right">
                    <img src="assets/img/logo.jpg" alt="Admin Photo" class="messadmin-photo">
                </div>
            </div>

            <div class="messadmin-container">
                <div class="messadmin-info">
                    <h2 class="messadmin-mess-name">Spice House Mess</h2>
                    <p class="messadmin-description">
                    TiffinElite is more than just a food delivery service. We are committed to helping 
                those in need by providing nutritious meals to the poor and underprivileged. Every
                 meal ordered contributes to feeding someone who is struggling, making sure no one
                  goes hungry. Join us in making a difference, one meal at a time.
                    </p>
                </div>

                <div class="messadmin-location">
                    <h3 class="messadmin-location-heading">Location</h3>
                    <p class="messadmin-location-address">Govind nagar nashik</p>
                </div>

                <div class="messadmin-gallery">
                    <h3 class="messadmin-gallery-heading">Image Gallery</h3>
                    <div class="messadmin-gallery-images">
                        <img src="assets/img/pexels-chanwalrus-958545.jpg" alt="Food 1" class="messadmin-gallery-image">
                        <img src="assets/img/pexels-janetrangdoan-1099680.jpg" alt="Food 2" class="messadmin-gallery-image">
                        <img src="assets/img/pexels-robinstickel-70497.jpg" alt="Food 3" class="messadmin-gallery-image">
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Menu Section -->
        <div class="section" id="mess-add">
            <h3>Add Menu</h3>
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
        <!-- Update Pricing Section -->
        <div class="section" id="services-section">
            <h3>Services Section</h3>
            <div class="form-containerr">
        <h2>Add a Service</h2>
        <form method="POST" action="messs_admin.php">
            <div>
            <label for="services_name">services name</label>
            <input type="text" id="services_name" name="services_name" required>
            </div>
            <div>
            <label for="services_photos">Menu Photos:</label>
            <input type="file" id="services_photos" name="services_photos" multiple required>
            </div>
            <div class="form-groupp">
                <label for="service_type">Choose Service Type:</label>
                <select id="service_type" name="service_type" required>
                    <option value="">-- Select --</option>
                    <option value="Mess">Mess</option>
                    <option value="Hotel">Hotel</option>
                    <option value="Hostel">Hostel</option>
                </select>
            </div>
            <div class="form-groupp">
                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="4" placeholder="Enter service description..." required></textarea>
            </div>
            <button type="submit">Add Service</button>
        </form>
    </div>
        </div>
        <div class="section" id="servicesorder-section">
             <h1>services order</h1>
             <table class="servicesorder">
        <thead>
            <tr>
                <th>ID</th>
                <th>Service Name</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Order Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result) {
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr id='row_" . $row["id"] . "'>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["service_name"] . "</td>";
                        echo "<td>" . $row["user_name"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["phone"] . "</td>";
                        echo "<td>" . $row["address"] . "</td>";
                        echo "<td>" . $row["order_date"] . "</td>";
                        echo "<td>
                                <button class='confirm-btn' onclick='confirmOrder(" . $row["id"] . ")'>Confirm</button>
                                <button class='delete-btn' onclick='deleteOrder(" . $row["id"] . ")'>Delete</button>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>No orders found</td></tr>";
                }
            } else {
                echo "<tr><td colspan='9'>Error: " . $conn->error . "</td></tr>";
            }
            ?>
        </tbody>
    </table>
    </table>

        </div>
        <!-- Update Pricing Section -->
        <div class="section" id="pricing-section">
            <h3>Update Pricing</h3>
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
                        require_once 'connection.php';

                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        $sql = "SELECT id, mess_name, menu_name, menu_price FROM mess";
                        $result = $conn->query($sql);

                        $messData = [];
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $messData[] = $row;
                            }
                        }
                        $conn->close();

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
        <?php
include 'connection.php'; // Database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['confirm_order'])) {
        $order_id = $_POST['order_id'];
        $update_query = "UPDATE orders SET status='confirmed' WHERE id=$order_id";
        mysqli_query($conn, $update_query);
    }

    if (isset($_POST['delete_order'])) {
        $order_id = $_POST['order_id'];
        $delete_query = "DELETE FROM orders WHERE id=$order_id";
        mysqli_query($conn, $delete_query);
    }
}

// Fetch orders
$query = "SELECT * FROM orders ORDER BY order_date DESC";
$result = mysqli_query($conn, $query);
?>
          <!-- Update Pricing Section -->
        <div class="section" id="order-section">
           
           <div class="container">
    <h2>Orders Management</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Mess ID</th>
                <th>User ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Payment</th>
                <th>Location</th>
                <th>Status</th>
                <th>Order Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['mess_id']; ?></td>
                    <td><?php echo $row['user_id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['payment_method']; ?></td>
                    <td><?php echo $row['location']; ?></td>
                    <td class="<?php echo $row['status'] == 'pending' ? 'pending' : 'confirmed'; ?>">
                        <?php echo ucfirst($row['status']); ?>
                    </td>
                    <td><?php echo $row['order_date']; ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">
                            <?php if ($row['status'] == 'pending') { ?>
                                <button type="submit" name="confirm_order" class="confirm-btn">Confirm</button>
                            <?php } ?>
                            <button type="submit" name="delete_order" class="delete-btn">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
        </div>
        <!-- Contact Information Section -->
        <div class="section" id="contact-section">
            <h3>Contact Information</h3>
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
        <?php
// Database connection
require_once 'connection.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle delete request
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_sql = "DELETE FROM mess WHERE id = ?";
    
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $delete_id);
    
    if ($stmt->execute()) {
        echo "<script>alert('Record deleted successfully!'); window.location.href='fetch_mess.php';</script>";
    } else {
        echo "<script>alert('Error deleting record!');</script>";
    }
    $stmt->close();
}

// Fetch data from the mess table
$sql = "SELECT * FROM mess ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
        <div class="section" id="product-section">
        <div class="container">
    <h2 class="title">Mess Menu List</h2>
    <table class="mess-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Mess Name</th>
                <th>Menu Name</th>
                <th>Photo</th>
                <th>Price</th>
                <th>Address</th>
                <th>Description</th>
                <th>Opening Time</th>
                <th>Closing Time</th>
                <th>Service Type</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['id']}</td>";
                    echo "<td>{$row['mess_name']}</td>";
                    echo "<td>{$row['menu_name']}</td>";
                    echo "<td><img src='uploads/{$row['menu_photos']}' alt='Menu Image' class='menu-img'></td>";
                    echo "<td>₹{$row['menu_price']}</td>";
                    echo "<td>{$row['address']}</td>";
                    echo "<td>{$row['description']}</td>";
                    echo "<td>{$row['opening_time']}</td>";
                    echo "<td>{$row['closing_time']}</td>";
                    echo "<td>{$row['service_type']}</td>";
                    echo "<td>{$row['created_at']}</td>";
                    echo "<td><button class='delete-btn' onclick='confirmDelete({$row['id']})'>Delete</button></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='12'>No records found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>                     </div>
        <!-- Additional Sections -->
        <div class="section" id="gotohome">
            <h3>Home</h3>
            <!-- Home content here -->
        </div>

        <div class="section" id="logout">
            <h3>Log Out</h3>
            <!-- Log out content here -->
        </div>
    </div>
    <?php
// Database connection
require_once 'connection.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $services_name = $_POST['services_name'];
    $service_type = $_POST['service_type'];
    $description = $_POST['description'];

    // Handle file upload
    $uploaded_files = [];
    if (!empty($_FILES['services_photos']['name'][0])) {
        $upload_dir = "uploads/";

        // Ensure the uploads directory exists
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        foreach ($_FILES['services_photos']['tmp_name'] as $key => $tmp_name) {
            $file_name = basename($_FILES['services_photos']['name'][$key]);
            $target_file = $upload_dir . $file_name;
            
            // Move uploaded file and check for errors
            if (move_uploaded_file($tmp_name, $target_file)) {
                $uploaded_files[] = $target_file;
            } else {
                echo "Error uploading file: " . $_FILES['services_photos']['name'][$key];
            }
        }
    }

    // Convert file paths to JSON for database storage
    $photos_json = json_encode($uploaded_files);

    // Prepare and execute the SQL query
    $stmt = $conn->prepare("INSERT INTO servicesadmin (services_name, service_type, description, photos) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $services_name, $service_type, $description, $photos_json);

    if ($stmt->execute()) {
        echo "Service added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

    <script>
        function showSection(sectionId) {
            var sections = document.getElementsByClassName('section');
            for (var i = 0; i < sections.length; i++) {
                sections[i].style.display = 'none';
            }
            var sectionToShow = document.getElementById(sectionId);
            if (sectionToShow) {
                sectionToShow.style.display = 'block';
            }
        }

        document.querySelector("form").addEventListener("submit", function (e) {
            const photos = document.getElementById("menu_photos").files;
            if (photos.length === 0) {
                alert("Please upload at least one photo.");
                e.preventDefault();
            }
        });

        // Handle Pricing Update
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

        // Fetch Messages for Admins
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
        function confirmDelete(id) {
    if (confirm("Are you sure you want to delete this record?")) {
        window.location.href = `fetch_mess.php?delete_id=${id}`;
    }
}

    </script>
   
   <script>
        function confirmOrder(orderId) {
    fetch('update_servicesorder.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id: orderId, status: 'Confirmed' })  // Sending ID and status update
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById('status_' + orderId).innerText = "Confirmed";
        } else {
            alert("Failed to update status.");
        }
    })
    .catch(error => console.error('Error:', error));
}

        function deleteOrder(orderId) {
            if (confirm("Are you sure you want to delete this order?")) {
                fetch('delete_servicesorder.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id: orderId })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('row_' + orderId).remove();
                    } else {
                        alert("Failed to delete order.");
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        }
    </script>
</body>
</html>

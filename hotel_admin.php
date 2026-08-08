<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page - Tiffin Services</title>
    <link rel="stylesheet" href="styles.css">
    <style>
       /* General Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    display: flex;
    background-color: #f5f5f5;
}

/* Sidebar Styling */
.sidebar {
    width: 20%;
    height: 100vh;
    background-color: #343a40;
    color: #fff;
    position: fixed;
    overflow-y: auto;
    padding: 20px;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
}

.sidebar h2 {
    margin-bottom: 20px;
    color: #ffc107;
}

.sidebar ul {
    list-style: none;
}

.sidebar ul li {
    margin: 10px 0;
}

.sidebar ul li a {
    text-decoration: none;
    color: #adb5bd;
    font-weight: bold;
    display: block;
    padding: 10px;
    border-radius: 4px;
}

.sidebar ul li a:hover {
    background-color: #495057;
    color: #fff;
}

/* Content Styling */
.content {
    margin-left: 20%;
    width: 80%;
    padding: 20px;
}

.content h1 {
    margin-bottom: 20px;
    color: #212529;
}

/* Section Styling */
.section {
    display: none;
    margin-bottom: 20px;
    padding: 15px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.section h3 {
    margin-bottom: 10px;
    color: #343a40;
}

/* Table Styling */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table th, table td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
}

table th {
    background-color: #f8f9fa;
    color: #495057;
}

table tr:nth-child(even) {
    background-color: #f2f2f2;
}

table tr:hover {
    background-color: #e9ecef;
}

/* Button Styling */
button, .delete-btn {
    display: inline-block;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    text-align: center;
    font-size: 14px;
}

button {
    background-color: #007bff;
    color: #fff;
}

button:hover {
    background-color: #0056b3;
}

.delete-btn {
    background-color: #dc3545;
    color: white;
}

.delete-btn:hover {
    background-color: #c82333;
}

    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="#" onclick="showSection('dashboard')">Dashboard</a></li>
            <li><a href="#" onclick="showSection('add-menu')">Add Menu</a></li>
            <li><a href="#" onclick="showSection('update-pricing')">Update Pricing</a></li>
            <li><a href="#" onclick="showSection('contact-info')">Contact Info</a></li>
            <li><a href="home.php">Home</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="content">
        <h1>Welcome, Admin</h1>

        <!-- Dashboard Section -->
        <div class="section" id="dashboard">
            <h3>Dashboard</h3>
            <p>Welcome to the admin dashboard. Manage your services here.</p>
        </div>
         <hr>
        <!-- Add Menu Section -->
        <div class="section" id="add-menu">
            <h3>Add Menu</h3>
            <div class="form-container">
                <form action="hotel_admin_menu.php" method="POST" enctype="multipart/form-data">
                    <label for="mess_name">Mess Name:</label>
                    <input type="text" id="mess_name" name="mess_name" required>

                    <label for="menu_name">Menu Name:</label>
                    <input type="text" id="menu_name" name="menu_name" required>

                    <label for="menu_photos">Menu Photos:</label>
                    <input type="file" id="menu_photos" name="menu_photos[]" multiple required>

                    <label for="menu_price">Menu Price:</label>
                    <input type="number" id="menu_price" name="menu_price" required>

                    <label for="description">Description:</label>
                    <textarea id="description" name="description" required></textarea>

                    <button type="submit">Add Menu</button>
                </form>
            </div>
        </div>

        <!-- Update Pricing Section -->
        <div class="section" id="update-pricing">
            <h3>Update Pricing</h3>
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
                <tbody>
                    <!-- Dynamic Rows -->
                </tbody>
            </table>
        </div>

        <!-- Contact Info Section -->
        <div class="section" id="contact-info">
    <h3>Contact Information</h3>
    <p>Contact messages will be displayed here.</p>
    <div class="loading" id="loading">Loading messages...</div>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Message</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="hostelMessages"></tbody>
    </table>
</div>


    <script>
        function showSection(sectionId) {
            const sections = document.querySelectorAll(".section");
            sections.forEach(section => section.style.display = "none");
            document.getElementById(sectionId).style.display = "block";
        }

        document.addEventListener("DOMContentLoaded", () => {
            showSection('dashboard');
        });
    </script>
   <script>
    // Fetch messages for hostel admins
    const fetchMessages = () => {
        fetch('hostel_admin_fetch_con.php')
            .then(response => response.json())
            .then(data => {
                const tableBody = document.getElementById('hostelMessages');
                tableBody.innerHTML = ''; // Clear previous data

                if (data.error) {
                    console.error(data.error);
                    return;
                }

                data.forEach(message => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${message.name}</td>
                        <td>${message.email}</td>
                        <td>${message.phone}</td>
                        <td>${message.message}</td>
                        <td><button class="delete-btn" onclick="deleteMessage(${message.id})">Delete</button></td>
                    `;
                    tableBody.appendChild(row);
                });
            })
            .catch(error => console.error('Error fetching messages:', error));
    };

    // Delete a message
    const deleteMessage = (id) => {
        if (confirm('Are you sure you want to delete this message?')) {
            fetch('hostel_admin_fetch_con.php', {
                method: 'DELETE',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `id=${id}`
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Message deleted successfully');
                        fetchMessages();
                    } else {
                        console.error(data.error || 'Failed to delete message');
                    }
                })
                .catch(error => console.error('Error deleting message:', error));
        }
    };

    // Fetch messages on page load
    fetchMessages();
</script>
</body>
</html>

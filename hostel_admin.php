<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page - Tiffin Services</title>
    <link rel="stylesheet" href="assets/css/fetchdatahotel.css">
    <style>
         * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7fb;
            color: #333;
            padding: 0;
            margin: 0;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #ffffff;
            position: fixed;
            top: 0;
            left: 0;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .sidebar h2 {
            margin-bottom: 20px;
            color: #0056b3;
            font-size: 24px;
            font-weight: bold;
        }

        .sidebar ul {
            list-style: none;
        }

        .sidebar ul li {
            margin: 10px 0;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            font-size: 16px;
        }

        .sidebar ul li a:hover {
            color: #0056b3;
        }

        .content {
            margin-left: 250px;
            padding: 30px;
        }

        .content h1 {
            color: #333;
            font-size: 28px;
            margin-bottom: 20px;
        }

        .section {
            display: none;
            margin-bottom: 20px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .section h3 {
            margin-bottom: 20px;
            font-size: 22px;
            color: #007bff;
        }

        .form-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 400px;
            margin: 0 auto;
        }

        .form-container h1 {
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
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }

        .hotel-card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .hotel-card {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 300px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hotel-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        }

        .hotel-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .hotel-card-content {
            padding: 15px;
        }

        .hotel-card-content h3 {
            margin: 0 0 10px;
            color: #0056b3;
            font-size: 18px;
        }

        .hotel-card-content p {
            margin: 5px 0;
            color: #555;
        }

        .hotel-card-content .price {
            font-weight: bold;
            color: #333;
        }

        .hotel-card-content .service-type {
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

        /* Pricing Section */
        #pricing-section {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 20px;
        }

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

        /* Contact Section */
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

        /* Contact Fetch Data */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f9;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        p {
            text-align: center;
            color: #666;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table th, table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #f8f8f8;
            color: #333;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        .delete-btn {
            background-color: #ff4d4d;
            color: #fff;
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .delete-btn:hover {
            background-color: #e60000;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Admin Panel Hostel</h2>
        <ul>
            <li><a href="#" onclick="showSection('user-profile')">Dashboard</a></li>
            <li><a href="#" onclick="showSection('mess-add')">Hostel Services</a></li>
            <li><a href="#" onclick="showSection('mess-info')">Add Hostel Information</a></li>
            <li><a href="#" onclick="showSection('pricing-section')">Update Pricing</a></li>
            <li><a href="#" onclick="showSection('contact-section')">Contact Information</a></li>
            <li><a href="#" onclick="showSection('contact-info')">Contact Info</a></li>
            <li><a href="home.php">Home</a></li>
            <li><a href="home.php">Logout</a></li>
        </ul>
    </div>

    <div class="content">
        <h1>Welcome, Admin</h1>

        <div class="section" id="user-profile">
            <h3>User Profile</h3>
            <!-- User profile content here -->
        </div>

        <div class="section" id="mess-add">
            <h3>Add Menu</h3>
            <div class="form-container">
                <h1>Add Hostel Information</h1>
                <form action="add_hostel.php" method="POST" enctype="multipart/form-data">
                    <label for="mess_name">Hostel Name:</label>
                    <input type="text" id="mess_name" name="mess_name" required>

                    <label for="menu_name">Menu Services:</label>
                    <input type="text" id="menu_name" name="menu_name" required>

                    <label for="menu_photos">Hostel Photos:</label>
                    <input type="file" id="menu_photos" name="menu_photos[]" multiple required>

                    <label for="menu_price">Price:</label>
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
                        <option value="online">Online Booking</option>
                        <option value="offline">Offline Booking</option>
                    </select>

                    <button type="submit">Add Hostel</button>
                </form>
            </div>
        </div>

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
                <tbody id="hotelMessages"></tbody>
            </table>
        </div>

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

            const fetchMessages = () => {
                fetch('hotel_admin_fetch_con.php')
                    .then(response => response.json())
                    .then(data => {
                        const tableBody = document.getElementById('hotelMessages');
                        tableBody.innerHTML = '';
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

            const deleteMessage = (id) => {
                fetch(`delete_message.php?id=${id}`, { method: 'DELETE' })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Message deleted successfully');
                            fetchMessages();
                        } else {
                            alert('Error deleting message');
                        }
                    })
                    .catch(error => console.error('Error deleting message:', error));
            };

            fetchMessages();
        </script>
    </div>
</body>
</html>

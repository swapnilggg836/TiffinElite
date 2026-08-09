


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="assets/css/complete-style.css">
    <link rel="stylesheet" href="assets/css/main-style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In / Sign Up</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        /* Body Styling */
        body {
            background-image: linear-gradient(180deg, #003366, #99ccff);
            color: #333;
            line-height: 1.6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 1rem;
        }

        /* Form Container */
        .form-container {
            width: 100%;
            max-width: 400px;
            background: #fff;
            padding: 2rem;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            margin: 1rem;
        }

        .form-container h1 {
            text-align: center;
            margin-bottom: 1.5rem;
            font-size: 1.8rem;
            color: #003366;
        }

        /* Form Styling */
        form label {
            display: block;
            font-weight: bold;
            margin-bottom: 0.5rem;
            color: #003366;
        }

        form input,
        form select {
            width: 100%;
            padding: 0.75rem;
            margin-bottom: 1rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }

        form button {
            background-color: #003366;
            color: white;
            padding: 0.75rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: bold;
            width: 100%;
        }

        form button:hover {
            background-color: #005bb5;
        }

        /* Toggle Button */
        .toggle-button {
            text-align: center;
            margin-top: 1rem;
        }

        .toggle-button a {
            color: #003366;
            text-decoration: none;
            font-weight: bold;
        }

        .toggle-button a:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .form-container {
                padding: 1.5rem;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            .form-container h1 {
                font-size: 1.5rem;
            }

            form input,
            form select {
                padding: 0.6rem;
                font-size: 0.9rem;
            }

            form button {
                padding: 0.6rem;
                font-size: 0.9rem;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 0.5rem;
            }

            .form-container {
                padding: 1rem;
            }

            .form-container h1 {
                font-size: 1.3rem;
            }

            form input,
            form select {
                padding: 0.5rem;
                font-size: 0.8rem;
            }

            form button {
                padding: 0.5rem;
                font-size: 0.8rem;
            }
        }


        
    </style>
</head>
<body>

<!-- Sign-Up Form -->
<div class="form-container" id="signup-form">
    <h1>Sign Up</h1>
    <form action="signupadmin.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="user_type">User Type:</label>
        <select id="user_type" name="user_type" required>
            <option value="hotel">Hotel</option>
            <option value="mess">Mess</option>
            <option value="hostel">Hostel</option>
        </select>

        <button type="submit">Sign Up</button>
    </form>
    <div class="toggle-button">
        <p>Already have an account? <a href="#" onclick="toggleForms()">Sign In</a></p>
    </div>
</div>

<!-- Sign-In Form -->
<div class="form-container" id="signin-form" style="display: none;">
    <h1>Sign In</h1>
    <form action="loginadmin.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Sign In</button>
    </form>
    <div class="toggle-button">
        <p>Don't have an account? <a href="#signup-form" onclick="toggleForms()">Sign Up</a></p>
    </div>
</div>

<script>
    // JavaScript for toggling between Sign In and Sign Up forms
    function toggleForms() {
        const signupForm = document.getElementById('signup-form');
        const signinForm = document.getElementById('signin-form');
        signupForm.style.display = signupForm.style.display === 'none' ? 'block' : 'none';
        signinForm.style.display = signinForm.style.display === 'none' ? 'block' : 'none';
    }
</script>

</body>
</html>

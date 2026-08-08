<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            padding: 0px;
      margin: 0px;
      box-sizing: border-box;
        }
              /* Header Styles */
              header {
            display: flex;
            justify-content: space-between;
            align-items: center;
         
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
.social-icons  {
    color: white;
}
.social-icons a {
    color: white;
    font-size: 24px;
    margin: 0 5px;
    transition: color 0.3s;
}

.social-icons a:hover {
    color: #FFD700;
}

/* About Section */
.setting{
    font-family: Arial, sans-serif;
}
.about {
    background: rgb(224, 251, 222);
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.8), rgba(0, 0, 0, 0.8)), url('assets/img/your-background-image.jpg');
    padding: 100px 0 20px 0;
    text-align: center;
}

.about h1 {
    font-size: 2.5rem;
    margin-bottom: 20px;
}

.about p {
    font-size: 1rem;
    color: #323030;
    max-width: 800px;
    margin: 0 auto;
}

.about-info {
    margin: 2rem 2rem;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: left;
}

.about-img {
    width: 20rem;
    height: 20rem;

}

.about-img img {
    width: 100%;
    height: 100%;
    border-radius: 5px;
    object-fit: contain;
}

.about-info p {
    font-size: 1.3rem;
    margin: 0 2rem;
    text-align: justify;
}

button {
    border: none;
    outline: 0;
    padding: 10px;
    margin: 2rem;
    font-size: 1rem;
    color: white;
    background-color: #40b736;
    text-align: center;
    cursor: pointer;
    width: 15rem;
    border-radius: 4px;
}

button:hover {
    background-color: #1f9405;
}

/* Team Section */

.team {
    padding: 30px 0;
    text-align: center;
}

.team h1 {
    font-size: 2.5rem;
    margin-bottom: 20px;
}

.team-cards {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 15px;
    margin-top: 20px;
}

.card {
    background-color: white;
    border-radius: 6px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.5);
    overflow: hidden;
    transition: transform 0.2s, box-shadow 0.2s;
    width: 18rem;
    height: 25rem;
    margin-top: 10px;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 12px rgba(0, 0, 0, 0.5);
}

.card-img {
    width: 18rem;
    height: 12rem;
}

.card-img img {
    width: 100%;
    height: 100%;
    object-fit: fill;
}

.card-info button {
    margin: 2rem 1rem;
}

.card-name {
    font-size: 2rem;
    margin: 10px 0;
}

.card-role {
    font-size: 1rem;
    color: #888;
    margin: 5px 0;
}

.card-email {
    font-size: 1rem;
    color: #555;
}
#about1{
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 15px;
    margin-top: 20px;
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
                <li><a href="index.php">Home</a></li>
                
            </ul>
        </nav>
    </header>
    <div class="setting">
          <div>
          <section class="about">
        <h1>About Us</h1>
        <p style="font-weight: bold">
        <h2>TiffinElite</h2>
          </p>
        <div class="about-info">
            <div class="about-img">
                <img src="OIP.jpg" alt="phpto">
            </div>
            <div>
            <p> TiffinElite is more than just a food delivery service. We are committed to helping 
                those in need by providing nutritious meals to the poor and underprivileged. Every
                 meal ordered contributes to feeding someone who is struggling, making sure no one
                  goes hungry. Join us in making a difference, one meal at a time.
            </p>
                <button>Read More...</button>
            </div>
        </div>
    </section>

    <section class="team">
        <h1>Meet Our Team</h1>
        <div class="team-cards">
          
            <!-- Cards here -->
            <!-- Card 1 -->
          
            <div class="card">
                <div class="card-img">
                    <img src="assets\img\swapnil.jpg" alt="User 1">
                </div>
                <div class="card-info">
                    <h2 class="card-name">Swapnil Gaikwad</h2>
                    <p class="card-email">swapnilg836@gmail.com</p>
                    <p><button class="button">Contact</button></p>
                </div>
            </div>

            <!-- Card 2 -->
          
           
          
            <!-- Card 3 -->
          
            <div class="card">
                <div class="card-img">
                    <img src="assets\img\komal.jpg" alt="User 3">
                </div>
                <div class="card-info">
                    <h2 class="card-name">Komal Godse</h2>
                    <p class="card-email">komal@example.com</p>
                    <p><button class="button">Contact</button></p>
                </div>
            </div>
            <div class="card">
                <div class="card-img">
                    <img src="assets\img\akansha.jpg" alt="User 2">
                </div>
                <div class="card-info">
                    <h2 class="card-name">Akansha Thakre</h2>
                    <p class="card-email">ak@example.com</p>
                    <p><button class="button">Contact</button></p>
                </div>
            </div>
        </div>
    </section>
          </div>
    </div>
    <section class="about" id="about1">
    <h2>Our Supplier</h2>
    <div class="card">
        
                <div class="card-img">
                    <h1>Online Mess And Home Mess</h1>
                </div>
                <div class="card-info">
                    <ul>
                        <li>Home med tiffine</li>
                        <li>Less price</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card">
                <div class="card-img">
                    <h1>Online Hotel Food and Booking</h1>
                </div>
                <div class="card-info">
                    <ul>
                        <li>Best services</li>
                        <li>Couster choice</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card">
                <div class="card-img">
                    <h1>Online Hostel and Restaurant Booking</h1>
                </div>
                <div class="card-info">
                    <ul>
                        <li>Best services</li>
                        <li>Rooms and food</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
  
    <section class="about">
       
       </section>


    <section class="about">
       
       </section>






    <footer class="foot">
    <div class="footer-links">
      <a href="setting.php">Settings</a>
      <a href="setting.php">Privacy</a>
      <a href="setting.php">Help & Support</a>
      <a href="setting.php">Display & Accessibility</a>
      <a href="setting.php">Supplier</a>
    </div>
   
    <h5 style="color:white;">@created by group 6</h5>
  </footer>
</body>
</html>
<?php
// Database connection
require_once 'connection.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $message = $conn->real_escape_string($_POST['message']);

    $sql = "INSERT INTO contact_form (name, email, phone, message) 
            VALUES ('$name', '$email', '$phone', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "Message submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="assets/css/complete-style.css">
    <link rel="stylesheet" href="assets/css/main-style.css">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tiffin Services</title>

  <link rel="stylesheet" href="assets/css/tokens.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <link rel="stylesheet" href="assets/css/ani.css">
  <script src="js/search.js" defer></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    * {
      padding: 0px;
      margin: 0px;
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: linear-gradient(135deg, rgba(255, 255, 255, 0.8), rgba(0, 0, 0, 0.8)), url('assets/img/your-background-image.jpg');
      color: #fff;
    }

    header {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      align-items: center;
      background-color: #000;
      color: #FFD700;
      padding: 10px 20px;
    }

    .header-logo img {
      height: 40px;
      border-radius: 50%;
      box-shadow: 0 0 20px yellow;
    }

    .header-search {
      display: flex;
      align-items: center;
      flex: 1;
      justify-content: center;
      margin: 10px 0;
    }

    .header-search input[type="text"] {
      padding: 10px;
      border: 1px solid #FFD700;
      border-radius: 5px 0 0 5px;
      outline: none;
      font-size: 14px;
      width: 70%;
    }

    .header-search button {
      padding: 10px;
      background-color: #FFD700;
      color: #000;
      border: none;
      border-radius: 0 5px 5px 0;
      cursor: pointer;
      font-size: 14px;
    }

    .header-search button:hover {
      background-color: #FFC107;
    }

    .header-nav ul {
      list-style: none;
      display: flex;
      margin: 0;
      padding: 0;
    }

    .header-nav li {
      margin: 0 10px;
    }

    .header-nav a {
      color: white;
      text-decoration: none;
      font-size: 14px;
    }

    .header-nav a:hover {
      text-decoration: underline;
    }


    body::before {
      position: absolute;
      width: min(1400px, 90vw);
      top: 10%;
      left: 50%;
      height: 90%;
      transform: translateX(-50%);
      content: '';

      background-size: 100%;
      background-repeat: no-repeat;
      background-position: top center;
      pointer-events: none;
    }

    .slider-container {
      position: relative;
      width: 100%;
      max-width: 800px;
      margin: auto;
      overflow: hidden;
    }

    .slider {
      display: flex;
      transition: transform 0.5s ease-in-out;
    }

    .slide {
      min-width: 100%;
      box-sizing: border-box;
    }

    .slide img {
      width: 100%;
      display: block;
    }

    .slider-controls {
      position: absolute;
      top: 50%;
      width: 100%;
      display: flex;
      justify-content: space-between;
      transform: translateY(-50%);
    }

    .slider-controls button {
      background-color: rgba(0, 0, 0, 0.5);
      color: #fff;
      border: none;
      padding: 10px 20px;
      cursor: pointer;
      font-size: 16px;
    }

    .slider-controls button:hover {
      background-color: rgba(0, 0, 0, 0.8);
    }

    /* Centered and animated "Hello" */
    .welcomename {
      text-align: center;
      margin-top: 50px;
      height: 250px;
    
    }

    .h1 {
      color: #fff;
      
      font-size: 80px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 2px;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-wrap: wrap;
      text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
    }

    .h1 span {
      display: inline-block;
      opacity: 0;
      margin-top: 50px;
      transform: translateY(20px) rotate(90deg);
      transform-origin: left;
      animation: in 0.5s forwards;
    }

    .h1 span:nth-child(1) {
      animation-delay: 0s;
    }

    .h1 span:nth-child(2) {
      animation-delay: 0.1s;
    }

    .h1 span:nth-child(3) {
      animation-delay: 0.2s;
    }

    .h1 span:nth-child(4) {
      animation-delay: 0.3s;
    }

    .h1 span:nth-child(5) {
      animation-delay: 0.4s;
    }

    .h1 span:nth-child(6) {
      animation-delay: 0.5s;
    }

    .h1 span:nth-child(7) {
      animation-delay: 0.6s;
    }

    .h1 span:nth-child(8) {
      animation-delay: 0.7s;
    }

    .h1 span:nth-child(9) {
      animation-delay: 0.8s;
    }

    .h1 span:nth-child(10) {
      animation-delay: 0.9s;
    }

    .h1 span:nth-child(11) {
      animation-delay: 1s;
    }

    .h1 span:nth-child(12) {
      animation-delay: 1.1s;
    }

    .h1 span:nth-child(13) {
      animation-delay: 1.2s;
    }

    .h1 span:nth-child(14) {
      animation-delay: 1.3s;
    }

    .h1 span:nth-child(15) {
      animation-delay: 1.4s;
    }

    .h1 span:nth-child(16) {
      animation-delay: 1.5s;
    }

    .h1 span:nth-child(17) {
      animation-delay: 1.6s;
    }
    .h1 span:nth-child(18) {
      animation-delay: 1.7s;
    }
    .h1 span:nth-child(19) {
      animation-delay: 1.8s;
    }

    .h1 span:nth-child(20) {
      animation-delay: 1.9s;
    }
    .h1 span:nth-child(21) {
      animation-delay: 2.0s;
    }

    @keyframes in {
      0% {
        opacity: 0;
        transform: translateY(50px) rotate(90deg);
      }

      100% {
        opacity: 1;
        transform: translateY(0) rotate(0);
      }
    }

    .car-gallery {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: center;
      padding: 20px;
    }

    .car-box {
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 10px;
      width: 300px;
      text-align: center;
      color: black;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .car-box img {
      width: 100%;
      border-radius: 8px;
    }

    /* Section for Mess, Hotel, Hostel */


    /*nfdnfdnfdfndjfndjfn*/

    .car-gallery {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: center;
      padding: 20px;
    }

    .car-box {
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 10px;
      width: 300px;
      text-align: center;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      background: white;
    }

    .car-box img {
      width: 100%;
      border-radius: 8px;
    }

    /* Section for Mess, Hotel, Hostel */
    .sectio {

      width: 100%;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 40px;
      padding: 40px 20px;
    }

    .hotel {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 40px;
      padding: 40px 20px;
      width: 90%;
      max-width: 300px;
      border-radius: 50%;
    }

    .hotel a {
      text-decoration: none;
      color: inherit;
      display: block;
      background-color: #fff;
      border-radius: 50px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease-in-out, background-color 0.3s ease;
    }

    .hotel a img {

      border-radius: 50px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);

    }

    .hotel a:hover {
      transform: scale(1.05);
      background-color: rgb(237, 237, 31);
    }

    .hotel img {
      width: 100%;
      height: auto;
      border-radius: 8px;
      padding: 2px;
    }

    .hotel h6 {
      font-size: 18px;
      color: #333;
      margin-top: 10px;
      text-align: center;
      padding: 10px;
    }
    .sectio .hotel {
  position: relative;
  display: inline-block;
  text-align: center;
  margin: 20px;
}

.sectio .hotel .info {
  display: none;
  position: absolute;
  top: 100%;
  left: 50%;
  transform: translateX(-50%);
  background-color: rgba(0, 0, 0, 0.8);
  color: white;
  padding: 10px;
  border-radius: 5px;
  width: 200px;
  text-align: center;
  z-index: 10;
}

.sectio .hotel:hover .info {
  display: block;
}


    #pets {
      /* Add your image path here */
      background-size: cover;
      background-position: center;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 0px;
      box-sizing: border-box;
      overflow: hidden;
      margin: 20px;
      box-shadow: 0 0 30px black;
    }

    .carousel {
      height: 100vh;
      width: 100vw;
      overflow: hidden;
      position: relative;
    }

    .carousel .list .item {
      width: 100%;
      height: 100%;
      position: absolute;
      inset: 0 0 0 0;
    }

    .carousel .list .item img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .carousel .list .item .content {
      position: absolute;
      top: 20%;
      width: 1140px;
      max-width: 80%;
      left: 50%;
      transform: translateX(-50%);
      padding-right: 30%;
      box-sizing: border-box;
      color: #fff;
      text-shadow: 0 5px 10px #0004;
    }

    .carousel .list .item .author {
      font-weight: bold;
      letter-spacing: 5px;
    }

    .carousel .list .item .title,
    .carousel .list .item .topic {
      font-size: 1em;
      font-weight: bold;
      line-height: 0.5em;
    }

    .carousel .list .item .topic {
      color: #f1683a;
    }

    .carousel .list .item .buttons {
      display: grid;
      grid-template-columns: repeat(1, 120px);
      /* 1 column with 120px width */
      grid-template-rows: 1fr;
      /* 1 row with flexible height */
      gap: 10px;
      /* Space between buttons */
      margin-top: 30px;
      /* Margin from the top */
      justify-items: center;
      /* Center the button horizontally */
      align-items: center;
      /* Center the button vertically */
    }

    .carousel .list .item .buttons button {
      font: bold;
      padding: 12px 20px;
      /* Add padding to the button for better size */
      letter-spacing: 1px;
      /* Letter spacing for text */
      font-weight: 500;
      /* Make the text more prominent */
      border: 2px solid #0d0d0d;
      /* Define a border */
      border-radius: 5px;
      /* Add rounded corners */
      background-color: orange;
      /* Transparent background */
      color: #0d0d0d;
      /* Dark text color */
      font-family: 'Poppins', sans-serif;
      /* Ensure the font is consistent */
      cursor: pointer;
      /* Show pointer cursor when hovering */
      transition: all 0.3s ease;
      /* Smooth transition for all styles */
    }

    .carousel .list .item .buttons button:hover {
      background-color: #0ff906;
      /* Dark background on hover */
      color: green;
      /* Change text color to white */
      border-color: #f1683a;
      /* Change border color to orange */
    }

    .carousel .list .item .buttons button:nth-child(2) {
      background-color: transparent;
      border: 2px solid #0d0d0d;
      color: red;
    }

    /* thumbail */
    .thumbnail {
      position: absolute;
      bottom: 50px;
      left: 50%;
      width: max-content;
      z-index: 100;
      display: flex;
      gap: 20px;
    }

    .thumbnail .item {
      width: 150px;
      height: 220px;
      flex-shrink: 0;
      position: relative;
    }

    .thumbnail .item img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 20px;
    }

    .thumbnail .item .content {
      color: #fff;
      position: absolute;
      bottom: 10px;
      left: 10px;
      right: 10px;
    }

    .thumbnail .item .content .title {
      font-weight: 500;
    }

    .thumbnail .item .content .description {
      font-weight: 300;
    }

    /* arrows */
    .arrows {
      position: absolute;
      top: 80%;
      right: 52%;
      z-index: 100;
      width: 300px;
      max-width: 30%;
      display: flex;
      gap: 10px;
      align-items: center;
      margin-top: 4%;
      margin-right: -15%;

    }

    .arrows button {
      width: 40px;
      height: 40px;
      border: 2px solid black;
      border-radius: 50%;
      background-color: rgba(241, 15, 15, );
      border: none;
      color: #f51717;
      font-family: monospace;
      font-weight: bold;
      transition: .5s;
    }

    .arrows button:hover {
      background-color: #f3eeee;
      color: #fa0505;
    }

    /* animation */
    .carousel .list .item:nth-child(1) {
      z-index: 1;
    }

    /* animation text in first item */

    .carousel .list .item:nth-child(1) .content .author,
    .carousel .list .item:nth-child(1) .content .title,
    .carousel .list .item:nth-child(1) .content .topic,
    .carousel .list .item:nth-child(1) .content .des,
    .carousel .list .item:nth-child(1) .content .buttons {
      transform: translateY(50px);
      filter: blur(20px);
      opacity: 0;
      animation: showContent .5s 1s linear 1 forwards;
    }

    @keyframes showContent {
      to {
        transform: translateY(0px);
        filter: blur(0px);
        opacity: 1;
      }
    }

    .carousel .list .item:nth-child(1) .content .title {
      animation-delay: 1.2s !important;
    }

    .carousel .list .item:nth-child(1) .content .topic {
      animation-delay: 1.4s !important;
    }

    .carousel .list .item:nth-child(1) .content .des {
      animation-delay: 1.6s !important;
    }

    .carousel .list .item:nth-child(1) .content .buttons {
      animation-delay: 1.8s !important;
    }

    /* create animation when next click */
    .carousel.next .list .item:nth-child(1) img {
      width: 150px;
      height: 220px;
      position: absolute;
      bottom: 50px;
      left: 50%;
      border-radius: 30px;
      animation: showImage .5s linear 1 forwards;
    }

    @keyframes showImage {
      to {
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border-radius: 0;
      }
    }

    .carousel.next .thumbnail .item:nth-last-child(1) {
      overflow: hidden;
      animation: showThumbnail .5s linear 1 forwards;
    }

    .carousel.prev .list .item img {
      z-index: 100;
    }

    @keyframes showThumbnail {
      from {
        width: 0;
        opacity: 0;
      }
    }

    .carousel.next .thumbnail {
      animation: effectNext .5s linear 1 forwards;
    }

    @keyframes effectNext {
      from {
        transform: translateX(150px);
      }
    }

    /* running time */

    .carousel .time {
      position: absolute;
      z-index: 1000;
      width: 0%;
      height: 3px;
      background-color: #f1683a;
      left: 0;
      top: 0;
    }

    .carousel.next .time,
    .carousel.prev .time {
      animation: runningTime 3s linear 1 forwards;
    }

    @keyframes runningTime {
      from {
        width: 100%
      }

      to {
        width: 0
      }
    }


    /* prev click */

    .carousel.prev .list .item:nth-child(2) {
      z-index: 2;
    }

    .carousel.prev .list .item:nth-child(2) img {
      animation: outFrame 0.5s linear 1 forwards;
      position: absolute;
      bottom: 0;
      left: 0;
    }

    @keyframes outFrame {
      to {
        width: 150px;
        height: 220px;
        bottom: 50px;
        left: 50%;
        border-radius: 20px;
      }
    }

    .carousel.prev .thumbnail .item:nth-child(1) {
      overflow: hidden;
      opacity: 0;
      animation: showThumbnail .5s linear 1 forwards;
    }

    .carousel.next .arrows button,
    .carousel.prev .arrows button {
      pointer-events: none;
    }

    .carousel.prev .list .item:nth-child(2) .content .author,
    .carousel.prev .list .item:nth-child(2) .content .title,
    .carousel.prev .list .item:nth-child(2) .content .topic,
    .carousel.prev .list .item:nth-child(2) .content .des,
    .carousel.prev .list .item:nth-child(2) .content .buttons {
      animation: contentOut 1.5s linear 1 forwards !important;
    }

    @keyframes contentOut {
      to {
        transform: translateY(-150px);
        filter: blur(20px);
        opacity: 0;
      }
    }

    @media screen and (max-width: 678px) {
      .carousel .list .item .content {
        padding-right: 0;
      }

      .carousel .list .item .content .title {
        font-size: 30px;
      }
    }

    .welcomename {
      color: black;
    }


    .footer-links,
    .social-icons {
      display: flex;
      justify-content: center;
      gap: 15px;
      padding: 10px;
      color: black;


    }
    /* Contact Form Section */
#contact {
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 10px;
    max-width: 600px;
    margin: 20px auto;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

#contact h1 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}

.contact-form {
    display: grid;
    grid-template-columns: 1fr;
    gap: 15px;
}

.contact-form label {
    font-size: 14px;
    color: #555;
}

.contact-form input,
.contact-form textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
    outline: none;
    transition: border-color 0.3s;
}

.contact-form input:focus,
.contact-form textarea:focus {
    border-color: #007bff;
}

.contact-form button {
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.contact-form button:hover {
    background-color: #0056b3;
}


    .foot {
      background: #f8f9fa;
      padding: 40px 20px;
      text-align: center;
      box-shadow: 0 -4px 10px rgba(0, 0, 0, 0.1);
    }

    .footer-links a {
      text-decoration: none;
      color: black;

    }

    .footer-links a:hover {
      font-size: large;

    }

    .social-icon a i:hover {
      font-size: large;
    }
    
   /* Hero section */
.hero {
  position: relative;
  width: 100%;
  height: 100vh; /* Full viewport height */
  overflow: hidden;
}

/* Hero content styling */
.hero-content {
  position: absolute;
  top: 50%; /* Positioning content above the video */
  left: 50%;
  transform: translateX(-50%);
  color: white;
  text-align: center;
  z-index: 10; /* Ensure content is above the video */
  background: rgba(0, 0, 0, 0.5); /* Optional: darken the background */
  padding: 20px;
  border-radius: 10px;
}

/* Video styling */
.hero-video {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 1; /* Place video behind content */
  overflow: hidden;
}

#background-video {
  object-fit: cover; /* Ensure the video covers the entire container */
  width: 100%;
  height: 100%;
  filter: brightness(0.6); /* Darkens the video to make text readable */
}

  </style>
</head>

<body id="mainaa">
  <header>
    <div class="header-logo" id="home1">
      <a href="/">
        <img src="assets\img\logo.jpg" alt="YumDabba">
      </a>
    </div>
    <form action="search.php" method="GET" class="header-search-form">
      <input type="text" name="q" placeholder="Search for Tiffin Services, Hotels, Hostels..." required>
      <button type="submit">Search</button>
    </form>
    <nav class="header-nav">
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="#services-section">Services</a></li>
        <li><a href="#contact">Contact</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="sinup.php">sign up</a></li>

      </ul>
    </nav>
  </header>
<!--vedio-->
<div class="hero">
 
  <div class="hero-video">
    <video autoplay muted loop id="background-video">
      <source src="backv.mp4" type="video/mp4">
    </video>
  </div>
</div>
  <!-- Centered Hello Animation -->
  <div class="welcomename">
    <h1 class="h1" style="color:black">
      <span>W</span>
      <span>E</span>
      <span>L</span>
      <span>C</span>
      <span>O</span>
      <span>M</span>
      <span>E
      </span>
      <span><pre> </pre></span>
      <span>TO</span>
      <span>
        <pre>  </pre>
      </span>
      <span>T</span>
      <span>I</span>
      <span>f</span>
      <span>f</span>
      <span>i</span>
      <span>n</span>
      <span>E</span>
      <span>l</span>
      <span>i</span>
      <span>t</span>
      <span>e</span>
      
    </h1>
  </div>

  <!-- Tiffin Gallery Carousel -->
  <section id="pets">
    <!-- carousel -->
    <div class="carousel">
      <!-- list item -->
      <div class="list">
        <div class="item">
          <img src="hotel\a.png">
          <div class="content">
            <div class="title">Delicious Thali</div>
            <div class="topic">DAILY MEAL</div>
            <div class="des" style="font-size: 60%; margin-top: 20px;">
              Enjoy the comfort of home-cooked meals packed fresh every day with love and the best ingredients. Perfect for students and working professionals.
            </div>
            
          </div>
        </div>
        <div class="item">
          <img src="hotel\b.jpg">
          <div class="content">
            <div class="title">Healthy Breakfast</div>
            <div class="topic">MORNING</div>
            <div class="des" style="font-size: 60%; margin-top: 20px;">
              Start your day fresh with our nutritious morning meals prepared with organic standards.
            </div>
           
          </div>
        </div>
        <div class="item">
          <img src="hotel\pizza.jpg">
          <div class="content">
            <div class="title">Weekend Specials</div>
            <div class="topic">FESTIVE</div>
            <div class="des" style="font-size: 60%; margin-top: 20px;">
              Treat yourself to our special weekend menu! From delicious pizzas to exotic dishes, add some flavor to your relaxing days.
            </div>
        </div>
        <div class="item">
          <img src="hotel\thali.jpg">
          <div class="content">
            <div class="title">Complete Meals</div>
            <div class="topic">LUNCH & DINNER</div>
            <div class="des" style="font-size: 60%; margin-top: 20px;">
              Our traditional Indian thalis bring a balanced, satisfying meal straight to your table. Feel at home with every bite!
            </div>
          </div>
        </div>
        <div class="item">
          <img src="mess\bhendi.jpg">
          <div class="content">
            <div class="title">Homemade Veg</div>
            <div class="topic">HEALTHY</div>
            <div class="des" style="font-size: 60%; margin-top: 20px;">
              Fresh, locally sourced vegetables cooked in pure spices. Relish the taste of everyday healthy meals.
            </div>
            <div class="buttons">
              <button>Order Now</button>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="mess\karlela.jpg">
          <div class="content">
            <div class="title">Diet Plans</div>
            <div class="topic">NUTRITIONAL YUM</div>
            <div class="des" style="font-size: 60%; margin-top: 20px;">
              Specially curated low-calorie, high-nutrition setups for fitness enthusiasts. Eat well without breaking your goals!
            </div>
          </div>
        </div>
      </div>
      <!-- list thumnail -->
      <div class="thumbnail">
        <div class="item">
          <img src="hotel\a.png">

        </div>
        <div class="item">
          <img src="hotel\b.jpg"">

        </div>
        <div class="item">
          <img src="hotel\pizza.jpg"">

        </div>
        <div class="item">
          <img src="hotel\thali.jpg"">

        </div>
        <div class="item">
          <img src="mess\bhendi.jpg">

        </div>
        <div class="item">
          <img src="mess\karlela.jpg">

        </div>
      </div>
      <!-- next prev -->

      <div class="arrows">
        <button id="prev">PREV</button>
        <button id="next">NEXT</button>
      </div>
      <!-- time running -->
      <div class="time"></div>
    </div>
<hr>

  </section>
  <hr>
 

  <hr>
  <section id="services-section">
    <div class="car-gallery">
      <div class="car-box">
        <img src="hotel\tiffine.jpg" alt="Daily Tiffin Service">
        <h3>Daily Tiffin Service</h3>
        <p>Fresh and healthy tiffin delivered to your doorstep every day.</p>
        
       
      </div>
      <div class="car-box">
        <img src="hotel\t.jpg" alt="Weekly Tiffin Plan">
        <h3>Weekly Tiffin Plan</h3>
        <p>Enjoy a week's worth of nutritious meals with our weekly plan.</p>
       
      </div>
    <div class="service-grid" style="max-width: 1200px; margin: 30px auto; padding: 0 20px;">
      <div class="service-card">
        <div class="card-img-wrapper">
          <img src="hotel/z.jpg" alt="Custom Meal Plan" onerror="this.src='assets/img/default-food.png';">
        </div>
        <div class="service-card-body">
          <div style="margin-bottom: 8px;"><span class="badge">Mess / Tiffin</span></div>
          <h3 class="service-card-title">Custom Meal Plan</h3>
          <p class="service-card-desc">Get a personalized meal plan based on your preferences.</p>
          <a href="hoemess.php" class="btn btn-primary" style="margin-top: auto;">Explore Mess</a>
        </div>
      </div>

      <div class="service-card">
        <div class="card-img-wrapper">
          <img src="hotel/p.jpg" alt="Daily Tiffin Service" onerror="this.src='assets/img/default-food.png';">
        </div>
        <div class="service-card-body">
          <div style="margin-bottom: 8px;"><span class="badge">Tiffin</span></div>
          <h3 class="service-card-title">Monthly Tiffin Service</h3>
          <p class="service-card-desc">Fresh and healthy tiffin delivered to your doorstep every day.</p>
          <a href="hoemess.php" class="btn btn-primary" style="margin-top: auto;">Explore Tiffin</a>
        </div>
      </div>

      <div class="service-card">
        <div class="card-img-wrapper">
          <img src="hotel/t2.jpg" alt="Fast Food" onerror="this.src='assets/img/default-food.png';">
        </div>
        <div class="service-card-body">
          <div style="margin-bottom: 8px;"><span class="badge">Restaurant</span></div>
          <h3 class="service-card-title">Fast Food & Restaurant</h3>
          <p class="service-card-desc">Fresh, Fast, and Flavorful - Satisfaction in Every Bite!</p>
          <a href="restaurant.php" class="btn btn-primary" style="margin-top: auto;">Explore Food</a>
        </div>
      </div>

      <div class="service-card">
        <div class="card-img-wrapper">
          <img src="hotel/t3.jpg" alt="Hotels" onerror="this.src='assets/img/default-hotel.png';">
        </div>
        <div class="service-card-body">
          <div style="margin-bottom: 8px;"><span class="badge">Hotel</span></div>
          <h3 class="service-card-title">Hotels & Stays</h3>
          <p class="service-card-desc">Indulge in Unmatched Comfort, Luxury and Premium Service!</p>
          <a href="hotelm.php" class="btn btn-primary" style="margin-top: auto;">Explore Hotels</a>
        </div>
      </div>

      <div class="service-card">
        <div class="card-img-wrapper">
          <img src="hotel/t4.jpg" alt="Hostels" onerror="this.src='assets/img/default-hostel.png';">
        </div>
        <div class="service-card-body">
          <div style="margin-bottom: 8px;"><span class="badge">Hostel</span></div>
          <h3 class="service-card-title">Hostels & PG Stays</h3>
          <p class="service-card-desc">Explore More, Spend Less - Stay Smart, Stay with Us!</p>
          <a href="nashik.php" class="btn btn-primary" style="margin-top: auto;">Explore Hostels</a>
        </div>
      </div>
    </div>


    <hr>

  </section>
  <section id="contact" >
    <h1>Contact Us</h1>
    <form action="index.php" method="POST" class="contact-form">
    <label for="name">Your Name:</label>
    <input type="text" id="name" name="name" placeholder="Enter your name" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" placeholder="Enter your email" required>

    <label for="phone">Phone:</label>
    <input type="number" id="phone" name="phone" placeholder="Enter your phone number" required>

    <label for="message">Message:</label>
    <textarea id="message" name="message" rows="4" placeholder="Enter your message"></textarea>

    <button type="submit">Submit</button>
</form>
  </section>




  <footer class="foot">
    <div class="footer-links">
      <a href="settings.php">About us</a>
      <a href="settings.php">Privacy</a>
      <a href="settings.php">Help & Support</a>
      <a href="settings.php">Display & Accessibility</a>
      <a href="settings.php">Supplier</a>
    </div>
    <div class="social-icons">
      <a href="#" target="_blank"><i class="fa-brands fa-instagram"></i></a>
      <a href="#" target="_blank"><i class="fa-brands fa-github"></i></a>
      <a href="#" target="_blank"><i class="fa-brands fa-facebook"></i></a>
      <a href="#" target="_blank"><i class="fa-brands fa-whatsapp"></i></a>
    </div>
    <h5 style="color:black;">@created by group 6</h5>
  </footer>

  <script>
    const slider = document.querySelector('.slider');
    const slides = document.querySelectorAll('.slide');
    const prevButton = document.querySelector('.prev');
    const nextButton = document.querySelector('.next');

    let currentIndex = 0;

    function updateSlide(index) {
      slider.style.transform = `translateX(-${index * 100}%)`;
      slides.forEach((slide, i) => {
        slide.classList.toggle('active', i === index);
      });
    }

    function nextSlide() {
      currentIndex = (currentIndex + 1) % slides.length;
      updateSlide(currentIndex);
    }

    function prevSlide() {
      currentIndex = (currentIndex - 1 + slides.length) % slides.length;
      updateSlide(currentIndex);
    }

    nextButton.addEventListener('click', nextSlide);
    prevButton.addEventListener('click', prevSlide);

    let autoSlideInterval = setInterval(nextSlide, 5000);

    slider.addEventListener('mouseenter', () => clearInterval(autoSlideInterval));
    slider.addEventListener('mouseleave', () => {
      autoSlideInterval = setInterval(nextSlide, 5000);
    });
  </script>
  <script>
    let nextDom = document.getElementById('next');
    let prevDom = document.getElementById('prev');

    let carouselDom = document.querySelector('.carousel');
    let SliderDom = carouselDom.querySelector('.carousel .list');
    let thumbnailBorderDom = document.querySelector('.carousel .thumbnail');
    let thumbnailItemsDom = thumbnailBorderDom.querySelectorAll('.item');
    let timeDom = document.querySelector('.carousel .time');

    thumbnailBorderDom.appendChild(thumbnailItemsDom[0]);
    let timeRunning = 2000;
    let timeAutoNext = 5000;

    nextDom.onclick = function () {
      showSlider('next');
    }

    prevDom.onclick = function () {
      showSlider('prev');
    }
    let runTimeOut;
    let runNextAuto = setTimeout(() => {
      next.click();
    }, timeAutoNext)
    function showSlider(type) {
      let SliderItemsDom = SliderDom.querySelectorAll('.carousel .list .item');
      let thumbnailItemsDom = document.querySelectorAll('.carousel .thumbnail .item');

      if (type === 'next') {
        SliderDom.appendChild(SliderItemsDom[0]);
        thumbnailBorderDom.appendChild(thumbnailItemsDom[0]);
        carouselDom.classList.add('next');
      } else {
        SliderDom.prepend(SliderItemsDom[SliderItemsDom.length - 1]);
        thumbnailBorderDom.prepend(thumbnailItemsDom[thumbnailItemsDom.length - 1]);
        carouselDom.classList.add('prev');
      }
      clearTimeout(runTimeOut);
      runTimeOut = setTimeout(() => {
        carouselDom.classList.remove('next');
        carouselDom.classList.remove('prev');
      }, timeRunning);

      clearTimeout(runNextAuto);
      runNextAuto = setTimeout(() => {
        next.click();
      }, timeAutoNext)
    }
  </script>
  <script src="js\index.js"></script>
</body>

</html>
<?php 
session_start(); 
?> 
<!DOCTYPE html> 
<html> 
<head> 
 
<title> Swantana </title> 
<meta charset="UTF-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0" > 
<meta name="description" content="Swantana Charitable Trust: Empowering freshers with 
training and placement opportunities in Hyderabad and Bangalore."> 
<meta name="location" content="Hyderabad, Bangalore"> 
<meta name="author" content="008,015"> 
<link rel="stylesheet" href="style.css"> 
<link rel="icon" type="image/x-icon" href="favicon.ico"> 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" 
rel="stylesheet"> 
 
</head> 
 
<body> 
    <header> 
        Swantana Charitable Trust 
         
    </header> 
     <nav> 
        
     <a href="swantana.php">Home</a> 
    <a href="application.php">APPLICATION</a> 
    <a href="contact.php">CONTACT</a> 
    <a href="about.php">ABOUT</a> 
    <?php if(isset($_SESSION['user_id'])): ?> 
        <a href="profile.php">PROFILE</a> 
        <?php if($_SESSION['role'] == 'admin'): ?> 
            <a href="admin.php">ADMIN</a> 
        <?php endif; ?> 
        <a href="logout.php">LOGOUT</a> 
    <?php else: ?> 
        <a href="login.php">LOGIN</a> 
        <a href="register.php">REGISTER</a> 
    <?php endif; ?> 
 
    </nav> 
    <section class="introduction"> 
        <h2 class="h2" align="center"  >Welcome to Swantana Charitable Trust</h2> 
        <div id="swantana prop" class="prop"> 
 
        <p> 
            At <strong>Swantana Charitable Trust</strong>, we believe in empowering 
individuals with the skills and opportunities they need to build a brighter future.  
            Our mission is to bridge the gap between education and employment by providing 
high-quality training programs that prepare freshers for successful careers in the banking 
and financial services sector. 
        </p> 
        <p> 
            Since our inception, we have trained over <strong>250 students</strong>, with an 
impressive <strong>80% placement rate</strong> in top companies like Accenture, Wipro, 
and Google.  
            Our flagship program, the <strong>Edu Bridge Program</strong>, focuses on skill 
development in areas such as financial literacy, customer handling, digital transactions, and 
communication skills. 
        </p> 
        <p> 
            Join us in our journey to transform lives and create a skilled, employable workforce 
for the future.  
            Whether you are a student looking to enhance your skills or an organization 
interested in partnering with us, Swantana Charitable Trust is here to support you every step 
of the way. 
        </p> 
        </section> 
    </div> 
    <div class="container" id="Partners"> 
        <h2>Our Partners</h2> 
         
    </div> 
    <div id="carouselExample" class="carousel slide custom-carousel" data-bs
ride="carousel"> 
 
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel"> 
        <div class="carousel-inner"> 
            <div class="carousel-item active"> 
                <img src="images/Accenture_Logo.jpeg" class="d-block w-100" alt="Accenture"> 
            </div> 
            <div class="carousel-item"> 
                <img src="images/AIG_Hospitals.jpg" class="d-block w-100" alt="AIG Hospitals"> 
            </div> 
            <div class="carousel-item"> 
                <img src="images/Axis_Bank.jpeg"class="d-block w-100" alt="Axis Bank Logo"> 
            </div> 
            <div class="carousel-item"> 
                <img src="images/Cognizant.jpeg" class="d-block w-100" alt="Cognizant"> 
            </div> 
            <div class="carousel-item"> 
                <img src="images/Google.jpeg" class="d-block w-100" alt="Google Logo"> 
            </div> 
            <div class="carousel-item"> 
                <img src="images/HDB_Financial_Services.jpeg" class="d-block w-100" alt="HDB 
Financial Services"> 
            </div> 
            <div class="carousel-item"> 
                <img src="images/AGS_Health.jpeg" class="d-block w-100" alt="AGS Health"> 
            </div> 
            <div class="carousel-item"> 
                <img src="images/Wipro.jpeg" class="d-block w-100" alt="Wipro "> 
            </div> 
        </div> 
     
        <!-- Optional Controls --> 
        <button class="carousel-control-prev" type="button" data-bs
target="#carouselExample" data-bs-slide="prev"> 
            <span class="carousel-control-prev-icon" aria-hidden="true"></span> 
            <span class="visually-hidden">Previous</span> 
        </button> 
        <button class="carousel-control-next" type="button" data-bs
target="#carouselExample" data-bs-slide="next"> 
            <span class="carousel-control-next-icon" aria-hidden="true"></span> 
            <span class="visually-hidden">Next</span> 
        </button> 
    </div> 
    <div class="container" id="contact"> 
        <h2>Our Contact</h2> 
        <p>Email:swantanact@gmail.com</p> 
        <p>Phone: +91 9381185059</p> 
    </div> 
    <footer> 
        &copy; 2025 Swantana Charitable Trust. All rights reserved. 
    </footer> 
 
    <script 
src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> 
    </body> 
</html>
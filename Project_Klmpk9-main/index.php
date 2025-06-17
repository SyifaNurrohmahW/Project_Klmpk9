<?php include 'navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ze Beauty's!</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .section-bg {
            position: relative;
            background-size: cover;
            background-position: center;
            padding: 100px 30px;
            z-index: 1;
        }

        .section-overlay {
            position: relative;
            z-index: 2;
            background-color: rgba(255, 255, 255, 0.85);
            border-radius: 20px;
            padding: 60px 30px;
        }

        .about-img,
        .story-img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 1;
        }

        .category-container {
            margin: 100px auto;
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 30px;
        }

        .category-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .category-item img {
            width: 120px;
            height: 120px;
            border-radius: 60px;
            object-fit: cover;
        }

        .contact-section {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 80px 30px;
            background-color: #fff;
            margin-top: 100px;
        }

        .contact-section h5 {
            font-weight: bold;
        }

        .sosmed a {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            color: #000;
            text-decoration: none;
        }

        .sosmed img {
            height: 30px;
            width: 30px;
            border-radius: 5px;
            margin-right: 10px;
        }
    </style>
</head>
<body>

<!-- About Us Section -->
<section class="section-bg" style="background-image: url('img/skincare1.png');">
    <div class="container section-overlay text-center font-italic text-dark">
        <h1 class="mb-4">About Us</h1>
        <p>We are a digital platform dedicated to helping you discover true beauty and find that spark of confidence you've been looking for. At WE SHINE!, we understand that beauty is about more than just physical appearance, it's about feeling good about yourself, exuding confidence, and finding happiness within yourself.</p>
    </div>
</section>

<!-- Categories -->
<h1 class="text-center font-italic mt-5">All You Need</h1>
<div class="category-container container">
    <div class="category-item">
        <img src="img/skincare2.jpg" alt="Skincare">
        <span>SKINCARE</span>
    </div>
    <div class="category-item">
        <img src="img/makeup.jpg" alt="Makeup">
        <span>MAKE UP</span>
    </div>
    <div class="category-item">
        <img src="img/soap.jpg" alt="Bodycare">
        <span>BODYCARE</span>
    </div>
    <div class="category-item">
        <img src="img/haircare.jpg" alt="Haircare">
        <span>HAIRCARE</span>
    </div>
    <div class="category-item">
        <img src="img/clotch.jpg" alt="Fashion">
        <span>FASHION</span>
    </div>
</div>

<!-- Our Story Section -->
<section class="section-bg" style="background-image: url('img/download (1).png');">
    <div class="container section-overlay text-center font-italic text-dark">
        <h1 class="mb-4">Our Story</h1>
        <p>Starting from simple things in social media comments columns and forums discussing beauty, fashion, problems and skin care, "WE SHINE!" present as a beauty website as a solution for those who are looking for answers to various skin and fashion problems with various reviews from various parties. This website will also help increase awareness of the importance of proper skin care and fashion, so that every user can feel an increase in self-confidence and happiness in their appearance.</p>
    </div>
</section>

<!-- Contact & Social Media -->
<div class="contact-section">
    <div class="contact">
        <h5>CONTACT US</h5>
        <p>Jl. Parang, Parang, Kec. Parang, Kab. Magetan, Jawa Timur 63117</p>
        <p>zezebeauty@gmail.com</p>
        <p>Contact (+62)85655202673</p>
    </div>
    <div class="sosmed">
        <h5>SOCIAL MEDIA</h5>
        <a href="https://www.instagram.com/we_shine.ofc?igsh=YzljYTk1ODg3Zg==">
            <img src="img/instagram.jpg" alt="Instagram">@zezebeauty.ofc
        </a>
        <a href=" https://vt.tiktok.com/ZSkNpgBgj/?page=Mall">
            <img src="img/tiktok.png" alt="Tiktok">@zezebeauty.ofc
        </a>
        <a href="https://www.facebook.com/profile.php?id=61560772763062&mibextid=ZbWKwL">
            <img src="img/facebook.jpg" alt="Facebook">@zezebeauty.ofc
        </a>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

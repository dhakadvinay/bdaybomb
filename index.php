<?php
// Home Page - Photo Memories Portfolio
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photo Memories - Portfolio</title>
    <link rel="stylesheet" href="/myfirstweb/assets/css/style-portfolio.css">
    <!-- GSAP Animation Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
</head>
<body>
    <!-- Hero Banner -->
    <div class="hero-section">
        <div class="hero-background"></div>
        
        <div class="hero-content">
            <h1 class="hero-title">Photo Memories</h1>
            <p class="hero-subtitle">Let's celebrate your beautiful moments</p>
            
            <a href="/myfirstweb/gallery.php" class="hero-button">
                View Memories
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M5 12h14M12 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    </div>

    <!-- Load animations -->
    <script src="/myfirstweb/assets/js/animations.js"></script>
</body>
</html>

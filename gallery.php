<?php
// Gallery Page - Display all photos
session_start();
require_once 'includes/db.php';

// Fetch all photos from database
$query = "SELECT * FROM photos ORDER BY uploaded_at DESC";
$result = $conn->query($query);
$photos = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $photos[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Memories - Photo Gallery</title>
    <link rel="stylesheet" href="/myfirstweb/assets/css/style-portfolio.css">
    <link rel="stylesheet" href="/myfirstweb/assets/css/lightbox-premium.css">
    <!-- GSAP Animation Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
</head>
<body>
    <!-- Navigation -->
    <nav class="gallery-nav">
        <a href="/myfirstweb/index.php" class="nav-back">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
            </svg>
            Back
        </a>
    </nav>

    <!-- Gallery Container -->
    <div class="gallery-container">
        <!-- Gallery Header -->
        <div class="gallery-header">
            <h1>Your Memories</h1>
            <p class="gallery-subtitle">A collection of beautiful moments</p>
        </div>

        <!-- Gallery Grid - Responsive Masonry Layout -->
        <?php if (count($photos) > 0): ?>
            <div class="gallery-grid">
                <?php foreach ($photos as $photo): ?>
                    <div class="gallery-item">
                        <img src="/myfirstweb/uploads/<?php echo htmlspecialchars($photo['filename']); ?>" 
                             alt="Memory photo"
                             loading="lazy"
                             class="gallery-image">
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="empty-gallery">
                <h2>No photos yet</h2>
                <p>Your memories will appear here</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Premium Lightbox Modal -->
    <div class="lightbox">
        <div class="lightbox-backdrop"></div>
        <div class="lightbox-content">
            <!-- Close Button -->
            <button class="lightbox-close" title="Close (ESC)" aria-label="Close modal">
                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>

            <!-- Image Container -->
            <div class="lightbox-image-container">
                <img src="" alt="Full size photo" class="lightbox-image">
            </div>

            <!-- Navigation Buttons -->
            <button class="lightbox-nav-btn lightbox-prev" title="Previous photo (← arrow key)" aria-label="Previous photo">
                <svg viewBox="0 0 24 24" width="32" height="32" fill="currentColor">
                    <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"></path>
                </svg>
            </button>

            <button class="lightbox-nav-btn lightbox-next" title="Next photo (→ arrow key)" aria-label="Next photo">
                <svg viewBox="0 0 24 24" width="32" height="32" fill="currentColor">
                    <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"></path>
                </svg>
            </button>

            <!-- Photo Counter -->
            <div class="lightbox-counter">
                <span class="current">1</span> / <span class="total">1</span>
            </div>
        </div>
    </div>

    <!-- Load animations -->
    <script src="/myfirstweb/assets/js/animations.js"></script>
    <script src="/myfirstweb/assets/js/lightbox-premium.js"></script>
</body>
</html>

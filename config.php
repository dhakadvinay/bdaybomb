<?php
// Configuration file for Birthday Surprise Website

// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'birthday_surprise');

// Site Configuration
define('SITE_URL', 'http://localhost/myfirstweb/');
define('SITE_NAME', 'Birthday Surprise');

// Upload Configuration
define('UPLOAD_DIR', __DIR__ . '/uploads/');
define('UPLOAD_URL', SITE_URL . 'uploads/');
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB
define('ALLOWED_TYPES', ['image/jpeg', 'image/png', 'image/jpg']);

// Session Configuration
define('SESSION_TIMEOUT', 3600); // 1 hour

// Security
define('HASH_ALGORITHM', PASSWORD_DEFAULT);
?>

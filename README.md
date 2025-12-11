# 🎉 Birthday Surprise Website

A beautiful, fully-animated PHP + MySQL birthday surprise website with admin panel for photo management.

## 🚀 Features

### User-Facing Features
- ✨ Animated home page with confetti and floating balloons
- 🎂 Animated birthday cake using Lottie animations
- 📸 Photo memories gallery with lightbox preview
- 🎨 Smooth scroll animations and hover effects
- 📱 Fully responsive design

### Admin Panel Features
- 🔐 Secure login with PHP sessions
- 📤 Upload photos with drag-and-drop support
- 🗑️ Delete photos from gallery
- 👁️ Preview website before publishing

## 📋 Requirements

- XAMPP (or any local server with PHP 7.0+ and MySQL)
- Modern web browser (Chrome, Firefox, Safari, Edge)

## 🔧 Installation & Setup

### Step 1: Create Database

1. Open phpMyAdmin: `http://localhost/phpmyadmin`
2. Create a new database named `birthday_surprise`
3. Import the SQL schema:
   - Copy all SQL from `database_schema.sql`
   - Paste into phpMyAdmin SQL tab
   - Execute

**OR** Run this SQL directly in phpMyAdmin:

```sql
CREATE DATABASE IF NOT EXISTS birthday_surprise;
USE birthday_surprise;

CREATE TABLE IF NOT EXISTS admin_users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS photos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    filename VARCHAR(255) NOT NULL,
    uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO admin_users (username, password) VALUES 
('admin', '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcg7b3XeKeUxWdeS86E36P4/KFm');
```

### Step 2: Verify Folder Structure

Ensure your project has this structure:

```
myfirstweb/
├── index.php
├── gallery.php
├── database_schema.sql
├── README.md
├── admin/
│   ├── login.php
│   ├── dashboard.php
│   ├── upload.php
│   ├── delete.php
│   └── logout.php
├── includes/
│   ├── db.php
│   └── auth.php
├── uploads/          (will be created automatically)
└── assets/
    ├── css/
    │   └── style.css
    └── js/
        └── animations.js
```

### Step 3: Create Uploads Folder

The `/uploads/` folder will be created automatically on first upload. If you want to create it manually:

1. In your `myfirstweb` directory, create a folder named `uploads`
2. Set permissions to `755` (readable and writable)

### Step 4: Access the Website

- **Home Page**: `http://localhost/myfirstweb/`
- **Gallery**: `http://localhost/myfirstweb/gallery.php`
- **Admin Login**: `http://localhost/myfirstweb/admin/login.php`

## 🔐 Default Admin Credentials

```
Username: admin
Password: admin123
```

⚠️ **IMPORTANT**: Change these credentials after first login!

To change password, you can update the database directly:

```sql
UPDATE admin_users SET password = PASSWORD('your_new_password') WHERE username = 'admin';
```

Or use PHP to hash a new password:

```php
<?php
echo password_hash('your_new_password', PASSWORD_DEFAULT);
?>
```

## 📁 File Descriptions

| File | Purpose |
|------|---------|
| `index.php` | Home page with animations |
| `gallery.php` | Photo gallery with lightbox |
| `admin/login.php` | Admin authentication |
| `admin/dashboard.php` | Admin control panel |
| `admin/upload.php` | Photo upload handler |
| `admin/delete.php` | Photo deletion handler |
| `admin/logout.php` | Logout handler |
| `includes/db.php` | Database connection |
| `includes/auth.php` | Authentication functions |
| `assets/css/style.css` | All styling |
| `assets/js/animations.js` | GSAP animations |

## 🎨 Customization

### Change Birthday Name

Edit `index.php` and modify the birthday text:

```html
<h1 class="birthday-text">Happy Birthday [Name]!</h1>
```

### Change Colors

Edit `assets/css/style.css` and modify the gradient colors:

```css
background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
```

### Change Lottie Animation

In `index.php`, replace the Lottie JSON path:

```javascript
path: 'https://lottie.host/YOUR_ANIMATION_ID/cake.json'
```

Find animations at: [Lottie Files](https://lottiefiles.com/)

## 🐛 Troubleshooting

### "Connection failed" error
- Check XAMPP MySQL is running
- Verify database credentials in `includes/db.php`
- Ensure `birthday_surprise` database exists

### Photos not uploading
- Check `/uploads/` folder exists and is writable
- Verify file size is under 5MB
- Ensure file format is JPG, JPEG, or PNG

### Admin login not working
- Clear browser cookies
- Check database has `admin_users` table
- Verify password hash in database

### Animations not working
- Check GSAP CDN is loaded (internet connection required)
- Open browser console (F12) for errors
- Verify `assets/js/animations.js` is loaded

## 📚 Technologies Used

- **Frontend**: HTML5, CSS3, JavaScript
- **Backend**: PHP 7.0+
- **Database**: MySQL
- **Animations**: GSAP, Lottie
- **Icons**: Unicode Emojis

## 🔒 Security Features

- ✅ Password hashing with `password_hash()`
- ✅ Prepared statements to prevent SQL injection
- ✅ Session-based authentication
- ✅ File type validation
- ✅ File size limits
- ✅ Unique filename generation

## 📝 License

Free to use and modify for personal projects.

## 🎉 Enjoy!

Have fun celebrating with this beautiful birthday surprise website!

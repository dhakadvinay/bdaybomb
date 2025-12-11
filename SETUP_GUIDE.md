# 🎂 Birthday Surprise Website - Complete Setup Guide

## Quick Start (5 Minutes)

### 1. Create Database

Open **phpMyAdmin** at `http://localhost/phpmyadmin` and run this SQL:

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

### 2. Access the Website

| Page | URL |
|------|-----|
| Home | `http://localhost/myfirstweb/` |
| Gallery | `http://localhost/myfirstweb/gallery.php` |
| Admin Login | `http://localhost/myfirstweb/admin/login.php` |

### 3. Login to Admin Panel

```
Username: admin
Password: admin123
```

### 4. Upload Photos

- Go to Admin Dashboard
- Click "Upload New Photo"
- Select JPG/PNG images (max 5MB)
- Photos appear in gallery automatically

---

## Detailed Setup Instructions

### Prerequisites
- XAMPP installed and running
- MySQL service enabled
- PHP 7.0 or higher

### Step 1: Verify Project Location

Ensure files are in: `C:\xampp\htdocs\myfirstweb\`

```
myfirstweb/
├── index.php
├── gallery.php
├── admin/
├── includes/
├── assets/
├── uploads/
└── database_schema.sql
```

### Step 2: Create Database

**Method A: Using phpMyAdmin (Easiest)**

1. Open `http://localhost/phpmyadmin`
2. Click "New" in left sidebar
3. Enter database name: `birthday_surprise`
4. Click "Create"
5. Select the new database
6. Go to "SQL" tab
7. Copy-paste the SQL from `database_schema.sql`
8. Click "Go"

**Method B: Using MySQL Command Line**

```bash
mysql -u root -p < database_schema.sql
```

### Step 3: Verify Database Connection

Create a test file `test_db.php` in `myfirstweb/`:

```php
<?php
require_once 'includes/db.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "✅ Database connection successful!";

// Check tables
$tables = $conn->query("SHOW TABLES");
echo "<br>Tables found: " . $tables->num_rows;
?>
```

Visit `http://localhost/myfirstweb/test_db.php`

### Step 4: Set Folder Permissions

The `/uploads/` folder will be created automatically. If you want to create it manually:

```bash
mkdir uploads
chmod 755 uploads
```

### Step 5: Test the Website

1. **Home Page**: `http://localhost/myfirstweb/`
   - Should show animated birthday cake, confetti, balloons
   - Button to view memories

2. **Gallery**: `http://localhost/myfirstweb/gallery.php`
   - Should show "No photos yet" message initially

3. **Admin Login**: `http://localhost/myfirstweb/admin/login.php`
   - Login with: `admin` / `admin123`
   - Should redirect to dashboard

4. **Admin Dashboard**: Upload a test photo
   - Photo should appear in gallery

---

## Customization Guide

### Change Birthday Name

Edit `index.php`, line 35:

```html
<h1 class="birthday-text">Happy Birthday [Your Name]!</h1>
```

### Change Colors

Edit `assets/css/style.css`, line 8:

```css
background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
```

Color palette suggestions:
- **Pink/Red**: `#ff6b6b` to `#f5576c`
- **Blue/Purple**: `#667eea` to `#764ba2`
- **Green/Teal**: `#4ecdc4` to `#44a08d`
- **Orange/Yellow**: `#f5af19` to `#f12711`

### Change Admin Credentials

**Option 1: Update via phpMyAdmin**

1. Go to `birthday_surprise` database
2. Select `admin_users` table
3. Click "Edit" on the admin row
4. Update username/password
5. For password, use this PHP to generate hash:

```php
<?php
echo password_hash('your_new_password', PASSWORD_DEFAULT);
?>
```

Then paste the hash in the password field.

**Option 2: Update via SQL**

```sql
UPDATE admin_users SET username = 'newadmin', password = '$2y$10$...' WHERE id = 1;
```

### Change Lottie Animation

In `index.php`, line 56:

```javascript
path: 'https://lottie.host/YOUR_ANIMATION_ID/cake.json'
```

Find animations at: https://lottiefiles.com/

### Add Background Music

1. Place MP3 file in `/assets/music/`
2. Edit `index.php` and add:

```html
<audio id="bgMusic" loop>
    <source src="/myfirstweb/assets/music/birthday.mp3" type="audio/mpeg">
</audio>

<button id="musicToggle" style="position: fixed; bottom: 20px; right: 20px; z-index: 100;">
    🔊 Music
</button>

<script>
    const audio = document.getElementById('bgMusic');
    const btn = document.getElementById('musicToggle');
    
    btn.addEventListener('click', () => {
        if (audio.paused) {
            audio.play();
            btn.textContent = '🔇 Music';
        } else {
            audio.pause();
            btn.textContent = '🔊 Music';
        }
    });
</script>
```

---

## Troubleshooting

### ❌ "Connection failed" Error

**Solution:**
1. Verify XAMPP MySQL is running (green indicator)
2. Check database credentials in `includes/db.php`
3. Ensure `birthday_surprise` database exists
4. Run test_db.php to verify connection

### ❌ Photos Not Uploading

**Solution:**
1. Check `/uploads/` folder exists
2. Verify folder permissions (755)
3. Check file size (max 5MB)
4. Verify file format (JPG, JPEG, PNG only)
5. Check PHP error logs in XAMPP

### ❌ Admin Login Not Working

**Solution:**
1. Clear browser cookies (Ctrl+Shift+Delete)
2. Verify `admin_users` table has data
3. Check password hash is correct
4. Try default credentials: `admin` / `admin123`

### ❌ Animations Not Working

**Solution:**
1. Check internet connection (GSAP/Lottie from CDN)
2. Open browser console (F12) for errors
3. Verify `assets/js/animations.js` is loaded
4. Check GSAP CDN link is valid

### ❌ 404 Errors

**Solution:**
1. Verify all files are in correct folders
2. Check file paths in HTML (should start with `/myfirstweb/`)
3. Verify XAMPP Apache is running
4. Clear browser cache (Ctrl+F5)

---

## File Structure Reference

```
myfirstweb/
│
├── 📄 index.php                    # Home page
├── 📄 gallery.php                  # Photo gallery
├── 📄 config.php                   # Configuration
├── 📄 database_schema.sql          # Database setup
├── 📄 README.md                    # Documentation
├── 📄 SETUP_GUIDE.md              # This file
│
├── 📁 admin/
│   ├── login.php                   # Admin login
│   ├── dashboard.php               # Admin panel
│   ├── upload.php                  # Upload handler
│   ├── delete.php                  # Delete handler
│   └── logout.php                  # Logout handler
│
├── 📁 includes/
│   ├── db.php                      # Database connection
│   └── auth.php                    # Authentication functions
│
├── 📁 assets/
│   ├── css/
│   │   └── style.css               # All styling
│   └── js/
│       ├── animations.js           # GSAP animations
│       └── lottie-setup.js         # Lottie setup
│
└── 📁 uploads/                     # User uploaded photos
```

---

## Security Best Practices

✅ **Already Implemented:**
- Password hashing with `password_hash()`
- Prepared statements (prevent SQL injection)
- Session-based authentication
- File type validation
- File size limits
- Unique filename generation

⚠️ **Additional Recommendations:**
- Change default admin password immediately
- Use HTTPS in production
- Add CSRF tokens for forms
- Implement rate limiting for login
- Regular database backups
- Keep PHP and MySQL updated

---

## Performance Tips

1. **Optimize Images**: Compress photos before uploading
2. **Enable Caching**: Add cache headers in `.htaccess`
3. **Lazy Loading**: Images use `loading="lazy"`
4. **CDN**: GSAP and Lottie loaded from CDN
5. **Minify CSS/JS**: For production deployment

---

## Deployment to Live Server

### Using Vercel (Recommended for Next.js)
Not applicable - this is PHP

### Using Heroku
1. Add `Procfile` with PHP buildpack
2. Push to Heroku Git
3. Set environment variables

### Using Shared Hosting
1. Upload files via FTP
2. Create database on hosting panel
3. Update `includes/db.php` with hosting credentials
4. Set file permissions to 755

---

## Support & Help

If you encounter issues:

1. Check error logs in XAMPP
2. Open browser console (F12)
3. Review this guide's troubleshooting section
4. Check file permissions
5. Verify database connection

---

## License

Free to use and modify for personal projects.

**Happy Birthday! 🎉**

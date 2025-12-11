# 🔧 Birthday Surprise Website - Troubleshooting Guide

## Common Issues and Solutions

### 1. Database Connection Errors

#### Error: "Connection failed: Unknown database 'birthday_surprise'"

**Cause**: Database doesn't exist or wrong database name

**Solution**:
1. Open phpMyAdmin: `http://localhost/phpmyadmin`
2. Click "New" in left sidebar
3. Enter database name: `birthday_surprise`
4. Click "Create"
5. Import SQL schema from `database_schema.sql`

#### Error: "Access denied for user 'root'@'localhost'"

**Cause**: Wrong database credentials

**Solution**:
1. Check `includes/db.php` has correct credentials
2. Default XAMPP credentials:
   - Host: `localhost`
   - User: `root`
   - Password: `` (empty)
   - Database: `birthday_surprise`
3. Verify MySQL is running in XAMPP Control Panel

#### Error: "Connection timed out"

**Cause**: MySQL service not running

**Solution**:
1. Open XAMPP Control Panel
2. Click "Start" next to MySQL
3. Wait for green indicator
4. Refresh the page

---

### 2. File Upload Issues

#### Error: "Error moving uploaded file"

**Cause**: `/uploads/` folder doesn't exist or isn't writable

**Solution**:
1. Create `/uploads/` folder in `myfirstweb/` directory
2. Right-click folder > Properties > Security
3. Select "Users" > Edit > Check "Full Control"
4. Click OK

#### Error: "File size exceeds 5MB limit"

**Cause**: Uploaded file is too large

**Solution**:
1. Compress the image before uploading
2. Use online image compressor
3. Recommended size: 500KB - 2MB per image
4. Tools: TinyPNG, ImageOptim, or similar

#### Error: "Invalid file type. Only JPG, JPEG, and PNG are allowed"

**Cause**: Wrong file format

**Solution**:
1. Convert image to JPG or PNG
2. Use online converter or image editor
3. Check file extension is correct
4. Don't rename files without converting format

#### Photos not appearing in gallery

**Cause**: Database not updated or file not saved

**Solution**:
1. Check `/uploads/` folder for files
2. Check `photos` table in database
3. Verify file permissions (755)
4. Check browser cache (Ctrl+F5)
5. Verify database connection

---

### 3. Admin Login Issues

#### Error: "Invalid username or password"

**Cause**: Wrong credentials or database issue

**Solution**:
1. Try default credentials: `admin` / `admin123`
2. Check `admin_users` table exists in database
3. Verify password hash is correct
4. Clear browser cookies (Ctrl+Shift+Delete)
5. Try different browser

#### Can't access admin dashboard after login

**Cause**: Session not created or lost

**Solution**:
1. Check PHP sessions are enabled
2. Verify `includes/auth.php` is loaded
3. Check browser cookies are enabled
4. Clear browser cache and cookies
5. Restart browser

#### Forgot admin password

**Cause**: Lost access to admin account

**Solution**:
1. Open phpMyAdmin
2. Go to `birthday_surprise` > `admin_users` table
3. Click "Edit" on admin row
4. Generate new password hash:
   ```php
   <?php echo password_hash('newpassword', PASSWORD_DEFAULT); ?>
   ```
5. Paste hash in password field
6. Click "Go"

---

### 4. Animation Issues

#### Animations not working

**Cause**: GSAP or Lottie not loading from CDN

**Solution**:
1. Check internet connection
2. Open browser console (F12)
3. Check for CDN errors
4. Verify GSAP CDN link is valid
5. Try different browser
6. Clear browser cache (Ctrl+F5)

#### Confetti not appearing

**Cause**: Canvas API not supported or JavaScript error

**Solution**:
1. Check browser supports HTML5 Canvas
2. Open console (F12) for errors
3. Verify `assets/js/animations.js` is loaded
4. Check JavaScript is enabled
5. Try different browser

#### Lightbox not working

**Cause**: JavaScript error or missing elements

**Solution**:
1. Open console (F12) for errors
2. Check `.lightbox` element exists in HTML
3. Verify `assets/js/lightbox.js` is loaded
4. Check CSS is properly linked
5. Try clicking different photos

---

### 5. Page Loading Issues

#### 404 Not Found errors

**Cause**: Wrong file paths or missing files

**Solution**:
1. Verify all files are in correct folders
2. Check file paths start with `/myfirstweb/`
3. Verify files exist in file system
4. Check spelling of filenames
5. Restart Apache in XAMPP

#### Blank white page

**Cause**: PHP error or missing include

**Solution**:
1. Open console (F12) for errors
2. Check PHP error logs in XAMPP
3. Verify all required files exist
4. Check `includes/db.php` loads correctly
5. Try accessing `test_setup.php`

#### Styles not loading (unstyled page)

**Cause**: CSS file path incorrect

**Solution**:
1. Check `assets/css/style.css` exists
2. Verify CSS link in HTML is correct
3. Check file path starts with `/myfirstweb/`
4. Clear browser cache (Ctrl+F5)
5. Check browser console for 404 errors

#### Images not loading

**Cause**: Wrong image path or missing files

**Solution**:
1. Check uploaded files in `/uploads/` folder
2. Verify database has correct filenames
3. Check image file permissions
4. Verify image format is supported
5. Try re-uploading image

---

### 6. Performance Issues

#### Website loading slowly

**Cause**: Large images or slow server

**Solution**:
1. Compress images before uploading
2. Reduce number of photos
3. Clear browser cache
4. Check internet connection
5. Restart XAMPP services

#### Gallery takes long to load

**Cause**: Too many photos or large file sizes

**Solution**:
1. Optimize images (compress)
2. Delete unused photos
3. Use image lazy loading
4. Reduce image dimensions
5. Check database query performance

---

### 7. Browser Compatibility Issues

#### Website looks different in different browsers

**Cause**: Browser compatibility issues

**Solution**:
1. Use modern browser (Chrome, Firefox, Safari, Edge)
2. Update browser to latest version
3. Check CSS compatibility
4. Test in multiple browsers
5. Report issues with specific browser

#### Mobile site looks broken

**Cause**: Responsive design not working

**Solution**:
1. Check viewport meta tag in HTML
2. Verify CSS media queries
3. Test with actual mobile device
4. Check browser zoom is 100%
5. Try different mobile browser

---

### 8. Security Issues

#### Admin panel accessible without login

**Cause**: Session not working or auth check missing

**Solution**:
1. Verify `includes/auth.php` is included
2. Check `requireLogin()` is called
3. Verify sessions are enabled in PHP
4. Check cookies are enabled in browser
5. Clear browser cookies and re-login

#### Files accessible directly

**Cause**: Directory listing enabled or no protection

**Solution**:
1. Add `.htaccess` file to protect directories
2. Move sensitive files outside web root
3. Add authentication checks
4. Disable directory listing

---

### 9. Database Issues

#### "Table 'birthday_surprise.photos' doesn't exist"

**Cause**: Database tables not created

**Solution**:
1. Open phpMyAdmin
2. Select `birthday_surprise` database
3. Go to SQL tab
4. Copy-paste SQL from `database_schema.sql`
5. Click "Go"

#### Photos not showing in admin dashboard

**Cause**: Database query error or no photos

**Solution**:
1. Check `photos` table has data
2. Verify database connection works
3. Check SQL query in `admin/dashboard.php`
4. Try uploading a new photo
5. Check database permissions

#### Can't delete photos

**Cause**: File or database deletion error

**Solution**:
1. Check `/uploads/` folder permissions
2. Verify file exists before deleting
3. Check database permissions
4. Try deleting from phpMyAdmin
5. Check error logs

---

### 10. Deployment Issues

#### Website works locally but not on server

**Cause**: Server configuration differences

**Solution**:
1. Check PHP version on server (7.0+)
2. Verify MySQL is installed
3. Update database credentials for server
4. Check file permissions on server
5. Verify uploads folder exists and is writable
6. Check server error logs

#### Database connection fails on server

**Cause**: Wrong server credentials

**Solution**:
1. Get correct database credentials from hosting
2. Update `includes/db.php` with server credentials
3. Test connection with `test_setup.php`
4. Check database exists on server
5. Verify user has database access

---

## Diagnostic Tools

### Test Setup Page
Visit: `http://localhost/myfirstweb/test_setup.php`

This page checks:
- ✓ Database connection
- ✓ Database tables
- ✓ Uploads folder
- ✓ Required files

### Browser Console
Press `F12` to open developer tools

Check for:
- JavaScript errors
- Network errors (404, 500)
- Console warnings
- CSS issues

### PHP Error Logs
Check XAMPP logs:
- `C:\xampp\apache\logs\error.log`
- `C:\xampp\mysql\data\*.err`

### Database Verification
In phpMyAdmin:
1. Check database exists
2. Check tables exist
3. Check data in tables
4. Run test queries

---

## Getting Help

If you can't solve the issue:

1. **Check this guide** for your specific error
2. **Visit test_setup.php** to diagnose issues
3. **Check browser console** (F12) for errors
4. **Review XAMPP logs** for server errors
5. **Check database** in phpMyAdmin
6. **Verify file permissions** and paths
7. **Clear cache** and try again
8. **Restart XAMPP** services

---

## Quick Fixes Checklist

- [ ] XAMPP MySQL is running
- [ ] Database `birthday_surprise` exists
- [ ] Database tables are created
- [ ] Admin user exists in database
- [ ] `/uploads/` folder exists and is writable
- [ ] All PHP files are in correct locations
- [ ] CSS and JS files are linked correctly
- [ ] Browser cache is cleared (Ctrl+F5)
- [ ] Cookies are enabled in browser
- [ ] Internet connection is working

---

## Still Having Issues?

1. Run `test_setup.php` to diagnose
2. Check all items in the checklist above
3. Review relevant section in this guide
4. Check browser console for errors
5. Verify database in phpMyAdmin
6. Check XAMPP error logs
7. Try different browser
8. Restart XAMPP and browser
9. Reinstall or reset the project

**Happy troubleshooting! 🔧**

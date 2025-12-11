-- Fix Admin Password - Run this in phpMyAdmin
-- This updates the admin user with the correct password hash for 'admin123'

USE birthday_surprise;

-- Delete existing admin user if it exists
DELETE FROM admin_users WHERE username = 'admin';

-- Insert admin user with correct password hash
INSERT INTO admin_users (username, password) VALUES 
('admin', '$2y$10$slYQmyNdGzin7olVZeVf.OPST9/PgBkqquzi.Ss7KIUgO2t0jKMm2');

-- Verify the insert
SELECT * FROM admin_users WHERE username = 'admin';

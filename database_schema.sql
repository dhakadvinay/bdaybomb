-- Birthday Surprise Website Database Schema
-- Create database
CREATE DATABASE IF NOT EXISTS birthday_surprise;
USE birthday_surprise;

-- Admin users table
CREATE TABLE IF NOT EXISTS admin_users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Photos table
CREATE TABLE IF NOT EXISTS photos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    filename VARCHAR(255) NOT NULL,
    uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert default admin user (username: admin, password: admin123)
-- Password hash for 'admin123': $2y$10$slYQmyNdGzin7olVZeVf.OPST9/PgBkqquzi.Ss7KIUgO2t0jKMm2

INSERT INTO admin_users (username, password) VALUES ('admin', '$2y$10$slYQmyNdGzin7olVZeVf.OPST9/PgBkqquzi.Ss7KIUgO2t0jKMm2');

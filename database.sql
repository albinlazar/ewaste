-- Database: ewaste_db

CREATE DATABASE IF NOT EXISTS ewaste_db;
USE ewaste_db;

-- Users Table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    address TEXT,
    credits DECIMAL(10, 2) DEFAULT 0.00,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Admins Table
CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Requests Table
CREATE TABLE IF NOT EXISTS requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    waste_type VARCHAR(100) NOT NULL,
    weight_kg DECIMAL(10, 2) NOT NULL,
    description TEXT,
    pickup_address TEXT NOT NULL,
    status ENUM('Pending', 'Approved', 'Rejected', 'Picked Up', 'Completed') DEFAULT 'Pending',
    scheduled_date DATETIME,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Insert a default admin (Password: admin123)
-- Note: 'admin123' hash to be generated via PHP in a real scenario, but for setup we'll use a placeholder or known hash if needed.
-- For now, letting the user register or handling seed data later.

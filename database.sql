-- Database Schema for Public Grievance Management System

CREATE DATABASE IF NOT EXISTS grievance_db;
USE grievance_db;

-- Users Table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    mobile VARCHAR(20) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    nid_number VARCHAR(50),
    role ENUM('citizen', 'admin') DEFAULT 'citizen',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Grievances Table
CREATE TABLE IF NOT EXISTS grievances (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    category VARCHAR(50) NOT NULL,
    description TEXT NOT NULL,
    location_province VARCHAR(100),
    location_district VARCHAR(100),
    location_municipality VARCHAR(100),
    attachment VARCHAR(255),
    status ENUM('Pending', 'In Progress', 'Resolved', 'Rejected') DEFAULT 'Pending',
    reference_id VARCHAR(50) UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Insert a default admin user (Password: admin123)
-- Note: In a real app, passwords must be hashed. This is for demonstration with the PHP script handling hashing.
-- INSERT INTO users (full_name, email, mobile, password, role) VALUES ('System Admin', 'admin@gov.np', '9800000000', '$2y$10$YourHashedPasswordHere', 'admin');

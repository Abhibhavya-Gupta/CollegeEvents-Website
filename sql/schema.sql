CREATE DATABASE IF NOT EXISTS college_events;
USE college_events;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone VARCHAR(20) DEFAULT NULL,
    bio TEXT DEFAULT NULL,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('user','admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO users (full_name, email, phone, password_hash, role)
VALUES (
    'Admin User',
    'admin@collegeevents.com',
    '9999999999',
    '$2y$10$7QbZfY4gI.2m8eohC0bMFe5O9nYjR2VqSQK3U1uX5I8M0i7Wz8gRO',
    'admin'
) ON DUPLICATE KEY UPDATE email = email;

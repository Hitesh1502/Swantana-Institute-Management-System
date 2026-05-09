CREATE DATABASE IF NOT EXISTS swantana
CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci;

USE swantana;

-- Applications Table
CREATE TABLE applications (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    father_name VARCHAR(100) NOT NULL,
    father_occupation VARCHAR(100),
    father_income VARCHAR(50),
    mother_name VARCHAR(100),
    mother_occupation VARCHAR(100),
    mother_income VARCHAR(50),
    gender VARCHAR(10),
    dob DATE,
    marital_status VARCHAR(20),
    caste_category VARCHAR(20),
    aadhar_number VARCHAR(20),
    address TEXT,
    district VARCHAR(100),
    state VARCHAR(100),
    landmark VARCHAR(100),
    contact_no VARCHAR(15),
    alternate_no VARCHAR(15),
    pincode VARCHAR(10),
    email VARCHAR(100),
    education_level VARCHAR(50),
    other_education VARCHAR(100),
    govt_document VARCHAR(100),
    bank_account_no VARCHAR(20),
    bank_name VARCHAR(100),
    ifsc_code VARCHAR(20)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Contacts Table
CREATE TABLE contacts (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100),
    email VARCHAR(100),
    subject VARCHAR(255),
    message TEXT,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Users Table
CREATE TABLE users (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    role ENUM('user', 'admin') NOT NULL DEFAULT 'user',

    UNIQUE KEY unique_username (username),
    UNIQUE KEY unique_email (email)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Assign Admin Roles
UPDATE users
SET role = 'admin'
WHERE username IN ('K.Vamsi Phanindra', 'G.Hitesh');

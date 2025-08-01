CREATE DATABASE medvision;
USE medvision;

CREATE TABLE patients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50),
    middle_name VARCHAR(50),
    last_name VARCHAR(50),
    dob DATE,
    contact VARCHAR(15) UNIQUE,
    email VARCHAR(100) UNIQUE,
    address TEXT,
    aadhar_number VARCHAR(12) UNIQUE,
    password_hash VARCHAR(255),
    blood_report VARCHAR(255),
    urine_report VARCHAR(255),
    ecg_report VARCHAR(255),
    xray_report VARCHAR(255),
    vaccination_record VARCHAR(255),
    previous_surgery VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE doctors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50),
    middle_name VARCHAR(50),
    last_name VARCHAR(50),
    dob DATE,
    contact VARCHAR(15) UNIQUE,
    email VARCHAR(100) UNIQUE,
    address TEXT,
    aadhar_number VARCHAR(12) UNIQUE,
    degree_certificate VARCHAR(255),
    password_hash VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

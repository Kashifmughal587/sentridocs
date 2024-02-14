CREATE TABLE IF NOT EXISTS mortgage_leads (
        id INT AUTO_INCREMENT PRIMARY KEY,
        property_type VARCHAR(255),
        loan_type VARCHAR(255),
        mortgage_goal VARCHAR(255),
        value_property DECIMAL(10, 2),
        loan_balance DECIMAL(10, 2),
        current_interest_rate DECIMAL(4, 3),
        property_ownership VARCHAR(255),
        property_use VARCHAR(255),
        military_service BOOLEAN,
        bank_customer VARCHAR(255),
        employment_status VARCHAR(255),
        household_income VARCHAR(255),
        bankruptcy_foreclosure BOOLEAN,
        cash_out_amount DECIMAL(10, 2),
        credit_score VARCHAR(255),
        street_address VARCHAR(255),
        unit VARCHAR(255),
        zip_code VARCHAR(10),
        full_name VARCHAR(30),
        email_address VARCHAR(255),
        phone_number VARCHAR(15),
        lead_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );

CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);


CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    firstname VARCHAR(50),
    lastname VARCHAR(50),
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    contact VARCHAR(20),
    status ENUM('active', 'inactive') DEFAULT 'inactive',
    nmls_number VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE companies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    user_nmls VARCHAR(20), 
    company_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    company_nmls VARCHAR(20),
    company_description TEXT,
    company_address VARCHAR(255),
    company_contact VARCHAR(20),
    status ENUM('active', 'inactive') DEFAULT 'inactive',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE licence_keys (
    id INT AUTO_INCREMENT PRIMARY KEY,
    key_code VARCHAR(50) NOT NULL,
    user_id INT NOT NULL,
    company_id INT NOT NULL,
    purchase_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    expiry_date DATE,
    status ENUM('active', 'inactive') DEFAULT 'inactive',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
);



CREATE TABLE activity_log (
    log_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    activity_type VARCHAR(50) NOT NULL,
    activity_description TEXT,
    activity_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ip_address VARCHAR(45),
    device_info VARCHAR(255),
);

$user_id = 123; // Assuming the ID of the user performing the activity
$activity_type = 'login';
$activity_description = 'User logged in successfully.';
$ip_address = $_SERVER['REMOTE_ADDR']; // Capture the user's IP address
$device_info = $_SERVER['HTTP_USER_AGENT']; // Capture the user's device information

log_activity($user_id, $activity_type, $activity_description, $ip_address, $device_info);
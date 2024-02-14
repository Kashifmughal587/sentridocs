<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lead_generation_form";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$smtpHost = 'sandbox.smtp.mailtrap.io';
$smtpAuth = true;
$smtpUsername = 'aeefe4637af119';
$smtpPassword = '288c6aa0da0266';
$smtpSecure = 'tls';
$smtpPort = 2525;

function log_activity($user_id, $activity_type, $activity_description, $ip_address, $device_info) {
    global $conn;

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("CALL log_activity(?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $user_id, $activity_type, $activity_description, $ip_address, $device_info);

    $stmt->execute();

    $stmt->close();
}

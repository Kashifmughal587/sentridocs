<?php

session_start();

require('../assets/db/db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_username'] = $username;
            header('Location: dashboard.php');
            exit();
        } else {
            echo "Invalid password";
        }
    } else {
        echo "Invalid username";
    }
}

$conn->close();
?>

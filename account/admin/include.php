<?php

    require('../../assets/db/db_connection.php');

    session_start();

    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 86400)) {
        session_destroy();
        echo '<script>window.location.href = "login.php";</script>';
        exit();
    }

    if (!isset($_SESSION['admin_id'])) {
        echo '<script>window.location.href = "login.php";</script>';
        exit();
    }

    // $_SESSION['last_activity'] = time();
    
    include 'header.php';
    include 'sidebar.php';

?>
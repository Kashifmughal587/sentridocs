<?php
    require('../../assets/db/db_connection.php');

    session_start();

    if (!isset($_SESSION['admin_id'])) {
        echo '<script>window.location.href = "login.php";</script>';
        exit();
    }

    if(isset($_GET['id'])) {
        $company_id = $_GET['id'];
        $action = $_GET['status'];
    
        if ($action === 'Active') {
            $sql = "UPDATE companies SET status = 'inactive' WHERE id = ?";
        } elseif ($action === 'Inactive') {
            $sql = "UPDATE companies SET status = 'active' WHERE id = ?";
        }
    
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $company_id);
        $stmt->execute();
        $stmt->close();
    
        echo '<script>window.location.href = "company.php?id='.$company_id.'";</script>';
        exit();
    }

    $conn->close();
?>  
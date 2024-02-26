<?php

    include 'include.php';

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
        $_SESSION['last_activity'] = time();
        // Activity Log
        $admin_id = $_SESSION['admin_id'];
        $activity_type = 'COMPANY';
        if ($action === 'Active') {
            $activity_description = 'Company status with ID '.$company_id.' changed to inactive';
        } elseif ($action === 'Inactive') {
            $activity_description = 'Company status with ID '.$company_id.' changed to active';
        }
        $ip_address = $_SERVER['REMOTE_ADDR'];
        $device_info = $_SERVER['HTTP_USER_AGENT'];
        log_activity($admin_id, $activity_type, $activity_description, $ip_address, $device_info);
        // Activity Log
    
        echo '<script>window.location.href = "company.php?id='.$company_id.'";</script>';
        exit();
    }

    $conn->close();
?>  
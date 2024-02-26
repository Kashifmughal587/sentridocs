<?php
    include 'include.php';

    $user_id = $_SESSION['user_id'];
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST['action'], $_POST['company_id']) && $_POST['action'] == 'generateLicense') {
            $company_id = $_POST['company_id'];
            $sql = "SELECT * FROM license_keys WHERE user_id = '$user_id' AND company_id = '$company_id'";
            $result = $conn->query($sql);
            $license_details = $result->fetch_assoc();
            if($license_details > 0) {
                echo '<script>window.location.href = "company.php";</script>';
                exit();
            }else{
                $purchase_date = date('Y-m-d H:i:s');
                $data = array(
                    'user_id' => $user_id,
                    'company_id' => $company_id,
                    'purchase_date' => $purchase_date,
                    'expiry_date' => ''
                );                
                $data_string = serialize($data);
                $binary_key = openssl_random_pseudo_bytes(32);
                $encryption_key = base64_encode($binary_key);

                $encrypted_data = openssl_encrypt($data_string, 'AES-256-CBC', $encryption_key, 0, $encryption_key);

                // $decrypted_data_string = openssl_decrypt($encrypted_data, 'AES-256-CBC', $encryption_key, 0, $encryption_key);
                // $decrypted_data = unserialize($decrypted_data_string);
                // print_r($decrypted_data);

                $insert_sql = "INSERT INTO license_keys (key_code, encryption_key, user_id, company_id, purchase_date, expiry_date) VALUES ('$encrypted_data', '$encryption_key', '$user_id', '$company_id', '$purchase_date', '')";
                if ($conn->query($insert_sql) === TRUE) {
                    $_SESSION['last_activity'] = time();
                    echo '<script>alert("Key generated successfully!");</script>';
                    echo '<script>window.location.href = "company.php";</script>';
                    // Activity Log
                    $activity_type = 'LICENSE';
                    $activity_description = 'License keys for company ID '.$company_id.' created by user with ID '. $user_id. '.';
                    $ip_address = $_SERVER['REMOTE_ADDR'];
                    $device_info = $_SERVER['HTTP_USER_AGENT'];
                    log_activity($user_id, $activity_type, $activity_description, $ip_address, $device_info);
                    // Activity Log
                    exit();
                } else {
                    echo '<script>alert("Error: Unable to generate license key.");</script>';
                }
            }
        }
    }
    
?>
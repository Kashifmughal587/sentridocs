<?php

require('../assets/db/db_connection.php');

$json_data = file_get_contents('php://input');

if (!empty($json_data)) {
    $data = json_decode($json_data, true);

    if (isset($data['license_key'], $data['secret_key'])) {
        $license_key = $data['license_key'];
        $secret_key = $data['secret_key'];

        if (validateLicense($license_key, $secret_key)) {
            $response = [
                'status' => 'success', 
                'message' => 'License key and secret key are valid.'
            ];
            http_response_code(200); // OK
        } else {
            $response = [
                'status' => 'error', 
                'message' => 'Invalid license key or secret key.'
            ];
            http_response_code(400); // Bad Request
        }
    } else {
        $response = [
            'status' => 'error',
            'message' => 'License key or secret key not provided.'
        ];
        http_response_code(400); // Bad Request
    }
} else {
    $response = [
        'status' => 'error', 
        'message' => 'No data received.'
    ];
    http_response_code(400); // Bad Request
}

header('Content-Type: application/json');
echo json_encode($response);

function validateLicense($license_key, $secret_key) {
    global $conn;

    $query = "SELECT * FROM license_keys WHERE key_code = '$license_key' AND encryption_key = '$secret_key' AND status = 'active'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $license_details = $result->fetch_assoc();
        $count = $license_details["used_count"];
        $count = $count + 1;
        $id = $license_details['id'];
        $query = "UPDATE license_keys SET used_count = '$count' WHERE id = '$id'";
        $result = $conn->query($query);
        return true;
    } else {
        return false;
    }
}

?>

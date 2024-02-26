<?php
    include 'include.php';

    $user_id = $_SESSION['user_id'];

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST['companyNMLS'], $_POST['companyName'], $_POST['email'], $_POST['contact'], $_POST['description'])) {
            $company_id = $conn->real_escape_string($_POST['id']);
            $companyNMLS = $conn->real_escape_string($_POST['companyNMLS']);
            $companyName = $conn->real_escape_string($_POST['companyName']);
            $email = $conn->real_escape_string($_POST['email']);
            $contact = $conn->real_escape_string($_POST['contact']);
            $address = $conn->real_escape_string($_POST['address']);
            $description = $conn->real_escape_string($_POST['description']);
            
            if(isset($_POST['action']) && $_POST['action'] == 'update'){
                $query = "SELECT COUNT(*) AS nmls_count FROM companies WHERE company_nmls = '$companyNMLS' AND id != '$company_id'";
                $result = $conn->query($query);
                $row = $result->fetch_assoc();

                if($row['nmls_count'] == 0) {
                    $updateQuery = "UPDATE companies SET company_nmls = '$companyNMLS', company_name = '$companyName', company_email = '$email', company_contact = '$contact', company_address = '$address', company_description = '$description' WHERE id = '$company_id'";
                    
                    if ($conn->query($updateQuery) === TRUE) {
                        $_SESSION['last_activity'] = time();
                        // Activity Log
                        $activity_type = 'COMPANY';
                        $activity_description = 'Company with ID '.$companyName.' updated successfully.';
                        $ip_address = $_SERVER['REMOTE_ADDR'];
                        $device_info = $_SERVER['HTTP_USER_AGENT'];
                        log_activity($user_id, $activity_type, $activity_description, $ip_address, $device_info);
                        // Activity Log
                        echo '<script>alert("Company updated successfully!");</script>';
                        echo '<script>window.location.href = "company.php";</script>';
                    } else {
                        echo '<script>alert("Error updating company: ' . $conn->error . '");</script>';
                    }
                } else {
                    echo '<script>alert("Company with this NMLS number already exists!");</script>';
                }
            }else{
                $query = "SELECT COUNT(*) AS nmls_count FROM companies WHERE company_nmls = '$companyNMLS'";
                $result = $conn->query($query);
                $row = $result->fetch_assoc();
                
                if($row['nmls_count'] == 0) {
                    $insertQuery = "INSERT INTO companies (user_id, company_nmls, company_name, company_email, company_contact, company_address, company_description) VALUES ('$user_id', '$companyNMLS', '$companyName', '$email', '$contact', '$address', '$description')";
                    if ($conn->query($insertQuery) === TRUE) {
                        $_SESSION['last_activity'] = time();
                        // Activity Log
                        $activity_type = 'COMPANY';
                        $activity_description = 'Company '.$companyName.' created successfully.';
                        $ip_address = $_SERVER['REMOTE_ADDR'];
                        $device_info = $_SERVER['HTTP_USER_AGENT'];
                        log_activity($user_id, $activity_type, $activity_description, $ip_address, $device_info);
                        // Activity Log
                        echo '<script>alert("Company created successfully!");</script>';
                        echo '<script>window.location.href = "company.php";</script>';
                    } else {
                        echo '<script>alert("Error creating company: ' . $conn->error . '");</script>';
                    }
                } else {
                    echo '<script>alert("Company with this NMLS number already exists!");</script>';
                }
            }
        } else {
            echo '<script>alert("All fields are required!");</script>';
        }
    }

    $sql = "SELECT * FROM users WHERE id = '$user_id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if($row['nmls_number'] == ''){
        echo '<script>alert("Please first complete your profile!");</script>';
        echo '<script>window.location.href = "profile.php";</script>';
        exit();
    }
    $sql = "SELECT * FROM companies WHERE user_id = '$user_id'";
    $result = $conn->query($sql);
    $company_details = $result->fetch_assoc();
    if($company_details > 0) {
        echo '<script>alert("No company registered!");</script>';
        echo '<script>window.location.href = "company.php";</script>';
        exit();
    }
?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Company</h1>
            <nav>
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Company Details</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section profile">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Create Company</h5>

                            <form method="POST" action="createCompany.php">
                                <div class="row mb-3">
                                    <label for="companyNMLS" class="col-sm-2 col-form-label">Company NMLS</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="companyNMLS" id="companyNMLS" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="companyName" class="col-sm-2 col-form-label">Company Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="companyName" id="companyName" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="email" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="contact" class="col-sm-2 col-form-label">Contact</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="contact" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="address" class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="address" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="description" class="col-sm-2 col-form-label">Company Description</label>
                                    <div class="col-sm-10">
                                        <textarea name="description" id="description" class="form-control" style="height: 100px"></textarea>
                                    </div>`
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Submit Form</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->
<?php
    include 'footer.php';
?>
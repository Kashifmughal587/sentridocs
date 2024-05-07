<?php
    include 'include.php';

    $user_id = $_SESSION['user_id'];

    // Function to generate a slug
    function generateSlug($text) {
        $text = strtolower(trim($text));
        $text = preg_replace('/[^a-z0-9-]/', '-', $text);
        $text = preg_replace('/-+/', "-", $text);
        return $text;
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST['companyNMLS'], $_POST['companyName'], $_POST['email'], $_POST['contact'], $_POST['description'])) {
            $company_id = $conn->real_escape_string($_POST['id']);
            $companyNMLS = $conn->real_escape_string($_POST['companyNMLS']);
            $companyName = $conn->real_escape_string($_POST['companyName']);
            $companySlug = generateSlug($_POST['companyName']);
            $email = $conn->real_escape_string($_POST['email']);
            $contact = $conn->real_escape_string($_POST['contact']);
            $address = $conn->real_escape_string($_POST['address']);
            $description = $conn->real_escape_string($_POST['description']);

            if (isset($_FILES['companyLogo']) && $_FILES['companyLogo']['error'] === UPLOAD_ERR_OK) {
                $targetDir = "../../assets/logos/";
                $targetDir2 = "assets/logos/";
            
                // Check if the target directory exists, and create it if not
                if (!file_exists($targetDir)) {
                    if (!mkdir($targetDir, 0777, true)) {
                        die('Failed to create target directory');
                    }
                }

                $logoFileName = basename($_FILES['companyLogo']['name']);
                $logoFilePath = $targetDir . $companySlug . '.' . pathinfo($logoFileName, PATHINFO_EXTENSION);
                $actualFilePath = $targetDir2 . $companySlug . '.' . pathinfo($logoFileName, PATHINFO_EXTENSION);
            
                // Move uploaded file to target directory with company slug as filename
                if (move_uploaded_file($_FILES['companyLogo']['tmp_name'], $logoFilePath)) {
                    $logoUrl = $actualFilePath; // Update the logoUrl with the uploaded file path
                    echo realpath($logoUrl);
                } else {
                    echo '<script>alert("Sorry, there was an error uploading your file.");</script>';
                }
            }else {
                // Check if an existing logo exists for this company in the database
                $query = "SELECT company_logo FROM companies WHERE id = '$company_id'";
                $result = $conn->query($query);
                $row = $result->fetch_assoc();
            
                if ($result->num_rows > 0 && !empty($row['company_logo'])) {
                    $logoUrl = $row['company_logo'];
                } else {
                    $logoUrl = '';
                }
            }

            if (isset($_FILES['companyFav']) && $_FILES['companyFav']['error'] === UPLOAD_ERR_OK) {
                $faviconDir = "../../assets/favicons/";
                $faviconDir2 = "assets/favicons/";
            
                // Check if the favicon directory exists, and create it if not
                if (!file_exists($faviconDir)) {
                    if (!mkdir($faviconDir, 0777, true)) {
                        die('Failed to create favicon directory');
                    }
                }

                $faviconFileName = basename($_FILES['companyFav']['name']);
                $faviconFilePath = $faviconDir . $companySlug . '_favicon.' . pathinfo($faviconFileName, PATHINFO_EXTENSION);
                $actualFaviconFilePath = $faviconDir2 . $companySlug . '_favicon.' . pathinfo($faviconFileName, PATHINFO_EXTENSION);
            
                // Move uploaded file to favicon directory with company slug as filename
                if (move_uploaded_file($_FILES['companyFav']['tmp_name'], $faviconFilePath)) {
                    $faviconUrl = $faviconFilePath;
                    $faviconUrl = $actualFaviconFilePath;

                } else {
                    echo '<script>alert("Sorry, there was an error uploading your favicon.");</script>';
                }
            }else {
                // Check if an existing favicon exists for this company in the database
                $query = "SELECT company_fav FROM companies WHERE id = '$company_id'";
                $result = $conn->query($query);
                $row = $result->fetch_assoc();
            
                if ($result->num_rows > 0 && !empty($row['company_fav'])) {
                    $faviconUrl = $row['company_fav'];
                } else {
                    $faviconUrl = '';
                }
            }
            
            if(isset($_POST['action']) && $_POST['action'] == 'update'){
                $query = "SELECT COUNT(*) AS nmls_count FROM companies WHERE company_nmls = '$companyNMLS' AND id != '$company_id'";
                $result = $conn->query($query);
                $row = $result->fetch_assoc();

                if($row['nmls_count'] == 0) {
                    $updateQuery = "UPDATE companies SET company_nmls = '$companyNMLS', company_name = '$companyName', company_slug = '$companySlug', company_email = '$email', company_contact = '$contact', company_address = '$address', company_description = '$description', company_logo = '$logoUrl', company_fav = '$faviconUrl' WHERE id = '$company_id'";
                    
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
                    $insertQuery = "INSERT INTO companies (user_id, company_nmls, company_name, company_slug, company_email, company_contact, company_address, company_description, company_logo, company_fav) VALUES ('$user_id', '$companyNMLS', '$companyName', '$companySlug', '$email', '$contact', '$address', '$description', '$logoUrl', '$faviconUrl')";
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
        echo '<script>alert("Company Already Registered!");</script>';
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

                            <form method="POST" action="createCompany.php" enctype="multipart/form-data">

                                <div class="row mb-3">
                                    <label for="companyLogo" class="col-md-4 col-lg-3 col-form-label">Company logo</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="companyLogo" type="file" class="form-control" id="companyLogo" value="<?php echo $company_details['company_logo'];?>">
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label for="companyFav" class="col-md-4 col-lg-3 col-form-label">Company Favicon</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="companyFav" type="file" class="form-control" id="companyFav" value="<?php echo $company_details['company_fav'];?>">
                                    </div>
                                </div>
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
                                        <input type="text" name="contact" class="form-control" placeholder="(xxx) xxx-xxxx" oninput="formatPhoneNumber(this)">
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
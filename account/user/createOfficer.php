<?php
    include 'include.php';

    $user_id = $_SESSION['user_id'];

    $sql = "SELECT * FROM users WHERE id = '$user_id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if($row['nmls_number'] == '' || $row['contact'] == ''){
        echo '<script>alert("Please first complete your profile!");</script>';
        echo '<script>window.location.href = "profile.php";</script>';
        exit();
    }

    $sql = "SELECT * FROM companies WHERE user_id = '$user_id'";
    $result = $conn->query($sql);
    $company_details = $result->fetch_assoc();
    if($company_details < 1) {
        echo '<script>alert("Please first create your company!");</script>';
        echo '<script>window.location.href = "createCompany.php";</script>';
        exit();
    }else{
        $company_id = $company_details['id'];
        $sql = "SELECT * FROM loan_officer WHERE company_id = '$company_id'";
        $result = $conn->query($sql);
        $officer_details = $result->fetch_assoc();
        if($officer_details > 0 && !isset($_POST['action'])) {
            echo '<script>alert("'. $_POST['action'] .'");</script>';
            echo '<script>alert("Officer Already Registered!");</script>';
            echo '<script>window.location.href = "officer.php";</script>';
            exit();
        }
    }
    function generateSlug($text) {
        $text = strtolower(trim($text));
        $text = preg_replace('/[^a-z0-9-]/', '-', $text);
        $text = preg_replace('/-+/', "-", $text);
        return $text;
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST' && (isset($_POST['action']) && $_POST['action'] == 'socialLinks')){
        if(isset($_POST['id'], $_POST['company_id'])) {
            $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
            $facebookLink = filter_var($_POST['facebook_link'], FILTER_SANITIZE_URL);
            $instagramLink = filter_var($_POST['instagram_link'], FILTER_SANITIZE_URL);
            $linkedinLink = filter_var($_POST['linkedin_link'], FILTER_SANITIZE_URL);
            $twitterLink = filter_var($_POST['twitter_link'], FILTER_SANITIZE_URL);
            $youtubeLink = filter_var($_POST['youtube_link'], FILTER_SANITIZE_URL);
            $tiktokLink = filter_var($_POST['tiktok_link'], FILTER_SANITIZE_URL);

            $updateQuery = "UPDATE loan_officer SET facebook_link = '$facebookLink', instagram_link = '$instagramLink', linkedin_link = '$linkedinLink', twitter_link = '$twitterLink',  youtube_link = '$youtubeLink', tiktok_link = '$tiktokLink' WHERE id = '$id'";
                    
            if ($conn->query($updateQuery) === TRUE) {
                $_SESSION['last_activity'] = time();
                // Activity Log
                $activity_type = 'OFFICER';
                $activity_description = 'officer social links with ID '.$officerName.' updated successfully.';
                $ip_address = $_SERVER['REMOTE_ADDR'];
                $device_info = $_SERVER['HTTP_USER_AGENT'];
                log_activity($user_id, $activity_type, $activity_description, $ip_address, $device_info);
                // Activity Log
                echo '<script>alert("Links updated successfully!");</script>';
                echo '<script>window.location.href = "officer.php";</script>';
            } else {
                echo '<script>alert("Error updating officer links: ' . $conn->error . '");</script>';
                echo '<script>window.location.href = "officer.php";</script>';
                exit();
            }
        } else {
            echo '<script>alert("Error updating officer links: ' . $conn->error . '");</script>';
            echo '<script>window.location.href = "officer.php";</script>';
            exit();
        }
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST['officerNMLS'], $_POST['officerName'], $_POST['email'], $_POST['contact'])) {
            $officer_id = $conn->real_escape_string($_POST['id']);
            $officerNMLS = $conn->real_escape_string($_POST['officerNMLS']);
            $officerName = $conn->real_escape_string($_POST['officerName']);
            $officerSlug = generateSlug($_POST['officerName']);
            $jobTitle = $conn->real_escape_string($_POST['jobTitle']);
            $email = $conn->real_escape_string($_POST['email']);
            $contact = $conn->real_escape_string($_POST['contact']);
            $yearOfExperience = $conn->real_escape_string($_POST['yearOfExperience']);
            $website = $conn->real_escape_string($_POST['website']);
            $calendlyLink = $conn->real_escape_string($_POST['calendlyLink']);
            $address = $conn->real_escape_string($_POST['address']);
            $about = $conn->real_escape_string($_POST['about']);

            if (isset($_FILES['profilePicture']) && $_FILES['profilePicture']['error'] === UPLOAD_ERR_OK) {
                $targetDir = "../../assets/profile/";
                $targetDir2 = "assets/profile/";
            
                // Check if the target directory exists, and create it if not
                if (!file_exists($targetDir)) {
                    if (!mkdir($targetDir, 0777, true)) {
                        die('Failed to create target directory');
                    }
                }

                $profileFileName = basename($_FILES['profilePicture']['name']);
                $profileFilePath = $targetDir . $officerSlug . '.' . pathinfo($profileFileName, PATHINFO_EXTENSION);
                $actualFilePath = $targetDir2 . $officerSlug . '.' . pathinfo($profileFileName, PATHINFO_EXTENSION);
            
                // Move uploaded file to target directory with officer slug as filename
                if (move_uploaded_file($_FILES['profilePicture']['tmp_name'], $profileFilePath)) {
                    $profileUrl = $actualFilePath; // Update the profileUrl with the uploaded file path
                    echo realpath($profileUrl);
                } else {
                    echo '<script>alert("Sorry, there was an error uploading your file.");</script>';
                }
            }else {
                $query = "SELECT profile_photo FROM loan_officer WHERE id = '$officer_id'";
                $result = $conn->query($query);
                $row = $result->fetch_assoc();
            
                if ($result->num_rows > 0 && !empty($row['profile_photo'])) {
                    $profileUrl = $row['profile_photo'];
                } else {
                    $profileUrl = '';
                }
            }
            
            if(isset($_POST['action']) && $_POST['action'] == 'update'){
                $query = "SELECT COUNT(*) AS nmls_count FROM loan_officer WHERE officer_nmls = '$officerNMLS' AND id != '$officer_id'";
                $result = $conn->query($query);
                $row = $result->fetch_assoc();

                if($row['nmls_count'] == 0) {
                    $updateQuery = "UPDATE loan_officer SET officer_nmls = '$officerNMLS', officer_name = '$officerName', officer_slug = '$officerSlug', job_title = '$jobTitle',  officer_email = '$email', contact = '$contact', website = '$website', calendly_link = '$calendlyLink', experience = '$yearOfExperience', officer_address = '$address', about_text = '$about', profile_photo = '$profileUrl' WHERE id = '$officer_id'";
                    
                    if ($conn->query($updateQuery) === TRUE) {
                        $_SESSION['last_activity'] = time();
                        // Activity Log
                        $activity_type = 'OFFICER';
                        $activity_description = 'officer with ID '.$officerName.' updated successfully.';
                        $ip_address = $_SERVER['REMOTE_ADDR'];
                        $device_info = $_SERVER['HTTP_USER_AGENT'];
                        log_activity($user_id, $activity_type, $activity_description, $ip_address, $device_info);
                        // Activity Log
                        echo '<script>alert("Officer updated successfully!");</script>';
                        echo '<script>window.location.href = "officer.php";</script>';
                    } else {
                        echo '<script>alert("Error updating officer: ' . $conn->error . '");</script>';
                    }
                } else {
                    echo '<script>alert("officer with this NMLS number already exists!");</script>';
                }
            }else{
                $query = "SELECT COUNT(*) AS nmls_count FROM loan_officer WHERE officer_nmls = '$officerNMLS'";
                $result = $conn->query($query);
                $row = $result->fetch_assoc();
                
                if($row['nmls_count'] == 0) {
                    $insertQuery = "INSERT INTO loan_officer (company_id, officer_nmls, officer_name, officer_slug, job_title, officer_email, contact, website, calendly_link, experience, officer_address, about_text, profile_photo) VALUES ('$company_id', '$officerNMLS', '$officerName', '$officerSlug', '$jobTitle', '$email', '$contact', '$website', '$calendlyLink', '$yearOfExperience', '$address', '$about', '$profileUrl')";
                    if ($conn->query($insertQuery) === TRUE) {
                        $_SESSION['last_activity'] = time();
                        // Activity Log
                        $activity_type = 'OFFICER';
                        $activity_description = 'officer '.$officerName.' created successfully.';
                        $ip_address = $_SERVER['REMOTE_ADDR'];
                        $device_info = $_SERVER['HTTP_USER_AGENT'];
                        log_activity($user_id, $activity_type, $activity_description, $ip_address, $device_info);
                        // Activity Log
                        echo '<script>alert("officer created successfully!");</script>';
                        echo '<script>window.location.href = "officer.php";</script>';
                    } else {
                        echo '<script>alert("Error creating officer: ' . $conn->error . '");</script>';
                    }
                } else {
                    echo '<script>alert("officer with this NMLS number already exists!");</script>';
                }
            }
        } else {
            echo '<script>alert("All fields are required!");</script>';
        }
    }
?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Loan officer</h1>
            <nav>
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">officer Details</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section profile">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Create officer</h5>

                            <form method="POST" action="createOfficer.php" enctype="multipart/form-data">

                                <div class="row mb-3">
                                    <label for="profilePicture" class="col-md-4 col-lg-3 col-form-label">Profile Picture</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="profilePicture" type="file" class="form-control" id="profilePicture" value="<?php echo $officer_details['profile_photo'];?>">
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label for="officerNMLS" class="col-sm-2 col-form-label">Officer NMLS</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="officerNMLS" id="officerNMLS" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="officerName" class="col-sm-2 col-form-label">Officer Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="officerName" id="officerName" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="jobTitle" class="col-sm-2 col-form-label">Job Title</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="jobTitle" id="jobTitle" class="form-control">
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
                                    <label for="yearOfExperience" class="col-sm-2 col-form-label">Years of Experience</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="yearOfExperience" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="website" class="col-sm-2 col-form-label">Website</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="website" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="calendlyLink" class="col-sm-2 col-form-label">Calendly Link</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="calendlyLink" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="address" class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="address" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="about" class="col-sm-2 col-form-label">About</label>
                                    <div class="col-sm-10">
                                        <textarea name="about" id="about" class="form-control" style="height: 100px"></textarea>
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
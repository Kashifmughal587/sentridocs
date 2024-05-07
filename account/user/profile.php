<?php
    include 'include.php';

    $user_id = $_SESSION['user_id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'changePassword') {
        $currentPassword = $conn->real_escape_string($_POST['currentPassword']);
        $newPassword = $conn->real_escape_string($_POST['newPassword']);
        $renewPassword = $conn->real_escape_string($_POST['renewPassword']);
    
        if ($newPassword !== $renewPassword) {
            echo '<script>alert("New passwords do not match!");</script>';
        } else {
            $user_id = $_SESSION['user_id'];
            $sql = "SELECT password FROM users WHERE id = '$user_id'";
            $result = $conn->query($sql);
    
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $hashedPassword = $row['password'];
                // $hashedCurrentPassword = password_hash($currentPassword, PASSWORD_DEFAULT);
                if (password_verify($currentPassword, $hashedPassword)) {
                    $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    
                    $updateQuery = "UPDATE users SET password = '$hashedNewPassword' WHERE id = '$user_id'";
                    if ($conn->query($updateQuery) === TRUE) {
                        echo '<script>alert("Password changed successfully!");</script>';
                        $_SESSION['last_activity'] = time();
                    } else {
                        echo '<script>alert("Error changing password: ' . $conn->error . '");</script>';
                    }
                } else {
                    echo '<script>alert("Incorrect current password!");</script>';
                }
            } else {
                echo '<script>alert("User not found!");</script>';
            }
        }
    }    

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'update') {
        if(isset($_POST['firstname'], $_POST['lastname'], $_POST['nmlsNumber'], $_POST['phone'])) {
            $firstname = $conn->real_escape_string($_POST['firstname']);
            $lastname = $conn->real_escape_string($_POST['lastname']);
            $nmlsNumber = $conn->real_escape_string($_POST['nmlsNumber']);
            $phone = $conn->real_escape_string($_POST['phone']);
            $sql = "SELECT * FROM users WHERE nmls_number = '$nmlsNumber' AND id !='$user_id'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                echo '<script>alert("This NMLS number is associated with another user. Please check again for your own NMLS Number.");</script>';
            } else {
                $sql = "UPDATE users SET firstname='$firstname', lastname='$lastname', nmls_number='$nmlsNumber', contact='$phone' WHERE id='$user_id'";
                
                if ($conn->query($sql) === TRUE) {
                    $_SESSION['last_activity'] = time();
                    echo '<script>alert("Profile updated successfully!");</script>';
                } else {
                    echo '<script>alert("Error updating profile: ' . $conn->error . '");</script>';
                }
            }
        } else {
            echo '<script>alert("All fields are required!");</script>';
        }
    }

    $query = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        $user_details = $result->fetch_assoc();

        $query = "SELECT COUNT(*) as Total FROM companies WHERE user_id = '$user_id'";
        $result2 = $conn->query($query);
        $companyCount = $result2->fetch_assoc();
    }else{
        echo '<script>alert("User not found.")</script>';
    }
?>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Profile</h1>
            <nav>
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Profile</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            <img src="../../assets/img/user.png" alt="Profile" class="rounded-circle">
                            <h2><?php echo $user_details['username']?></h2>
                            <h3><a href="mailto:<?php echo $user_details['email'] ?>"><?php echo $user_details['email']?></a></h3>
                            <div class="social-links mt-2">
                                <!-- <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a> -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">
                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                                </li>

                                <!-- <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
                                </li> -->

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                                </li>

                            </ul>
                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active profile-overview" id="profile-overview">

                                    <h5 class="card-title">Profile Details</h5>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">NMLS Number</div>
                                        <div class="col-lg-9 col-md-8">
                                            <?php echo $user_details['nmls_number'] ?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                        <div class="col-lg-9 col-md-8"><?php echo $user_details['firstname'] . ' ' . $user_details['lastname']?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Company</div>
                                            <?php
                                                if(isset($companyCount) && $companyCount['Total'] > 0) {
                                                    // $query = 'SELECT * FROM companies WHERE user_id = '.$user_id;
                                                    $query = "SELECT * FROM companies WHERE user_id = '$user_id'";
                                                    $result3 = $conn->query($query);
                                                    $company_details = $result3->fetch_assoc();
                                                    echo '<div class="col-lg-9 col-md-8">'.$company_details['company_name'].'</div>';
                                                }else{
                                                    echo '<div class="col-lg-9 col-md-8">Not registered yet.</div>';
                                                }
                                            ?>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Phone</div>
                                        <div class="col-lg-9 col-md-8"><?php echo $user_details['contact']?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Email</div>
                                        <div class="col-lg-9 col-md-8"><?php echo $user_details['email']?></div>
                                    </div>

                                </div>

                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                    <!-- Profile Edit Form -->
                                    <form action="profile.php" method="POST">
                                        <input type="hidden" name="action" value="update">
                                        <div class="row mb-3">
                                            <label for="nmlsNumber" class="col-md-4 col-lg-3 col-form-label">NMLS Number</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="nmlsNumber" type="text" class="form-control" id="nmlsNumber" value="<?php echo $user_details['nmls_number'];?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="firstname" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="firstname" type="text" class="form-control" id="firstname" value="<?php echo $user_details['firstname'];?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="lastname" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="lastname" type="text" class="form-control" id="lastname" value="<?php echo $user_details['lastname'];?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="phone" type="text" class="form-control" id="Phone" placeholder="(xxx) xxx-xxxx" oninput="formatPhoneNumber(this)" value="<?php echo $user_details['contact'];?>" >
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="email" class="form-control" id="Email" readonly value="<?php echo $user_details['email'];?>">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form><!-- End Profile Edit Form -->

                                </div>

                                <!-- <div class="tab-pane fade pt-3" id="profile-settings">

                                    <form>

                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                                            <div class="col-md-8 col-lg-9">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="changesMade" checked>
                                                    <label class="form-check-label" for="changesMade">
                                                        Changes made to your account
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="newProducts" checked>
                                                    <label class="form-check-label" for="newProducts">
                                                        Information on new products and services
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="proOffers">
                                                    <label class="form-check-label" for="proOffers">
                                                        Marketing and promo offers
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                                                    <label class="form-check-label" for="securityNotify">
                                                        Security alerts
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>

                                </div> -->

                                <div class="tab-pane fade pt-3" id="profile-change-password">
                                    <form method="POST" action="profile.php">
                                        <input type="hidden" name="action" value="changePassword">
                                        <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
                                        <div class="row mb-3">
                                            <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="currentPassword" type="password" class="form-control" id="currentPassword">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="newPassword" type="password" class="form-control" id="newPassword">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="renewPassword" type="password" class="form-control" id="renewPassword">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Change Password</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->
<?php
include 'footer.php';
?>
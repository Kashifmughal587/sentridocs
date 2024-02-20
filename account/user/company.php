<?php

    require('../../assets/db/db_connection.php');

    session_start();

    if (!isset($_SESSION['user_id'])) {
        echo '<script>window.location.href = "login.php";</script>';
        exit();
    }
    
    include 'header.php';
    include 'sidebar.php';

    $user_id = $_SESSION['user_id'];

    $sql = "SELECT * FROM companies WHERE user_id = '$user_id'";
    $result = $conn->query($sql);
    $company_details = $result->fetch_assoc();
    if($company_details < 1) {
        echo '<script>window.location.href = "createCompany.php";</script>';
        exit();
    }else{
        $company_id = $company_details['id'];
        $sql = "SELECT COUNT(*) as Total FROM license_keys WHERE company_id = '$company_id'";
        $result2 = $conn->query($sql);
        $license_count = $result2->fetch_assoc();
        if($license_count < 1) {

        }
        else{
            $sql = "SELECT * FROM license_keys WHERE company_id = '$company_id'";
            $result3 = $conn->query($sql);
            $license_details = $result3->fetch_assoc();
        }
    }
    
    $conn->close();
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
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">
                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Company</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">License Key</button>
                                </li>

                            </ul>
                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active profile-overview" id="profile-overview">

                                    <h5 class="card-title">Company Details</h5>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">NMLS Number</div>
                                        <div class="col-lg-9 col-md-8">
                                            <?php echo $company_details['company_nmls'] ?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Company Name</div>
                                        <div class="col-lg-9 col-md-8"><?php echo $company_details['company_name']?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Company Email</div>
                                        <div class="col-lg-9 col-md-8"><?php echo $company_details['company_email']?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Contact</div>
                                        <div class="col-lg-9 col-md-8"><?php echo $company_details['company_contact']?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Address</div>
                                        <div class="col-lg-9 col-md-8"><?php echo $company_details['company_address']?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Description</div>
                                        <div class="col-lg-9 col-md-8"><?php echo $company_details['company_description']?></div>
                                    </div>

                                </div>

                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                    <!-- Profile Edit Form -->
                                    <form action="createCompany.php" method="POST" action="update">
                                        <input type="hidden" name="action" value="update">
                                        <input type="hidden" name="id" id="id" value="<?php echo $company_details['id'];?>">
                                        <div class="row mb-3">
                                            <label for="companyNMLS" class="col-md-4 col-lg-3 col-form-label">NMLS Number</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="companyNMLS" type="number" class="form-control" id="companyNMLS" value="<?php echo $company_details['company_nmls'];?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="companyName" class="col-md-4 col-lg-3 col-form-label">Company Name</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="companyName" type="text" class="form-control" id="companyName" value="<?php echo $company_details['company_name'];?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="email" class="form-control" id="email" readonly value="<?php echo $company_details['company_email'];?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="contact" class="col-md-4 col-lg-3 col-form-label">Contact</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="contact" type="text" class="form-control" id="contact" value="<?php echo $company_details['company_contact'];?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="address" type="text" class="form-control" id="address" value="<?php echo $company_details['company_address'];?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="description" class="col-sm-2 col-form-label">Company Description</label>
                                            <div class="col-sm-10">
                                                <textarea name="description" id="description" class="form-control" style="height: 100px"><?php echo $company_details['company_description'];?></textarea>
                                            </div>`
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form><!-- End Profile Edit Form -->

                                </div>

                                <div class="tab-pane fade pt-3" id="profile-settings">

                                    <!-- Settings Form -->
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
                                    </form><!-- End settings Form -->

                                </div>

                                <div class="tab-pane fade pt-3" id="profile-change-password">
                                    <!-- Change Password Form -->
                                    <form method="POST" action="generateLicense.php">
                                        <?php
                                            if(isset($license_count) && $license_count['Total'] < 1){
                                                ?>
                                                    <input type="hidden" name="action" value="generateLicense">
                                                    <div class="text-center">
                                                        <button type="submit" class="btn btn-primary">Generate License</button>
                                                    </div>
                                                <?php
                                            }
                                            else{
                                                ?>
                                                    <div class="row mb-3">
                                                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                                        <div class="col-md-8 col-lg-9">
                                                            <input name="password" type="password" class="form-control" id="currentPassword">
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                                        <div class="col-md-8 col-lg-9">
                                                            <input name="newpassword" type="password" class="form-control" id="newPassword">
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                                                        <div class="col-md-8 col-lg-9">
                                                            <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                                                        </div>
                                                    </div>

                                                    <div class="text-center">
                                                        <button type="submit" class="btn btn-primary">Generate License</button>
                                                    </div>
                                                <?php
                                            }
                                        ?>
                                    </form><!-- End Change Password Form -->
                                </div>
                            </div><!-- End Bordered Tabs -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->
<?php
    include 'footer.php';
?>
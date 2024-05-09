<?php

    include 'include.php';

    if(isset($_GET['id'])) {
        $company_id = $_GET['id'];
        $query = "SELECT * FROM companies WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $company_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0) {
            $company_details = $result->fetch_assoc();

            $user_id = $company_details["user_id"];

            $query = "SELECT * FROM users WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if($result->num_rows > 0) {
                $user_details = $result->fetch_assoc();
            }else{
                echo '<script>alert("User not found.")</script>';
                echo '<script>window.location.href = "users.php";</script>';
            }
        } else {
            echo '<script>alert("Company not found.")</script>';
            echo '<script>window.location.href = "companies.php";</script>';
        }
    }else{
        echo '<script>window.location.href = "companies.php";</script>';
        exit();
    }
?>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Company</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row align-items-top">
                <div class="col-lg-12">
                    <!-- Card with header and footer -->
                    <div class="card">
                        <div class="card-header">
                            Company Details
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">
                                Company Name: <?php echo $company_details["company_name"]; ?>
                            </h5>
                            <!-- Active Table -->
                            <table class="table table-borderless">
                                <tr>
                                    <th scope="col">Company Logo</th>
                                    <td scope="col">
                                        <?php 
                                            if(!empty($company_details['company_logo'])) {
                                                echo '<img src="../../'.$company_details['company_logo'].'" alt="Company Logo" style="max-width: 200px;">';
                                            } else {
                                                echo 'No logo uploaded.';
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="col">Company Favicon</th>
                                    <td scope="col">
                                        <?php 
                                            if(!empty($company_details['company_fav'])) {
                                                echo '<img src="../../'.$company_details['company_fav'].'" alt="Company Favicon" style="max-width: 200px;">';
                                            } else {
                                                echo 'No icon uploaded.';
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="col">Company NMLS</th>
                                    <td scope="col"><?php echo $company_details["company_nmls"]; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Email</th>
                                    <td><?php echo $company_details["company_email"]; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Contact No.</th>
                                    <td><?php echo $company_details["company_contact"]; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Address</th>
                                    <td><?php echo $company_details["company_address"]; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Company Refinance URL</th>
                                    <td><?php echo 'https://sentridocs.com/'.$company_details['company_slug'],'/refinance.php'?></td>
                                </tr>
                            </table>
                            <h5 class="card-title">
                                User Details
                            </h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th scope="row">User NMLS</th>
                                    <td><?php echo $user_details["nmls_number"]; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">User Name</th>
                                    <td><?php echo $user_details["firstname"] . ' ' . $user_details['lastname']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">User Email</th>
                                    <td><?php echo $user_details["email"]; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">User Password</th>
                                    <td>
                                        <form action="update_status.php" method="GET">
                                            <input type="hidden" name="id" value="<?php echo $user_details['id']; ?>">
                                            <input type="hidden" name="status" value="resetPassword">
                                            <button type="submit" class="btn btn-primary">Reset Password</button>
                                        </form>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Company Description</h5>
                            <?php 
                                if($company_details["company_description"] != ''){
                                    echo $company_details["company_description"]; 
                                }else{
                                    echo 'No description found.';
                                }
                            ?>
                        </div>
                        <?php
                            $sql = "SELECT * FROM license_keys WHERE company_id = '$company_id' AND user_id = '$user_id'";
                            $result3 = $conn->query($sql);
                            $license_details = $result3->fetch_assoc();
                            if(isset($license_details["key_code"]) && $license_details['encryption_key']){
                            ?>
                                <div class="card-body">
                                    <h5 class="card-title">Keys</h5>
                                    <div class="row mb-3">
                                        <label for="licenseKey" class="col-md-4 col-lg-3 col-form-label">License Key</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="licenseKey" type="text" class="form-control" id="licenseKey" value="<?php echo $license_details['key_code'];?>" readonly>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="secretKey" class="col-md-4 col-lg-3 col-form-label">Secret Key</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="secretKey" type="text" class="form-control" id="secretKey" value="<?php echo $license_details['encryption_key'];?>" readonly>
                                        </div>
                                    </div>
                                </div>
                            <?php
                                }else{
                                    echo '<div class="card-body">
                                            <h5 class="card-title">Keys</h5>
                                            License Key is not generated yet.
                                        </div>';
                                }
                            ?>
                        
                        <div class="card-footer">
                            <?php
                                if($company_details['status'] == 'active'){
                                    echo "<span class='badge bg-success'><i class='bi bi-check-circle me-1'></i>Active</span> / <span class='badge bg-light text-dark'><i class='bi bi-info-circle me-1'></i> <a href='update_status.php?id=".$company_details['id']."&status=Active'>In Active</a></span>";
                                }else{
                                    echo "<span class='badge bg-light text-dark'><i class='bi bi-info-circle me-1'></i><a <a href='update_status.php?id=".$company_details['id']."&status=Inactive'>Active</a></span> / <span class='badge bg-success'><i class='bi bi-check-circle me-1'></i>In Active</span>";
                                }
                            ?>
                        </div>
                    </div><!-- End Card with header and footer -->
                </div>
            </div>
        </section>

    </main><!-- End #main -->
<?php
include 'footer.php';
?>
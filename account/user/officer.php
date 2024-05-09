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
        echo '<script>window.location.href = "createCompany.php";</script>';
        exit();
    }else{
        $company_id = $company_details['id'];

        $sql = "SELECT * FROM loan_officer WHERE company_id = '$company_id'";
        $result = $conn->query($sql);
        $officer_details = $result->fetch_assoc();

        if($officer_details < 1) {
            echo '<script>window.location.href = "createOfficer.php";</script>';
            exit();
        }
    }
?>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Loan Officer</h1>
            <nav>
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Loan Officer</li>
                </ol>
            </nav>
        </div><!-- End Pag`e Title -->
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
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Details</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#social-link-edit">Edit Social Links</button>
                                </li>
                            </ul>
                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active profile-overview" id="profile-overview">

                                    <h5 class="card-title">Officer Details</h5>

                                    <div class="row">
                                        <label class="col-md-4 col-lg-3 col-form-label">Company Logo</label>
                                        <div class="col-md-8 col-lg-9">
                                            <?php 
                                                if(!empty($company_details['company_logo'])) {
                                                    echo '<img src="../../'.$company_details['company_logo'].'" alt="Company Logo" style="max-width: 200px;">';
                                                } else {
                                                    echo 'No logo uploaded.';
                                                }
                                            ?>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label class="col-md-4 col-lg-3 col-form-label">Profile Picture</label>
                                        <div class="col-md-8 col-lg-9">
                                            <?php 
                                                if(!empty($officer_details['profile_photo'])) {
                                                    echo '<img src="../../'.$officer_details['profile_photo'].'" alt="Profile Picture" style="max-height: 200px;">';
                                                } else {
                                                    echo 'No picture uploaded.';
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">NMLS Number</div>
                                        <div class="col-lg-9 col-md-8">
                                            <?php echo $officer_details['officer_nmls'] ?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Name</div>
                                        <div class="col-lg-9 col-md-8"><?php echo $officer_details['officer_name']?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Job Title</div>
                                        <div class="col-lg-9 col-md-8"><?php echo $officer_details['job_title']?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Email</div>
                                        <div class="col-lg-9 col-md-8"><?php echo $officer_details['officer_email']?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Contact</div>
                                        <div class="col-lg-9 col-md-8"><?php echo $officer_details['contact']?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Years of Experience</div>
                                        <div class="col-lg-9 col-md-8"><?php echo $officer_details['experience']?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Website</div>
                                        <div class="col-lg-9 col-md-8"><?php echo $officer_details['website']?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Calendly Link</div>
                                        <div class="col-lg-9 col-md-8"><?php echo $officer_details['calendly_link']?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Address</div>
                                        <div class="col-lg-9 col-md-8"><?php echo $officer_details['officer_address']?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">About</div>
                                        <div class="col-lg-9 col-md-8"><?php echo $officer_details['about_text']?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Page URL</div>
                                        <div class="col-lg-9 col-md-8"><?php echo 'https://sentridocs.com/'.$company_details['company_slug'],'/loan-officer.php'?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Social URLs</div>
                                        <div class="col-lg-9 col-md-8">
                                                <!-- Social Media Links -->
                                                <div class="row mb-3">
                                                    <?php if (!empty($officer_details['facebook_link'])) : ?>
                                                        <div class="col-md-1 col-lg-1">
                                                            <a href="<?php if (strpos($officer_details['facebook_link'], 'http://') !== 0 && strpos($officer_details['facebook_link'], 'https://') !== 0) {
                                                                    $officer_details['facebook_link'] = 'https://' . $officer_details['facebook_link']; 
                                                                }echo $officer_details['facebook_link']; ?>" target="_blank" class="social-icon">
                                                                <i class="bi bi-facebook"></i>
                                                            </a>
                                                        </div>
                                                    <?php endif; 
                                                    
                                                    if (!empty($officer_details['instagram_link'])) : ?>
                                                        <div class="col-md-1 col-lg-1">
                                                            <a href="<?php if (strpos($officer_details['instagram_link'], 'http://') !== 0 && strpos($officer_details['instagram_link'], 'https://') !== 0) {
                                                                    $officer_details['instagram_link'] = 'https://' . $officer_details['instagram_link']; 
                                                                }echo $officer_details['instagram_link']; ?>" target="_blank" class="social-icon">
                                                                <i class="bi bi-instagram"></i>
                                                            </a>
                                                        </div>
                                                    <?php endif;
                                                    
                                                    if (!empty($officer_details['linkedin_link'])) : ?>
                                                        <div class="col-md-1 col-lg-1">
                                                            <a href="<?php if (strpos($officer_details['linkedin_link'], 'http://') !== 0 && strpos($officer_details['linkedin_link'], 'https://') !== 0) {
                                                                    $officer_details['linkedin_link'] = 'https://' . $officer_details['linkedin_link']; 
                                                                }echo $officer_details['linkedin_link']; ?>" target="_blank" class="social-icon">
                                                                <i class="bi bi-linkedin"></i>
                                                            </a>
                                                        </div>
                                                    <?php endif;

                                                    if (!empty($officer_details['twitter_link'])) : ?>
                                                        <div class="col-md-1 col-lg-1">
                                                            <a href="<?php if (strpos($officer_details['twitter_link'], 'http://') !== 0 && strpos($officer_details['twitter_link'], 'https://') !== 0) {
                                                                    $officer_details['twitter_link'] = 'https://' . $officer_details['twitter_link']; 
                                                                }echo $officer_details['twitter_link']; ?>" target="_blank" class="social-icon">
                                                                <i class="fab fa-twitter"></i>
                                                            </a>
                                                        </div>
                                                    <?php endif;

                                                    if (!empty($officer_details['youtube_link'])) : ?>
                                                        <div class="col-md-1 col-lg-1">
                                                            <a href="<?php if (strpos($officer_details['youtube_link'], 'http://') !== 0 && strpos($officer_details['youtube_link'], 'https://') !== 0) {
                                                                    $officer_details['youtube_link'] = 'https://' . $officer_details['youtube_link']; 
                                                                }echo $officer_details['youtube_link']; ?>" target="_blank" class="social-icon">
                                                                <i class="bi bi-youtube"></i>
                                                            </a>
                                                        </div>
                                                    <?php endif;

                                                    if (!empty($officer_details['tiktok_link'])) : ?>
                                                        <div class="col-md-1 col-lg-1">
                                                            <a href="<?php if (strpos($officer_details['tiktok_link'], 'http://') !== 0 && strpos($officer_details['tiktok_link'], 'https://') !== 0) {
                                                                    $officer_details['tiktok_link'] = 'https://' . $officer_details['tiktok_link']; 
                                                                }echo $officer_details['tiktok_link']; ?>" target="_blank" class="social-icon">
                                                                <i class="bi bi-tiktok"></i>
                                                            </a>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                    <!-- Profile Edit Form -->
                                    <form action="createOfficer.php" method="POST" action="update" enctype="multipart/form-data">
                                        <input type="hidden" name="action" value="update">
                                        <input type="hidden" name="id" id="id" value="<?php echo $officer_details['id'];?>">
                                        <input type="hidden" name="company_id" id="company_id" value="<?php echo $company_details['id'];?>">

                                        <div class="row mb-3">
                                            <label for="profilePicture" class="col-md-4 col-lg-3 col-form-label">Profile Picture</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="profilePicture" type="file" class="form-control" id="profilePicture" value="<?php echo $officer_details['profile_photo'];?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="officerNMLS" class="col-md-4 col-lg-3 col-form-label">NMLS Number</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="officerNMLS" type="number" class="form-control" id="officerNMLS" value="<?php echo $officer_details['officer_nmls'];?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="officerName" class="col-md-4 col-lg-3 col-form-label">Name</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="officerName" type="text" class="form-control" id="officerName" value="<?php echo $officer_details['officer_name'];?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="jobTitle" class="col-md-4 col-lg-3 col-form-label">Job Title</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="jobTitle" type="text" class="form-control" id="jobTitle" value="<?php echo $officer_details['job_title'];?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="email" class="form-control" id="email" readonly value="<?php echo $officer_details['officer_email'];?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="contact" class="col-md-4 col-lg-3 col-form-label">Contact</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="contact" type="text" class="form-control" id="contact" value="<?php echo $officer_details['contact'];?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="yearOfExperience" class="col-md-4 col-lg-3 col-form-label">Years of Experience</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="yearOfExperience" type="number" class="form-control" id="yearOfExperience" value="<?php echo $officer_details['experience'];?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="website" class="col-md-4 col-lg-3 col-form-label">Website</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="website" type="text" class="form-control" id="website" value="<?php echo $officer_details['website'];?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="calendlyLink" class="col-md-4 col-lg-3 col-form-label">Calendly Link</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="calendlyLink" type="text" class="form-control" id="calendlyLink" value="<?php echo $officer_details['calendly_link'];?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="address" type="text" class="form-control" id="address" value="<?php echo $officer_details['officer_address'];?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="about" class="col-sm-2 col-form-label">About</label>
                                            <div class="col-sm-10">
                                                <textarea name="about" id="about" class="form-control" style="height: 100px"><?php echo $officer_details['about_text'];?></textarea>
                                            </div>`
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form><!-- End Profile Edit Form -->
                                </div>

                                <div class="tab-pane fade social-link-edit pt-3" id="social-link-edit">

                                    <!-- End Social Media Links Edit Form -->
                                    <form action="createOfficer.php" method="POST" action="socialLinks">
                                        <input type="hidden" name="action" value="socialLinks">
                                        <input type="hidden" name="id" id="id" value="<?php echo $officer_details['id'];?>">
                                        <input type="hidden" name="company_id" id="company_id" value="<?php echo $company_details['id'];?>">

                                        <div class="row mb-3">
                                            <label for="facebook_link" class="col-md-4 col-lg-3 col-form-label">Facebook URL</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="facebook_link" type="text" class="form-control" id="facebook_link" value="<?php echo $officer_details['facebook_link'];?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="instagram_link" class="col-md-4 col-lg-3 col-form-label">Instagram URL</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="instagram_link" type="text" class="form-control" id="instagram_link" value="<?php echo $officer_details['instagram_link'];?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="linkedin_link" class="col-md-4 col-lg-3 col-form-label">Linkedin URL</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="linkedin_link" type="text" class="form-control" id="linkedin_link" value="<?php echo $officer_details['linkedin_link'];?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="twitter_link" class="col-md-4 col-lg-3 col-form-label">Twitter URL</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="twitter_link" type="text" class="form-control" id="twitter_link" value="<?php echo $officer_details['twitter_link'];?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="youtube_link" class="col-md-4 col-lg-3 col-form-label">YouTube URL</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="youtube_link" type="text" class="form-control" id="youtube_link" value="<?php echo $officer_details['youtube_link'];?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="tiktok_link" class="col-md-4 col-lg-3 col-form-label">TikTok URL</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="tiktok_link" type="text" class="form-control" id="tiktok_link" value="<?php echo $officer_details['tiktok_link'];?>">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form><!-- End Social Media Links Edit Form -->
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
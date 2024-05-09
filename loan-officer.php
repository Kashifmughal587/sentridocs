<?php
    // Include your database connection file here
    include 'assets/db/db_connection.php';

    // Get the company_id from the URL
    if(isset($_GET['company_id'])){
        $company_slug = $_GET['company_id'];

        // Query to fetch company details based on company_slug
        $query = "SELECT * FROM companies WHERE company_slug = '$company_slug'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $company_details = $result->fetch_assoc();
            $company_id = $company_details['id'];
            $sql = "SELECT * FROM loan_officer WHERE company_id = '$company_id'";
            $result = $conn->query($sql);
            $officer_details = $result->fetch_assoc();
            if($officer_details <= 0) {
                session_start();

                if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 86400)) {
                    session_destroy();
                    echo '<script>window.location.href = "login.php";</script>';
                    exit();
                }

                if (isset($_SESSION['user_id'])) {
                    echo '<script>alert("Officer is not created yet, Please create it!");</script>';
                    echo '<script>window.location.href = "/account/user/createOfficer.php";</script>';
                    exit();
                }else{
                    echo '<script>alert("Officer not found!");</script>';
                    echo '<script>window.location.href = "https://sentridocs.com/";</script>';
                    exit();
                }
            }
        } else {
            echo '<script>alert("Company not found!");</script>';
            echo '<script>window.location.href = "https://sentridocs.com/";</script>';
        }

        $conn->close();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lead Generation Form</title>
    <?php 
        if(!empty($company_details['company_fav'])) {
            echo '<link rel="shortcut icon" href="/'.$company_details['company_fav'].'" type="image/x-icon">"';
        }else{
            echo '<link rel="shortcut icon" href="/assets/img/favicon.ico" type="image/x-icon">"';
        }
    ?>
    <link rel="shortcut icon" href="'$com'" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.2/css/intlTelInput.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/custom.css">
    <link rel="stylesheet" href="/assets/css/demo.css">

    <style>
        .social-icon {
            display: inline-block;
            width: 40px;
            height: 40px;
            line-height: 40px;
            text-align: center;
            border-radius: 50%;
            background-color: #f5f5f5;
            margin-right: 10px;
        }

            .social-icon i {
            font-size: 18px;
        }
    </style>
</head>

<body>
    <main>
        <article class="main">
            <section class="section">
                <header class="intro">
                    <?php 
                        if(!empty($company_details['company_logo'])) {
                            echo '<img src="/'.$company_details['company_logo'].'" alt="Company Logo" style="max-width: 200px;">';
                        } else {
                            echo '<img src="/assets/img/logo-dark.png" alt="Company Logo" style="max-width: 200px;">';
                        }
                    ?>
                </header>
                <div>
                    <div style="text-align:center">
                        <h2>Welcome to the <span style="color:green">next chapter of your story!</span></h2>
                        <h3>You're one step closer to purchasing a home with your new Mortgage Loan Officer.</h3>
                        <p>Select an option below to find out what you qualify for now!</p>
                    </div>
                    
                </div>

                <div style="background-color: #f8f9fa; padding: 50px;">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-md-4 text-center">
                                <?php 
                                    if(!empty($officer_details['profile_photo'])) {
                                        echo '<img src="/'.$officer_details['profile_photo'].'" alt="Officer Profile" style="max-width: 200px; max-height: 300px">';
                                    } else {
                                        echo '<img src="/assets/img/user.png" alt="Officer Profile" style="max-width: 200px;">';
                                    }
                                ?>
                            </div>
                            <div class="col-md-8">
                                <div>
                                    <h1><?php echo $officer_details['officer_name'] ?></h1>
                                    <?php 
                                        if(!empty($officer_details['profile_photo'])) {
                                            
                                        }else{

                                        }
                                    ?>
                                    <h3 style="margin-left:15px;"><?php if(!empty($officer_details['job_title'])) { echo $officer_details['job_title']." | "; }?> Mortgage Loan Officer</h3>
                                    <h3 style="margin-left:15px;">NMLS # <?php echo $officer_details['officer_nmls'] ?> <?php if (!empty($officer_details['experience'])){echo "| " . $officer_details['experience'] . " years of experience"; }?></h3>
                                    <?php if(!empty($officer_details['about_text'])) { echo "<p class='card-text'>" . $officer_details['about_text']."</p>"; }?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="addresList">
                                        <div class="addTxt" style="display: flex; align-items: center;">
                                            <i class="bi bi-telephone" aria-hidden="true" style="margin-right: 10px; font-size: 24px;"></i>
                                            <h2 style="margin-right: 5px;">Call or Text</h2>
                                        </div>
                                        <h3 class="addSeprate" id="callOrText">
                                        <?php
                                            if(!empty($officer_details['contact'])){
                                        ?>
                                            <a href="tel:<?php echo $officer_details['contact'] ?>"> 
                                                <span>M: <?php echo $officer_details['contact'] ?></span>
                                            </a>
                                        <?php
                                            }else{
                                                echo '<p>Contact information not available</p>';
                                            }
                                            ?>
                                        </h3>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="addresList">
                                        <div class="addTxt" style="display: flex; align-items: center;">
                                            <i class="bi bi-calendar-check" aria-hidden="true" style="margin-right: 10px; font-size: 24px;"></i>
                                            <h2 style="margin-right: 5px;">Schedule a Time</h2>
                                        </div>
                                        <?php
                                            $calendly_link = $officer_details['calendly_link'];

                                            if (strpos($calendly_link, 'http://') !== 0 && strpos($calendly_link, 'https://') !== 0) {
                                                $calendly_link = 'https://' . $calendly_link;
                                            }
                                            ?>

                                            <h3><a data-href="section1.agentDetail.scheduleTime.link" data-text="section1.agentDetail.scheduleTime.text" target="_blank" href="<?php echo $calendly_link ?>"><?php echo $calendly_link ?></a></h3>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="addresList">
                                        <div class="addTxt" style="display: flex; align-items: center;">
                                            <i class="bi bi-globe" aria-hidden="true" style="margin-right: 10px; font-size: 24px;"></i>
                                            <h2 style="margin-right: 5px;">My Website</h2>
                                        </div>
                                        <h3><a data-href="section1.agentDetail.myWebsite.link" data-text="section1.agentDetail.myWebsite.text" target="_blank" href="<?php echo $officer_details['website'] ?>"><?php echo $officer_details['website'] ?></a></h3>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="addresList">
                                        <div class="addTxt" style="display: flex; align-items: center;">
                                            <i class="bi bi-geo" aria-hidden="true" style="margin-right: 10px; font-size: 24px;"></i>
                                            <h2 style="margin-right: 5px;">Address</h2>
                                        </div>
                                        <h3 data-html="section1.agentDetail.address.text"><?php echo $officer_details['officer_address'] ?></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-text" style="display: flex; align-items: center; background-color: #ccc; border: 2px solid #ccc; border-radius: 10px; padding: 10px;">
                                <img src="https://images.lp-images1.com/images1/1/17344/pics/17344_313_1_9_120_126_137_1_1688998689_response.png" alt="" class="fr-fil fr-dib" style="margin-right: 10px;">
                                <h3 data-html="section1.agentDetail.response" style="margin: 0;"><?php echo $officer_details['officer_name'] ?> usually responds within  <span>5 mins</span></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="credit text-start">
                    <hr>
                    <div id="accessibilityTabs">
                        <div class="accessibilityTab" style="display: inline;">
                            <a href="#">Accessibility</a>
                        </div>
                        <div class="accessibilityTab" style="display: inline; padding: 0 5px;">
                            <span>|</span>
                        </div>
                        <div class="accessibilityTab" style="display: inline;">
                            <a href="#">Licensing</a>
                        </div>
                        <div class="accessibilityTab" style="display: inline; padding: 0 5px;">
                            <span>|</span>
                        </div>
                        <div class="accessibilityTab" style="display: inline;">
                            <a href="#">Notice to Vendors</a>
                        </div>
                        <div class="accessibilityTab" style="display: inline; padding: 0 5px;">
                            <span>|</span>
                        </div>
                        <div class="accessibilityTab" style="display: inline;">
                            <a href="http://crush-demo-lo.leadpops.com/privacy-policy/">Privacy Policies</a>
                        </div>
                        <div class="accessibilityTab" style="display: inline; padding: 0 5px;">
                            <span>|</span>
                        </div>
                        <div class="accessibilityTab" style="display: inline;">
                            <a href="#">SMS Terms</a>
                        </div>
                        <div class="accessibilityTab" style="display: inline; padding: 0 5px;">
                            <span>|</span>
                        </div>
                        <div class="accessibilityTab" style="display: inline;">
                            <a href="#">Terms of Use</a>
                        </div>
                        <div class="accessibilityTab" style="display: inline; padding: 0 5px;">
                            <span>|</span>
                        </div>
                        <div class="accessibilityTab" style="display: inline;">
                            <a href="#">NMLS Consumer Access</a>
                        </div>
                    </div>
                    <div class="row">
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
                    <hr>
                    <?php 
                        if(!empty($company_details['company_logo'])) {
                            echo '<img src="/'.$company_details['company_logo'].'" alt="Company Logo" style="max-width: 200px;">';
                        } else {
                            echo '<img src="/assets/img/logo-dark.png" alt="Company Logo" style="max-width: 200px;">';
                        }
                    ?>
                    <br>
                    <br>
                    <h5><span><?php echo $company_details['company_name']?>.</span> ALL RIGHTS RESERVED</h5>
                    <p class="p-0"><strong>NMLS # </strong><?php echo $company_details['company_nmls']?>
                    <p class="p-0"><?php echo $company_details['company_address']?>
                    <hr>
                    <h5 class="fw-medium">COMPANY DETAILS</h5>
                    <p class="p-0"><?php echo $company_details['company_description']?>
                    </p>
                </footer>
            </section>
        </article>
    </main>

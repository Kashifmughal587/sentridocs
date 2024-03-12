<?php

    session_start();
    require('../../assets/db/db_connection.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastName'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<script>alert("Username already exists. Please choose a different username.");</script>';
        } else {
            $insert_sql = "INSERT INTO users (firstname, lastname, email, username, password) VALUES ('$firstname', '$lastname', '$email', '$username', '$hashed_password')";
            if ($conn->query($insert_sql) === TRUE) {
                $_SESSION['user_id'] = $conn->insert_id;
                $_SESSION['user_username'] = $username;
                $_SESSION['user_fullname'] = $row['firstname'] . ' ' . $row['lastname'];
                $_SESSION['user_email'] = $row['email'];
                $_SESSION['last_activity'] = time();
                // Activity Log
                $user_id = $conn->insert_id;
                $activity_type = 'USER';
                $activity_description = 'New registration with username, '. $username;
                $ip_address = $_SERVER['REMOTE_ADDR'];
                $device_info = $_SERVER['HTTP_USER_AGENT'];
                log_activity($user_id, $activity_type, $activity_description, $ip_address, $device_info);
                // Activity Log
                header('Location: profile.php');
                exit();
            } else {
                echo '<script>alert("Error: Unable to register user.");</script>';
            }
        }

        $conn->close();
    }
?>


<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title>Register</title>
        <meta content="" name="description">
        <meta content="" name="keywords">

        <!-- Favicons -->
        <link href="../../img/favicon.ico" rel="icon">
        <link href="../../img/favicon.ico" rel="apple-touch-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="../../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="../../assets/vendor/quill/quill.snow.css" rel="stylesheet">
        <link href="../../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
        <link href="../../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
        <link href="../../assets/vendor/simple-datatables/style.css" rel="stylesheet">

        <link href="../../assets/css/style1.css" rel="stylesheet">
    </head>

    <body>
        <main>
            <div class="container">
                <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                                <div class="d-flex justify-content-center py-4">
                                    <a href="../../index.html" class="logo d-flex align-items-center w-auto">
                                        <img src="../../img/logo-dark.png" alt="">
                                        <!-- <span class="d-none d-lg-block">Sentri Docs</span> -->
                                    </a>
                                </div><!-- End Logo -->

                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="pt-4 pb-2">
                                            <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                                            <p class="text-center small">Enter your personal details to create account</p>
                                        </div>

                                        <form method="POST" action="register.php" class="row g-3 needs-validation" onsubmit="return validateForm()">
                                            <div class="col-12">
                                                <label for="firstname" class="form-label">First Name</label>
                                                <input type="text" name="firstname" class="form-control" id="firstname" required>
                                                <div class="invalid-feedback" id="firstnameerror" >Please, enter your firstname!</div>
                                            </div>

                                            <div class="col-12">
                                                <label for="lastname" class="form-label">Last Name</label>
                                                <input type="text" name="lastName" class="form-control" id="lastname" required>
                                                <div class="invalid-feedback" id="lastnameerror" >Please, enter your lastname!</div>
                                            </div>

                                            <div class="col-12">
                                                <label for="email" class="form-label">Your Email</label>
                                                <input type="email" name="email" class="form-control" id="email" required>
                                                <div class="invalid-feedback" id="emailerror">Please enter a valid Email adddress!</div>
                                            </div>

                                            <div class="col-12">
                                                <label for="username" class="form-label">Username</label>
                                                <div class="input-group has-validation">
                                                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                    <input type="text" name="username" class="form-control" id="username" required>
                                                    <div class="invalid-feedback" id="usernameerror">Please choose a username.</div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label for="password" class="form-label">Password</label>
                                                <input type="password" name="password" class="form-control" id="password" required>
                                                <div class="invalid-feedback" id="passworderror">Please enter your password!</div>
                                            </div>

                                            <div class="col-12">
                                                <label for="confirmpassword" class="form-label">Confirm Password</label>
                                                <input type="password" name="confirmpassword" class="form-control" id="confirmpassword" required>
                                                <div class="invalid-feedback" id="confirmpassworderror">Please enter your password!</div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                                                    <label class="form-check-label" for="acceptTerms">I agree and accept the <a href="#">terms and conditions</a></label>
                                                    <div class="invalid-feedback">You must agree before submitting.</div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button class="btn btn-primary w-100" type="submit">Create Account</button>
                                            </div>
                                            <div class="col-12">
                                                <p class="small mb-0">Already have an account? <a href="login.php">Log in</a></p>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="credits">
                                    <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </main><!-- End #main -->

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        <!-- Vendor JS Files -->
        <script src="../../assets/vendor/apexcharts/apexcharts.min.js"></script>
        <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../../assets/vendor/chart.js/chart.umd.js"></script>
        <script src="../../assets/vendor/echarts/echarts.min.js"></script>
        <script src="../../assets/vendor/quill/quill.min.js"></script>
        <script src="../../assets/vendor/simple-datatables/simple-datatables.js"></script>
        <script src="../../assets/vendor/tinymce/tinymce.min.js"></script>
        <script src="../../assets/vendor/php-email-form/validate.js"></script>

        <!-- Template Main JS File -->
        <script src="../../assets/js/main1.js"></script>
        <script src="../../assets/js/custom1.js"></script>

    </body>

</html>
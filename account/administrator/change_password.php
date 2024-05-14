<?php

    include 'include.php';

    $admin_id = $_SESSION['admin_id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'changePassword') {
        $currentPassword = $conn->real_escape_string($_POST['currentPassword']);
        $newPassword = $conn->real_escape_string($_POST['newPassword']);
        $renewPassword = $conn->real_escape_string($_POST['renewPassword']);
    
        if ($newPassword !== $renewPassword) {
            echo '<script>alert("New passwords do not match!");</script>';
        } else {
            $sql = "SELECT password FROM admins WHERE id = '$admin_id'";
            $result = $conn->query($sql);
    
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $hashedPassword = $row['password'];
                // $hashedCurrentPassword = password_hash($currentPassword, PASSWORD_DEFAULT);
                if (password_verify($currentPassword, $hashedPassword)) {
                    $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    
                    $updateQuery = "UPDATE admins SET password = '$hashedNewPassword' WHERE id = '$admin_id'";
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

?>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Change Password</h1>
            <nav>
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Change Password</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div>
                    <div class="card col-12" style="padding: 25px;">
                        <form method="POST" action="change_password.php">
                            <input type="hidden" name="action" value="changePassword">
                            <input type="hidden" name="admin_id" value="<?php echo $user_id ?>">
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
        </section>
    </main><!-- End #main -->
<?php
include 'footer.php';
?>
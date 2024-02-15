<?php
    require('../../assets/db/db_connection.php');

    session_start();

    if (!isset($_SESSION['admin_id'])) {
        echo '<script>window.location.href = "login.php";</script>';
        exit();
    }

    include 'header.php';
    include 'sidebar.php';

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
            }
        } else {
            echo '<script>alert("Company not found.")</script>';
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
                            </table>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Company Description</h5>
                            <?php echo $company_details["company_description"]; ?>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Profile</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Contact</button>
                                </li>
                            </ul>
                            <div class="tab-content pt-2" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                Nesciunt totam et. Consequuntur magnam aliquid eos nulla dolor iure eos quia. Accusantium distinctio omnis et atque fugiat. Itaque doloremque aliquid sint quasi quia distinctio similique. Voluptate nihil recusandae mollitia dolores. Ut laboriosam voluptatum dicta.
                                </div>
                                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                Saepe animi et soluta ad odit soluta sunt. Nihil quos omnis animi debitis cumque. Accusantium quibusdam perspiciatis qui qui omnis magnam. Officiis accusamus impedit molestias nostrum veniam. Qui amet ipsum iure. Dignissimos fuga tempore dolor.
                                </div>
                            </div><!-- End Default Tabs -->
                        </div>
                        <div class="card-footer">
                            <?php
                                if($company_details['status'] == 'active'){
                                    echo "<span class='badge bg-success'><i class='bi bi-check-circle me-1'></i>Active</span> / <span class='badge bg-light text-dark'><i class='bi bi-info-circle me-1'></i> In Active</span>";
                                }else{
                                    echo "<span class='badge bg-light text-dark'><i class='bi bi-info-circle me-1'></i>Active</span> / <span class='badge bg-success'><i class='bi bi-check-circle me-1'></i>In Active</span>";
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
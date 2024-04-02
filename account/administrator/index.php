<?php

    include 'include.php';

    $query1 = "SELECT COUNT(*) AS companies_registered FROM companies WHERE status = 'active'";
    $result1 = $conn->query($query1);
    $row1 = $result1->fetch_assoc();
    $companies_registered = $row1['companies_registered'];

    $query2 = "SELECT COUNT(*) AS form_submissions_this_month FROM mortgage_leads WHERE MONTH(lead_date) = MONTH(CURDATE()) AND YEAR(lead_date) = YEAR(CURDATE())";
    $result2 = $conn->query($query2);
    $row2 = $result2->fetch_assoc();
    $form_submissions_this_month = $row2['form_submissions_this_month'];

    $query3 = "SELECT COUNT(*) AS users_registered_this_year FROM users WHERE YEAR(created_at) = YEAR(CURDATE())";
    $result3 = $conn->query($query3);
    $row3 = $result3->fetch_assoc();
    $users_registered_this_year = $row3['users_registered_this_year'];
    ?>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <!-- Left side columns -->
                <div class="col-lg-8">
                    <div class="row">

                        <!-- Sales Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card sales-card">

                                <div class="card-body">
                                    <h5 class="card-title">Companies <span>| Active</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-cart"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6><?php echo $companies_registered ?></h6>
                                        <!-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Sales Card -->

                        <!-- Revenue Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card revenue-card">
                                <div class="card-body">
                                    <h5 class="card-title">Mortgage Form <span>| Submissions</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-currency-dollar"></i>
                                        </div>
                                        <div class="ps-3">
                                        <h6><?php echo $form_submissions_this_month ?></h6>
                                        <!-- <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Revenue Card -->

                        <!-- Customers Card -->
                        <div class="col-xxl-4 col-xl-12">
                            <div class="card info-card customers-card">
                                <div class="card-body">
                                    <h5 class="card-title">Customers <span>| This Year</span></h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6><?php echo $users_registered_this_year ?></h6>
                                            <!-- <span class="text-danger small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">decrease</span> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Customers Card -->
                    </div>
                </div><!-- End Left side columns -->

                <!-- Right side columns -->
                <div class="col-lg-4">

                    <!-- Recent Activity -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Recent Activity <span>| Today</span></h5>
                            <div class="activity">
                                <?php
                                    $query4 = "SELECT TIMESTAMPDIFF(MINUTE, activity_date, NOW()) AS time_elapsed, activity_description FROM activity_log WHERE DATE(activity_date) = CURDATE() ORDER BY activity_date DESC LIMIT 20";
                                    $result4 = $conn->query($query4);
                                    if ($result4->num_rows > 0) {
                                        while ($row = $result4->fetch_assoc()) {
                                            ?>
                                                <div class="activity-item d-flex">
                                                    <div class="activite-label">
                                                        <?php 
                                                        $time_elapsed = $row['time_elapsed'];
                                                        if ($time_elapsed >= 60) {
                                                            $hours = floor($time_elapsed / 60);
                                                            $minutes = $time_elapsed % 60;
                                                            if ($hours >= 24) {
                                                                $days = floor($hours / 24);
                                                                $hours = $hours % 24;
                                                                echo $days . " days ";
                                                            }
                                                            echo $hours . " hrs ";
                                                            if ($minutes > 0) {
                                                                echo $minutes . " min";
                                                            }
                                                        } else {
                                                            echo $time_elapsed . " min";
                                                        }
                                                        ?>
                                                    </div>
                                                    <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                                                    <div class="activity-content">
                                                        <?php echo $row['activity_description'];?>
                                                    </div>
                                                </div>
                                                <!-- End activity item-->
                                            <?php
                                        }
                                    }else{
                                        echo 'No activity found!';
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <!-- End Recent Activity -->
                </div><!-- End Right side columns -->
            </div>
        </section>
    </main><!-- End #main -->
<?php

include 'footer.php';
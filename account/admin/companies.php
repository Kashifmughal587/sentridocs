<?php

    include 'include.php';
    require_once '../../assets/functions.php';

    if (isset($_GET['user_id'])) {
        $user_id = $_GET['user_id'];

        $sql = "SELECT * FROM companies WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

    }else{
        $sql = "SELECT * FROM companies";
        $result = $conn->query($sql);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_entry'])) {
        $entry_id_to_delete = $_POST['delete_entry'];

        if (is_numeric($entry_id_to_delete)) {

            $delete_sql = "DELETE FROM companies WHERE id = $entry_id_to_delete";
            $conn->query($delete_sql);
            $_SESSION['last_activity'] = time();
            // Activity Log
            $admin_id = $_SESSION['admin_id'];
            $activity_type = 'COMPANY';
            $activity_description = 'Company with ID'. $entry_id_to_delete .' deleted by ' .$admin_id. '.';
            $ip_address = $_SERVER['REMOTE_ADDR'];
            $device_info = $_SERVER['HTTP_USER_AGENT'];
            log_activity($admin_id, $activity_type, $activity_description, $ip_address, $device_info);
            // Activity Log

            echo '<script>window.location.href = "companies.php";</script>';
            exit();
        }
    }
?>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Companies</h1>
            <nav>
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Companies</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Companies</h5>

                            <!-- Table with hoverable rows -->
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Company Name</th>
                                        <th scope="col">Company NMLS</th>
                                        <th scope="col">Company Email</th>
                                        <th scope="col">Request By</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $request_by = getUsername($conn, $row['user_id']);
                                            echo "<tr>
                                                    <td>{$row['id']}</td>
                                                    <td>{$row['company_name']}</td>
                                                    <td>{$row['company_nmls']}</td>
                                                    <td>{$row['company_email']}</td>
                                                    <td>$request_by</td>
                                                    <td>
                                                        <a href='company.php?id={$row['id']}' class='btn btn-info'>View</a>
                                                        <form method='post' style='display:inline;'>
                                                            <input type='hidden' name='delete_entry' value='{$row['id']}'>
                                                            <button class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this entry?\")'>Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='4'>No Company found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <!-- End Table with hoverable rows -->

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->
<?php
    include_once 'footer.php';
?>
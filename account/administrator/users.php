<?php

    include 'include.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_entry'])) {
        $entry_id_to_delete = $_POST['delete_entry'];

        if (is_numeric($entry_id_to_delete)) {

            $delete_sql = "DELETE FROM users WHERE id = $entry_id_to_delete";
            $conn->query($delete_sql);
            $_SESSION['last_activity'] = time();
            // Activity Log
            $admin_id = $_SESSION['admin_id'];
            $activity_type = 'USER';
            $activity_description = 'User with ID'. $entry_id_to_delete. ' deleted successfully.';
            $ip_address = $_SERVER['REMOTE_ADDR'];
            $device_info = $_SERVER['HTTP_USER_AGENT'];
            log_activity($admin_id, $activity_type, $activity_description, $ip_address, $device_info);
            // Activity Log

            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
        }
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['status_update'])) {

        $user_id = $_POST['user_id'];
        $action = $_POST['status_update'];
    
        if ($action === 'activate') {
            $sql = "UPDATE users SET status = 'active' WHERE id = ?";
        } elseif ($action === 'deactivate') {
            $sql = "UPDATE users SET status = 'inactive' WHERE id = ?";
        }
    
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->close();
        $_SESSION['last_activity'] = time();
    }

    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);
    
?>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Users</h1>
            <nav>
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Users</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Users</h5>

                            <!-- Table with hoverable rows -->
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Full Name</th>
                                        <th scope="col">Email Address</th>
                                        <th scope="col">NMLS Number</th>
                                        <th scope="col">Contact</th>
                                        <th scope="col">Company</th>
                                        <th scope="col">Status</th>
                                        <!-- <th>Action</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $id = $row['id'];
                                            $sql = "SELECT COUNT(*) as Total FROM companies WHERE user_id = '$id'";
                                            $result2 = $conn->query($sql);
                                            $company_count = $result2->fetch_assoc();
                                            
                                            echo "<tr>
                                                <td scope='row'>{$row['id']}</td>
                                                <td>{$row['username']}</td>
                                                <td>{$row['firstname']} {$row['lastname']}</td>
                                                <td><a href='mailto:{$row['email']}'>{$row['email']}</a></td>
                                                <td>{$row['nmls_number']}</td>
                                                <td>{$row['contact']}</td>";
                                            if($company_count['Total'] != '0') {
                                                echo "<td><a href='companies.php?user_id={$row['id']}' class='btn btn-info'>Company</a></td>";
                                            }else{
                                                echo "<td></td>";
                                            }
                                            echo "<td>
                                                    <form method='post' style='display:inline;'>
                                                        <input type='hidden' name='user_id' value='{$row['id']}'>";
                                                            if ($row['status'] === 'active') {
                                                                echo "<input type='hidden' name='status_update' value='deactivate'>
                                                                    <button type='submit' class='btn btn-danger'>Deactivate</button>";
                                                            } else {
                                                                echo "<input type='hidden' name='status_update' value='activate'>
                                                                    <button type='submit' class='btn btn-success'>Activate</button>";
                                                            }
                                                    echo "</form>
                                                </td>
                                            </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='4'>No entries found</td></tr>";
                                    }
                                    ?>
                                <!-- <tr>
                                    <th scope="row">1</th>
                                    <td>Brandon Jacob</td>
                                    <td>Designer</td>
                                    <td>28</td>
                                    <td>2016-05-25</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Bridie Kessler</td>
                                    <td>Developer</td>
                                    <td>35</td>
                                    <td>2014-12-05</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Ashleigh Langosh</td>
                                    <td>Finance</td>
                                    <td>45</td>
                                    <td>2011-08-12</td>
                                </tr>
                                <tr>
                                    <th scope="row">4</th>
                                    <td>Angus Grady</td>
                                    <td>HR</td>
                                    <td>34</td>
                                    <td>2012-06-11</td>
                                </tr>
                                <tr>
                                    <th scope="row">5</th>
                                    <td>Raheem Lehner</td>
                                    <td>Dynamic Division Officer</td>
                                    <td>47</td>
                                    <td>2011-04-19</td>
                                </tr> -->
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
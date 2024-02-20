<?php
    require('../../assets/db/db_connection.php');

    session_start();

    if (!isset($_SESSION['admin_id'])) {
        echo '<script>window.location.href = "login.php";</script>';
        exit();
    }

    include_once 'header.php';
    include_once 'sidebar.php';
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

            echo '<script>window.location.href = "companies.php";</script>';
            exit();
        }
    }
    // if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['status_update'])) {
    //     $user_id = $_POST['user_id'];
    //     $action = $_POST['status_update'];
    
    //     if ($action === 'activate') {
    //         $sql = "UPDATE users SET status = 'active' WHERE id = ?";
    //     } elseif ($action === 'deactivate') {
    //         $sql = "UPDATE users SET status = 'inactive' WHERE id = ?";
    //     }
    
    //     $stmt = $conn->prepare($sql);
    //     $stmt->bind_param("i", $user_id);
    //     $stmt->execute();
    //     $stmt->close();
    
    //     echo '<script>window.location.href = "companies.php";</script>';
    //     exit();
    // }
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
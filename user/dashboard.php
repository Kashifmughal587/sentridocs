<?php
require('../assets/db/db_connection.php');

session_start();

if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

$sql = "SELECT * FROM mortgage_leads";
$result = $conn->query($sql);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_entry'])) {
    $entry_id_to_delete = $_POST['delete_entry'];

    if (is_numeric($entry_id_to_delete)) {

        $delete_sql = "DELETE FROM mortgage_leads WHERE id = $entry_id_to_delete";
        $conn->query($delete_sql);

        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/css/custom.css">
    </head>
    <body>

        <div class="container-fluid">
            <div class="row">
                <!-- Sidebar -->
                <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                    <div class="sidebar-sticky">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) === 'dashboard.php' ? 'active' : ''; ?>" href="dashboard.php">
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) === 'request.php' ? 'active' : ''; ?>" href="request.php">
                                    Request
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) === 'logout.php' ? 'active' : ''; ?>" href="logout.php">
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>

                <!-- Page content -->
                <main role="main" class="col-md-10 ml-sm-auto col-lg-10 px-4">
                    <h2>Form Entries</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Full Name</th>
                                <th>Email Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                            <td>{$row['id']}</td>
                                            <td>{$row['full_name']}</td>
                                            <td>{$row['email_address']}</td>
                                            <td>
                                                <a href='view_entry.php?id={$row['id']}' class='btn btn-info'>View</a>
                                                <form method='post' style='display:inline;'>
                                                    <input type='hidden' name='delete_entry' value='{$row['id']}'>
                                                    <button class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this entry?\")'>Delete</button>
                                                </form>
                                            </td>
                                        </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='4'>No entries found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </main>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</html>

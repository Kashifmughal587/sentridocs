<?php
require('../assets/db/db_connection.php');

session_start();

if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

$sql = "SELECT * FROM companies";
$result = $conn->query($sql);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_entry'])) {
    $entry_id_to_delete = $_POST['delete_entry'];

    if (is_numeric($entry_id_to_delete)) {

        $delete_sql = "DELETE FROM companies WHERE id = $entry_id_to_delete";
        $conn->query($delete_sql);

        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }
}

$conn->close();
?>

<?php include 'header.php'; ?>
<!-- Page content -->
<main role="main" class="col-md-10 ml-sm-auto col-lg-10 px-4">
    <h2>Form Entries</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Company Name</th>
                <th>Company NMLS</th>
                <th>Company Email</th>
                <th>Request By</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['company_name']}</td>
                            <td>{$row['company_nmls']}</td>
                            <td>{$row['company_email']}</td>
                            <td>{$row['user_id']}</td>
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

<?php include 'footer.php'; ?>
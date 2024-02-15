<?php
require('../assets/db/db_connection.php');

session_start();

if (!isset($_SESSION['admin_id'])) {
    echo '<script>window.location.href = "login.php";</script>';
    exit();
}

$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_entry'])) {
    $entry_id_to_delete = $_POST['delete_entry'];

    if (is_numeric($entry_id_to_delete)) {

        $delete_sql = "DELETE FROM users WHERE id = $entry_id_to_delete";
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
                <th>Username</th>
                <th>Full Name</th>
                <th>Email Address</th>
                <th>Contact</th>
                <th>Companies</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['username']}</td>
                            <td>{$row['firstname']} {$row['lastname']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['contact']}</td>
                            <td><a href='companies.php?user_id={$row['id']}' class='btn btn-info'>Companies</a></td>
                            <td>
                                <a href='view_user.php?id={$row['id']}' class='btn btn-info'>View</a>
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
<?php
    require('../../assets/db/db_connection.php');

    session_start();

    if (!isset($_SESSION['admin_id'])) {
        echo '<script>window.location.href = "login.php";</script>';
        exit();
    }

    include 'header.php';
    include 'sidebar.php';

    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $entry_id = $_GET['id'];
    
        $sql = "SELECT * FROM mortgage_leads WHERE id = $entry_id";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            header('Location: dashboard.php');
            exit();
        }
    } else {
        header('Location: dashboard.php');
        exit();
    }
    
    function sanitizeInput($input)
    {
        return htmlspecialchars(trim($input));
    }

    $conn->close();
?>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Form Entries</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Mortage Form Entries</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <table class="table table-hover">
            <tbody>
                <?php foreach ($row as $key => $value): ?>
                    <tr>
                        <th><?php echo ucfirst(str_replace('_', ' ', $key)); ?></th>
                        <td><?php echo $value; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </main><!-- End #main -->
<?php
include 'footer.php';
?>
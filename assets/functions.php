<?php
    function getUsername($conn, $user_id) {

        $firstname = '';
        $lastname = '';
        $name = '';
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $stmt = $conn->prepare("SELECT firstname, lastname, CONCAT(firstname, ' ', lastname) as name FROM users WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->bind_result($firstname, $lastname, $name);
        $stmt->fetch();
        $stmt->close();
        return $name;
    }

?>
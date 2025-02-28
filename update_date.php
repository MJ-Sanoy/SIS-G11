<?php
include 'db_connect.php';

if (isset($_POST['id']) && isset($_POST['value'])) {
    $id = $_POST['id'];
    $value = $_POST['value'];

    try {
        $query = "UPDATE d SET date_delivered = ? WHERE date_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('si', $value, $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "success";
        } else {
            echo "failed";
        }
    } catch (mysqli_sql_exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid Request";
}
?>

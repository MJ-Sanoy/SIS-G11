<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $column = $_POST['column'];
    $value = $_POST['value'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("UPDATE strg SET $column = ? WHERE storage_id = ?");
    $stmt->bind_param("si", $value, $id);

    if ($stmt->execute()) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

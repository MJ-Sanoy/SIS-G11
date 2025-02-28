<?php
include 'db_connect.php';

if (isset($_POST['id']) && $_POST['value'] !== "") {
    $id = $_POST['id'];
    $size = $_POST['value'];

    $sql = "UPDATE p SET size = ? WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $size, $id);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "failed";
    }

    $stmt->close();
} else {
    echo "No Data Received";
}

$conn->close();
?>
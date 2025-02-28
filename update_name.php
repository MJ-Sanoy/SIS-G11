<?php
include 'db_connect.php';

function updateName($id, $value) {
    global $conn;
    $stmt = $conn->prepare("UPDATE p SET name = ? WHERE product_id = ?");
    $stmt->bind_param("si", $value, $id);
    return $stmt->execute() ? "success" : "Failed to Update Name";
}

if (isset($_POST['id'], $_POST['value'])) {
    echo updateName($_POST['id'], $_POST['value']);
}
$conn->close();
?>
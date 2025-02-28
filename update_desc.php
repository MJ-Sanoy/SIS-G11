<?php
include 'db_connect.php';

function updateDesc($id, $value) {
    global $conn;
    $stmt = $conn->prepare("UPDATE p SET p_desc = ? WHERE product_id = ?");
    $stmt->bind_param("si", $value, $id);
    return $stmt->execute() ? "success" : "Failed to Update Description";
}

if (isset($_POST['id'], $_POST['value'])) {
    echo updateDesc($_POST['id'], $_POST['value']);
}
$conn->close();
?>
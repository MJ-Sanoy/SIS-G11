<?php
include 'db_connect.php';

function updateClassification($id, $value) {
    global $conn;
    $stmt = $conn->prepare("UPDATE p SET classification_id = ? WHERE product_id = ?");
    if (!$stmt) {
        echo "Failed to prepare statement: " . $conn->error;
        return false;
    }

    $stmt->bind_param("ii", $value, $id);
    if ($stmt->execute()) {
        echo "success";
        return true;
    } else {
        echo "Failed to Update Classification: " . $stmt->error;
        return false;
    }
}

if (isset($_POST['id'], $_POST['value'])) {
    $id = intval($_POST['id']);
    $value = intval($_POST['value']);

    if (updateClassification($id, $value)) {
        echo "success";
    } else {
        echo "Failed to Update Data";
    }
}
$conn->close();
?>
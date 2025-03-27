<?php
include 'db_connect.php';

function updateStorage($id, $value) {
    global $conn;

    $stmt = $conn->prepare("UPDATE stck SET storage_id = ? WHERE stck_id = ?");
    if (!$stmt) {
        echo "Failed to prepare statement: " . $conn->error;
        return false;
    }

    $stmt->bind_param("ii", $value, $id);
    if ($stmt->execute()) {
        echo "success";
        return true;
    } else {
        echo "Failed to Update Storage: " . $stmt->error;
        return false;
    }
}

if (isset($_POST['id'], $_POST['value'])) {
    $id = intval($_POST['id']);
    $value = intval($_POST['value']);

    if (updateStorage($id, $value)) {
        echo "success";
    } else {
        echo "Failed to Update Data";
    }
}
$conn->close();
?>
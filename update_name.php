<?php
include 'db_connect.php';

function updateName($id, $value) {
    global $conn;
    echo "Received ID: $id, Column: name, Value: $value<br>"; // Debugging output

    // Check if the column exists in the table
    $stmt = $conn->prepare("UPDATE p SET name = ? WHERE product_id = ?");
    if (!$stmt) {
        echo "Failed to prepare statement: " . $conn->error;
        return false;
    }

    $stmt->bind_param("si", $value, $id);
    if ($stmt->execute()) {
        echo "success";
        return true;
    } else {
        echo "Failed to Update Name: " . $stmt->error;
        return false;
    }
}

if (isset($_POST['id'], $_POST['value'])) {
    $id = intval($_POST['id']);
    $value = trim($_POST['value']);

    if (empty($value)) {
        echo "Value cannot be empty";
    } else {
        if (updateName($id, $value)) {
            echo "success"; // Final success message
            exit();
        } else {
            echo "Failed to Update Data";
        }
    }
} else {
    echo "Invalid request";
}

$conn->close();
?>
<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $storage_id = $_POST['id'];

    // Check if the storage ID exists
    $check_sql = "SELECT * FROM strg WHERE storage_id = ?";
    $stmt_check = $conn->prepare($check_sql);
    $stmt_check->bind_param("i", $storage_id);
    $stmt_check->execute();
    $result = $stmt_check->get_result();

    if ($result->num_rows > 0) {
        // Delete the storage location
        $delete_sql = "DELETE FROM strg WHERE storage_id = ?";
        $stmt_delete = $conn->prepare($delete_sql);
        $stmt_delete->bind_param("i", $storage_id);

        if ($stmt_delete->execute()) {
            echo json_encode(["success" => true, "message" => "Storage location deleted successfully."]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to delete storage location."]);
        }

        $stmt_delete->close();
    } else {
        echo json_encode(["success" => false, "message" => "Storage location not found."]);
    }

    $stmt_check->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request."]);
}

$conn->close();
?>

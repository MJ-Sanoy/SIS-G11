<?php
include 'db_connect.php';

header('Content-Type: application/json'); 

if (isset($_POST['new_storage']) && !empty(trim($_POST['new_storage']))) {
    $newStorage = trim($_POST['new_storage']);

    $stmt = $conn->prepare("INSERT INTO strg (strg_location) VALUES (?)");
    $stmt->bind_param("s", $newStorage);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "id" => $stmt->insert_id, "name" => $newStorage]);
        exit; // Stop execution after JSON output
    } else {
        echo json_encode(["success" => false, "error" => "Database insert failed."]);
        exit;
    }
} else {
    echo json_encode(["success" => false, "error" => "Invalid input."]);
    exit;
}

$conn->close();
?>

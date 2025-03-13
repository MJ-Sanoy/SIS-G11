<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header('Content-Type: application/json'); // Ensure JSON response

    if (!isset($_POST['new_storage']) || empty(trim($_POST['new_storage']))) {
        echo json_encode(['error' => 'Storage location cannot be empty.']);
        exit;
    }

    $new_storage = trim($_POST['new_storage']);

    // Use prepared statement to prevent SQL injection
    $sql_insert = "INSERT INTO strg (strg_location) VALUES (?)";
    $stmt = $conn->prepare($sql_insert);

    if ($stmt) {
        $stmt->bind_param("s", $new_storage);

        if ($stmt->execute()) {
            echo json_encode(['id' => $stmt->insert_id]); // Return inserted ID
        } else {
            echo json_encode(['error' => 'Error inserting data: ' . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(['error' => 'SQL Prepare failed: ' . $conn->error]);
    }

    $conn->close();
}
?>

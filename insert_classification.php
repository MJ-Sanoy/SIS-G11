<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['new_classification'])) {
    $new_classification = $conn->real_escape_string($_POST['new_classification']);
    $sql_insert = "INSERT INTO c (c_name) VALUES ('$new_classification')";

    if ($conn->query($sql_insert) === TRUE) {
        $new_id = $conn->insert_id; // Get last inserted ID
        echo json_encode([
            "success" => true,
            "id" => $new_id,
            "name" => $new_classification
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "error" => $conn->error
        ]);
    }
}

$conn->close();
?>

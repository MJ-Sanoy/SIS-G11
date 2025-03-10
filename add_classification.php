<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_classification = $_POST['new_classification'];
    $sql_insert = "INSERT INTO c (c_name) VALUES ('$new_classification')";

    if ($conn->query($sql_insert) === TRUE) {
        echo json_encode(['id' => $conn->insert_id]);
    } else {
        echo json_encode(['error' => $conn->error]);
    }

    $conn->close();
}
?>
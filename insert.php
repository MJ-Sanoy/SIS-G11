<?php
include 'db_connect.php';

header('Content-Type: application/json');
error_reporting(0);
ob_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $p_desc = $_POST['p_desc'] ?? '';
    $classification_id = $_POST['classification_id'] ?? '';
    $storage_id = $_POST['storage_id'] ?? '';
    $num_stck = $_POST['num_stck'] ?? '';
    $size = $_POST['size'] ?? '';
    $date_delivered = $_POST['date_delivered'] ?? '';

    if (empty($name) || empty($p_desc) || empty($classification_id) || empty($storage_id) || empty($num_stck) || empty($size) || empty($date_delivered)) {
        echo json_encode(["error" => "All fields are required."]);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO p (name, p_desc, classification_id, size) VALUES (?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("ssis", $name, $p_desc, $classification_id, $size);
        if ($stmt->execute()) {
            $last_id = $stmt->insert_id;

            $stmt = $conn->prepare("INSERT INTO d (date_delivered) VALUES (?)");
            $stmt->bind_param("s", $date_delivered);
            $stmt->execute();
            $date_id = $stmt->insert_id;

            $stmt = $conn->prepare("INSERT INTO stck (product_id, storage_id, num_stck, date_id) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("iiii", $last_id, $storage_id, $num_stck, $date_id);
            $stmt->execute();

            $classification_name = getClassificationName($classification_id, $conn);
            $storage_location = getStorageLocation($storage_id, $conn);

            ob_end_clean();

            echo json_encode([
                "id" => $last_id,
                "name" => $name,
                "p_desc" => $p_desc,
                "classification_name" => $classification_name,
                "storage_location" => $storage_location,
                "num_stck" => $num_stck,
                "size" => $size,
                "date_delivered" => $date_delivered
            ]);
        } else {
            ob_end_clean();
            echo json_encode(["error" => "Database error: " . $stmt->error]);
        }
        $stmt->close();
    } else {
        ob_end_clean();
        echo json_encode(["error" => "Failed to prepare statement."]);
    }
}

function getClassificationName($id, $conn) {
    $query = $conn->prepare("SELECT c_name FROM c WHERE classification_id = ?");
    $query->bind_param("i", $id);
    $query->execute();
    $result = $query->get_result();
    $row = $result->fetch_assoc();
    return $row['c_name'] ?? 'Unknown';
}

function getStorageLocation($id, $conn) {
    $query = $conn->prepare("SELECT strg_location FROM strg WHERE storage_id = ?");
    $query->bind_param("i", $id);
    $query->execute();
    $result = $query->get_result();
    $row = $result->fetch_assoc();
    return $row['strg_location'] ?? 'Unknown';
}
?>

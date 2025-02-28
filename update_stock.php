<?php
include 'db_connect.php';

if (isset($_POST['id']) && $_POST['value'] !== "") {
    $id = $_POST['id'];
    $num_stck = $_POST['value'];

    $sql = "UPDATE stck SET num_stck = ? WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $num_stck, $id);

    if ($stmt->execute()) {
        echo "true"; // Only return true without any extra text
    } else {
        echo "false";
    }

    $stmt->close();
} else {
    echo "false";
}

$conn->close();
?>

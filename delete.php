<?php
    include 'db_connect.php';
    $product_id = $_GET['id'];

    $sql = "DELETE stck, d, strg, p 
            FROM p
            LEFT JOIN stck ON p.product_id = stck.product_id
            LEFT JOIN d ON stck.date_id = d.date_id
            LEFT JOIN strg ON stck.storage_id = strg.storage_id
            WHERE p.product_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Deleted successfully";
    } else {
        echo "Failed to delete";
    }
?>
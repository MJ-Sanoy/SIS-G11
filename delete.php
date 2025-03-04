<?php
if (isset($_GET['id'])) {
    include 'db_connect.php';
    $id = $_GET['id'];

    $conn->begin_transaction();

    try {
        // Step 1: Get related IDs first before deleting
        $stmt0 = $conn->prepare("SELECT date_id, storage_id FROM stck WHERE product_id = ?");
        $stmt0->bind_param("i", $id);
        $stmt0->execute();
        $result = $stmt0->get_result();

        $date_ids = [];
        $storage_ids = [];

        while ($row = $result->fetch_assoc()) {
            if ($row['date_id']) $date_ids[] = $row['date_id'];
            if ($row['storage_id']) $storage_ids[] = $row['storage_id'];
        }

        // Step 2: Delete from `d` table (if `date_id` exists)
        if (!empty($date_ids)) {
            $placeholders = implode(',', array_fill(0, count($date_ids), '?'));
            $stmt1 = $conn->prepare("DELETE FROM d WHERE date_id IN ($placeholders)");
            $stmt1->bind_param(str_repeat("i", count($date_ids)), ...$date_ids);
            $stmt1->execute();
        }

        // Step 3: Delete from `strg` table (if `storage_id` exists)
        if (!empty($storage_ids)) {
            $placeholders = implode(',', array_fill(0, count($storage_ids), '?'));
            $stmt2 = $conn->prepare("DELETE FROM strg WHERE storage_id IN ($placeholders)");
            $stmt2->bind_param(str_repeat("i", count($storage_ids)), ...$storage_ids);
            $stmt2->execute();
        }

        // Step 4: Delete from `stck` table
        $stmt3 = $conn->prepare("DELETE FROM stck WHERE product_id = ?");
        $stmt3->bind_param("i", $id);
        $stmt3->execute();

        // Step 5: Delete from `p` table
        $stmt5 = $conn->prepare("DELETE FROM p WHERE product_id = ?");
        $stmt5->bind_param("i", $id);
        $stmt5->execute();

        $conn->commit();
        echo "success";
        exit(); // Ensure no further output is sent
    } catch (Exception $e) {
        $conn->rollback();
        echo "fail";
        exit(); // Ensure no further output is sent
    }
}
?>
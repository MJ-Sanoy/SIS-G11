<?php
if (isset($_GET['id'])) {
    include 'db_connect.php';
    $id = $_GET['id'];

    $conn->begin_transaction();

    try {
        $stmt0 = $conn->prepare("SELECT date_id FROM stck WHERE product_id = ?");
        $stmt0->bind_param("i", $id);
        $stmt0->execute();
        $result = $stmt0->get_result();

        $date_ids = [];

        while ($row = $result->fetch_assoc()) {
            if ($row['date_id']) $date_ids[] = $row['date_id'];
        }

        if (!empty($date_ids)) {
            $placeholders = implode(',', array_fill(0, count($date_ids), '?'));
            $stmt1 = $conn->prepare("DELETE FROM d WHERE date_id IN ($placeholders)");
            $stmt1->bind_param(str_repeat("i", count($date_ids)), ...$date_ids);
            $stmt1->execute();
        }

        $stmt3 = $conn->prepare("DELETE FROM stck WHERE product_id = ?");
        $stmt3->bind_param("i", $id);
        $stmt3->execute();

        $stmt5 = $conn->prepare("DELETE FROM p WHERE product_id = ?");
        $stmt5->bind_param("i", $id);
        $stmt5->execute();

        $conn->commit();
        echo "success";
        exit(); 
    } catch (Exception $e) {
        $conn->rollback();
        echo "fail";
        exit();
    }
}
?>
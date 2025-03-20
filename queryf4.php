<?php
include 'db_connect.php';

$sql = "SELECT strg.strg_location AS Stock_Location, 
               c.c_name AS Classification, 
               stck.remarks AS Remarks
        FROM stck
        JOIN p ON stck.product_id = p.product_id
        JOIN c ON p.classification_id = c.classification_id
        JOIN strg ON stck.storage_id = strg.storage_id
        ORDER BY 
            CASE 
                WHEN stck.remarks = 'In stock' THEN 1 
                ELSE 2 
            END, 
            strg.strg_location ASC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table class='product-table'>
            <tr class='table-header'>
                <th class='table-heading'>Stock Location</th>
                <th class='table-heading'>Classification</th>
                <th class='table-heading'>Remarks</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr class='table-row'>
                <td class='table-cell'>{$row['Stock_Location']}</td>
                <td class='table-cell'>{$row['Classification']}</td>
                <td class='table-cell'>{$row['Remarks']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<div class='no-records'>No records found.</div>";
}

$conn->close();
?>

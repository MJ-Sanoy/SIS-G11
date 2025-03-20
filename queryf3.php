<?php
include 'db_connect.php';

$sql = "SELECT c.c_name AS Classification, 
               d.date_delivered AS Date_Delivered, 
               stck.num_stck AS Number_of_Stocks, 
               stck.remarks AS Remarks
        FROM stck
        JOIN p ON stck.product_id = p.product_id
        JOIN c ON p.classification_id = c.classification_id
        JOIN d ON stck.product_id = d.date_id";
 
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table class='product-table'>
            <tr class='table-header'>
                <th class='table-heading'>Classification</th>
                <th class='table-heading'>Date Delivered</th>
                <th class='table-heading'>Number of Stocks</th>
                <th class='table-heading'>Remarks</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr class='table-row'>
                <td class='table-cell'>{$row['Classification']}</td>
                <td class='table-cell'>{$row['Date_Delivered']}</td>
                <td class='table-cell'>{$row['Number_of_Stocks']}</td>
                <td class='table-cell'>{$row['Remarks']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<div class='no-records'>No records found.</div>";
}

$conn->close();
?>

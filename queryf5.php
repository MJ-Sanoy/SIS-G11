<?php
include 'db_connect.php';

$sql = "SELECT c.c_name AS Classification, 
               d.date_delivered AS Date
        FROM d
        JOIN p ON d.date_id = p.product_id
        JOIN c ON p.classification_id = c.classification_id
        ORDER BY c.c_name ASC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table class='product-table'>
            <tr class='table-header'>
                <th class='table-heading'>Classification</th>
                <th class='table-heading'>Date</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr class='table-row'>
                <td class='table-cell'>{$row['Classification']}</td>
                <td class='table-cell'>{$row['Date']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<div class='no-records'>No records found.</div>";
}

$conn->close();
?>

<?php
include 'db_connect.php';

$sql = "SELECT p.name AS Product_Name, p.p_desc AS Description, c.c_name AS Classification, strg.strg_location AS Stock_Location
        FROM p
        JOIN c ON p.classification_id = c.classification_id
        JOIN stck ON p.product_id = stck.product_id
        JOIN strg ON stck.storage_id = strg.storage_id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table class='product-table'>
            <thead>
                <tr class='table-header'>
                    <th class='table-heading'>Product Name</th>
                    <th class='table-heading'>Description</th>
                    <th class='table-heading'>Classification</th>
                    <th class='table-heading'>Stock Location</th>
                </tr>
            </thead>
            <tbody>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr class='table-row'>
                <td class='table-cell'>{$row['Product_Name']}</td>
                <td class='table-cell'>{$row['Description']}</td>
                <td class='table-cell'>{$row['Classification']}</td>
                <td class='table-cell'>{$row['Stock_Location']}</td>
              </tr>";
    }

    echo "</tbody></table>";
} else {
    echo "<p class='no-records'>No records found.</p>";
}

$conn->close();
?>

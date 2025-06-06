<script src="assets/js/table-sort.js"></script>
<script src="assets/js/q2func.js" defer></script>
<link rel="stylesheet" href="assets/css/q2func.css">
<?php
include 'db_connect.php';

$sql = "SELECT p.name AS Product_Name, 
               c.c_name AS Classification, 
               strg.strg_location AS Stock_Location, 
               SUM(stck.num_stck) AS Number_of_Stocks
        FROM p
        JOIN c ON p.classification_id = c.classification_id
        JOIN stck ON p.product_id = stck.product_id
        JOIN strg ON stck.storage_id = strg.storage_id
        GROUP BY p.name, c.c_name, strg.strg_location
        ORDER BY p.product_id ASC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<div class='filter-container'>
            <input type='text' id='searchInput' placeholder='Search Product Name'>
            <select id='classificationFilter'>
                <option value=''>All</option>
            </select>
            <select id='storageFilter'>
                <option value=''>All</option>
            </select>
            <select id='stockFilter'>
                <option value=''>All Stocks</option>
                <option value='0'>0</option>
                <option value='32'>Less Than or Equal to 32</option>
                <option value='greater'>Greater Than 32</option>
            </select>
          </div>";

    echo "<table id='productTable' class='product-table'>
            <tr class='table-header'>
                <th class='table-heading'>Product Name</th>
                <th class='table-heading'>Classification</th>
                <th class='table-heading'>Stock Location</th>
                <th class='table-heading'>Number of Stocks</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr class='table-row'>
                <td class='table-cell'>{$row['Product_Name']}</td>
                <td class='table-cell'>{$row['Classification']}</td>
                <td class='table-cell'>{$row['Stock_Location']}</td>
                <td class='table-cell'>{$row['Number_of_Stocks']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<div class='no-records'>No records found.</div>";
}

$conn->close();
?>

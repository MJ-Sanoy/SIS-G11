<script src="assets/js/table-sort.js"></script>
<script src="assets/js/q4func.js" defer></script>
<link rel="stylesheet" href="assets/css/q4func.css">

<?php
include 'db_connect.php';

$sql = "SELECT stck.product_id AS ID, 
               strg.strg_location AS Stock_Location, 
               c.c_name AS Classification, 
               stck.remarks AS Remarks
        FROM stck
        JOIN p ON stck.product_id = p.product_id
        JOIN c ON p.classification_id = c.classification_id
        JOIN strg ON stck.storage_id = strg.storage_id
        ORDER BY stck.product_id ASC";

$result = $conn->query($sql);

$remarksOptions = ['No available stock', 'In stock', 'Low stock'];
$stockLocations = [];
$classifications = [];
$products = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
        if (!in_array($row['Stock_Location'], $stockLocations)) {
            $stockLocations[] = $row['Stock_Location'];
        }
        if (!in_array($row['Classification'], $classifications)) {
            $classifications[] = $row['Classification'];
        }
    }
}
?>

<!-- Filter Section -->
<div class="filter-container">
    <select id="stockLocationFilter">
        <option value="">All Stock Locations</option>
        <?php foreach ($stockLocations as $location) {
            echo "<option value='$location'>$location</option>";
        } ?>
    </select>
    <select id="classificationFilter">
        <option value="">All Classifications</option>
        <?php foreach ($classifications as $classification) {
            echo "<option value='$classification'>$classification</option>";
        } ?>
    </select>
    <select id="remarksFilter">
        <option value="">All Remarks</option>
        <?php foreach ($remarksOptions as $remark) {
            echo "<option value='$remark'>$remark</option>";
        } ?>
    </select>
</div>

<?php
if (!empty($products)) {
    echo "<table id='productTable' class='product-table'>
            <thead>
                <tr class='table-header'>
                    <th class='table-heading'>Stock Location</th>
                    <th class='table-heading'>Classification</th>
                    <th class='table-heading'>Remarks</th>
                </tr>
            </thead>
            <tbody>";

    foreach ($products as $product) {
        echo "<tr class='table-row'>
                <td class='table-cell'>{$product['Stock_Location']}</td>
                <td class='table-cell'>{$product['Classification']}</td>
                <td class='table-cell'>{$product['Remarks']}</td>
              </tr>";
    }

    echo "</tbody></table>";
} else {
    echo "<div class='no-records'>No records found.</div>";
}

$conn->close();
?>
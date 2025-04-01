<script src="table-sort.js"></script>
<script src="q1func.js" defer></script>
<link rel="stylesheet" href="q1func.css">

<?php
include 'db_connect.php';

// Fetch products and their classifications
$sql = "SELECT DISTINCT c.c_name AS Classification, p.name AS Product_Name, p.p_desc AS Description, strg.strg_location AS Stock_Location
        FROM p
        JOIN c ON p.classification_id = c.classification_id
        JOIN stck ON p.product_id = stck.product_id
        JOIN strg ON stck.storage_id = strg.storage_id
        ORDER BY p.product_id ASC";

$result = $conn->query($sql);

$classifications = [];
$products = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
        if (!in_array($row['Classification'], $classifications)) {
            $classifications[] = $row['Classification'];
        }
    }
}

?>

<!-- Search and Filter Section -->
<div class="filter-container">
    <input type="text" id="searchProduct" placeholder="Search Product Name">
    <input type="text" id="searchDescription" placeholder="Search Description">

    <select id="filterClassification">
        <option value="">All Classifications</option>
        <?php foreach ($classifications as $classification) {
            echo "<option value='$classification'>$classification</option>";
        } ?>
    </select>

    <select id="filterStock">
        <option value="">All Stock Locations</option>
        <?php
        $stockLocations = array_unique(array_column($products, 'Stock_Location'));
        foreach ($stockLocations as $location) {
            echo "<option value='$location'>$location</option>";
        }
        ?>
    </select>
</div>

<?php
if (!empty($products)) {
    echo "<table class='product-table' id='productTable'>
            <thead>
                <tr class='table-header'>
                    <th class='table-heading'>Product Name</th>
                    <th class='table-heading'>Description</th>
                    <th class='table-heading'>Classification</th>
                    <th class='table-heading'>Stock Location</th>
                </tr>
            </thead>
            <tbody>";

    foreach ($products as $product) {
        echo "<tr class='table-row'>
                <td class='table-cell'>{$product['Product_Name']}</td>
                <td class='table-cell'>{$product['Description']}</td>
                <td class='table-cell classification'>{$product['Classification']}</td>
                <td class='table-cell stock-location'>{$product['Stock_Location']}</td>
              </tr>";
    }

    echo "</tbody></table>";
} else {
    echo "<p class='no-records'>No records found.</p>";
}

$conn->close();
?>
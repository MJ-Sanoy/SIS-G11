<script src="table-sort.js"></script>
<script src="q1func.js" defer></script>
<link rel="stylesheet" href="q1func.css">

<?php
include 'db_connect.php';

// Fetch unique classifications and stock locations
$classifications = [];
$stockLocations = [];

// Get distinct classifications
$sql = "SELECT DISTINCT c.c_name AS Classification FROM c";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $classifications[] = $row['Classification'];
}

// Get distinct stock locations
$sql = "SELECT DISTINCT strg.strg_location AS Stock_Location FROM strg";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $stockLocations[] = $row['Stock_Location'];
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
        <?php foreach ($stockLocations as $location) {
            echo "<option value='$location'>$location</option>";
        } ?>
    </select>
</div>

<?php
// Fetch products
$sql = "SELECT p.name AS Product_Name, p.p_desc AS Description, c.c_name AS Classification, strg.strg_location AS Stock_Location
        FROM p
        JOIN c ON p.classification_id = c.classification_id
        JOIN stck ON p.product_id = stck.product_id
        JOIN strg ON stck.storage_id = strg.storage_id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
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

    while ($row = $result->fetch_assoc()) {
        echo "<tr class='table-row'>
                <td class='table-cell'>{$row['Product_Name']}</td>
                <td class='table-cell'>{$row['Description']}</td>
                <td class='table-cell classification'>{$row['Classification']}</td>
                <td class='table-cell stock-location'>{$row['Stock_Location']}</td>
              </tr>";
    }

    echo "</tbody></table>";
} else {
    echo "<p class='no-records'>No records found.</p>";
}

$conn->close();
?>

<script src="table-sort.js"></script>
<script src="q5func.js" defer></script>
<link rel="stylesheet" href="q5func.css">

<?php
include 'db_connect.php';

$sql = "SELECT c.c_name AS Classification, 
               d.date_delivered AS Date
        FROM d
        JOIN p ON d.date_id = p.product_id
        JOIN c ON p.classification_id = c.classification_id
        ORDER BY p.product_id ASC";

$result = $conn->query($sql);

$classifications = [];
$products = [];
$years = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;

        // Extract year from the date
        $year = date('Y', strtotime($row['Date']));
        if (!in_array($year, $years)) {
            $years[] = $year;
        }

        if (!in_array($row['Classification'], $classifications)) {
            $classifications[] = $row['Classification'];
        }
    }
}
echo "<div>
          <label class='l1' for='dateFilter'>Select Year and Month:</label> 
          <label class='l2' for='fullDateFilter'>Select Full Date:</label>
      </div>";
echo "<div class='filter-container'>
        <select id='classificationFilter'>
            <option value=''>All Classifications</option>";
foreach ($classifications as $classification) {
    echo "<option value='$classification'>$classification</option>";
}
echo "</select>
      <select id='yearFilter'>
          <option value=''>All Years</option>";
foreach ($years as $year) {
    echo "<option value='$year'>$year</option>";
}
echo "</select>
      <input type='month' id='dateFilter' placeholder='Select a month'>
      <input type='date' id='fullDateFilter'>
      </div>";

if (!empty($products)) {
    echo "<table id='productTable' class='product-table'>
            <thead>
                <tr class='table-header'>
                    <th class='table-heading'>Classification</th>
                    <th class='table-heading'>Date</th>
                </tr>
            </thead>
            <tbody>";

    foreach ($products as $product) {
        echo "<tr class='table-row'>
                <td class='table-cell'>{$product['Classification']}</td>
                <td class='table-cell'>{$product['Date']}</td>
              </tr>";
    }

    echo "</tbody></table>";
} else {
    echo "<div class='no-records'>No records found.</div>";
}

$conn->close();
?>
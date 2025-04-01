<script src="table-sort.js"></script>
<script src="q3func.js" defer></script>
<link rel="stylesheet" href="q3func.css">

<?php
include 'db_connect.php';

$sql = "SELECT c.c_name AS Classification, 
               DATE_FORMAT(d.date_delivered, '%Y-%m-%d') AS Date_Delivered, 
               stck.num_stck AS Number_of_Stocks, 
               stck.remarks AS Remarks
        FROM stck
        JOIN p ON stck.product_id = p.product_id
        JOIN c ON p.classification_id = c.classification_id
        JOIN d ON stck.product_id = d.date_id
        ORDER BY stck.product_id ASC";

$result = $conn->query($sql);

$classifications = [];
$remarksOptions = ['No available stock', 'In stock', 'Low stock'];
$products = [];
$years = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;

        // Extract year from the date
        $year = date('Y', strtotime($row['Date_Delivered']));
        if (!in_array($year, $years)) {
            $years[] = $year;
        }

        if (!in_array($row['Classification'], $classifications)) {
            $classifications[] = $row['Classification'];
        }
    }
}
?>

<?php
if (!empty($products)) {
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
          <input type='month' id='dateFilter' placeholder='yyyy-mm'>
          <input type='date' id='fullDateFilter' placeholder='yyyy-mm-dd'>
          <select id='stockFilter'>
              <option value=''>All Stocks</option>
              <option value='0'>0</option>
              <option value='32'>Less Than or Equal to 32</option>
              <option value='greater'>Greater Than 32</option>
          </select>
          <select id='remarksFilter'>
              <option value=''>All Remarks</option>";
    foreach ($remarksOptions as $remark) {
        echo "<option value='$remark'>$remark</option>";
    }
    echo "</select>
          </div>";

    echo "<table id='productTable' class='product-table'>
            <thead>
                <tr class='table-header'>
                    <th class='table-heading'>Classification</th>
                    <th class='table-heading'>Date Delivered</th>
                    <th class='table-heading'>Number of Stocks</th>
                    <th class='table-heading'>Remarks</th>
                </tr>
            </thead>
            <tbody>";

    foreach ($products as $product) {
        echo "<tr class='table-row'>
                <td class='table-cell'>{$product['Classification']}</td>
                <td class='table-cell'>{$product['Date_Delivered']}</td>
                <td class='table-cell'>{$product['Number_of_Stocks']}</td>
                <td class='table-cell'>{$product['Remarks']}</td>
              </tr>";
    }

    echo "</tbody></table>";
} else {
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
          <input type='month' id='dateFilter' placeholder='yyyy-mm'>
          <input type='date' id='fullDateFilter' placeholder='yyyy-mm-dd'>
          <select id='stockFilter'>
              <option value=''>All Stocks</option>
              <option value='0'>0</option>
              <option value='32'>Less Than or Equal to 32</option>
              <option value='greater'>Greater Than 32</option>
          </select>
          <select id='remarksFilter'>
              <option value=''>All Remarks</option>";
    foreach ($remarksOptions as $remark) {
        echo "<option value='$remark'>$remark</option>";
    }
    echo "</select>
          </div>";

    echo "<div class='no-records'>No records found.</div>";
}

$conn->close();

<title>Main Table</title>
<?php
include 'db_connect.php';

$classifications = [];
$classification_sql = "SELECT classification_id, c_name FROM c";
$classification_result = $conn->query($classification_sql);

if ($classification_result->num_rows > 0) {
    while ($classification_row = $classification_result->fetch_assoc()) {
        $classifications[] = $classification_row;
    }
}

$storage_locations = [];
$storage_sql = "SELECT storage_id, strg_location FROM strg";
$storage_result = $conn->query($storage_sql);

if ($storage_result->num_rows > 0) {
    while ($storage_row = $storage_result->fetch_assoc()) {
        $storage_locations[] = $storage_row;
    }
}

$sql = "SELECT 
            p.product_id,
            stck.stck_id,
            p.name AS product_name,
            p.p_desc,
            c.c_name AS classification,
            strg.strg_location,
            stck.num_stck,
            d.date_delivered,
            stck.remarks
        FROM p
        LEFT JOIN c ON p.classification_id = c.classification_id
        LEFT JOIN stck ON p.product_id = stck.product_id
        LEFT JOIN d ON stck.date_id = d.date_id
        LEFT JOIN strg ON stck.storage_id = strg.storage_id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<div class='table-scroll-wrapper'>
            <table id='dataTable' class='product-table' border='1'>
            <thead>
                <tr class='table-header'>
                    <th class='table-heading'>Product ID</th>
                    <th class='table-heading'>Product Name</th>
                    <th class='table-heading'>Description</th>
                    <th class='table-heading'>Classification</th>
                    <th class='table-heading'>Storage Location</th>
                    <th class='table-heading'>Stock Number</th>
                    <th class='table-heading'>Date Delivered</th>
                    <th class='table-heading'>Remarks</th>
                    <th class='table-heading'>Action</th>
                </tr>
            </thead>
            <tbody>";

    while($row = $result->fetch_assoc()) {
        $remarks = ($row['num_stck'] == 0) ? 'No available stock' : (($row['num_stck'] <= 32) ? 'Low stock' : 'In stock');
        echo "<tr class='table-row'>
                <td class='table-cell' style='font-weight: bold;'>" . $row["product_id"] . "</td>
                <td class='table-cell editable' contenteditable='true' data-id='" . $row['product_id'] . "' data-column='name'>" . $row["product_name"] . "</td>
                <td class='table-cell editable' contenteditable='true' data-id='" . $row['product_id'] . "' data-column='p_desc'>" . $row["p_desc"] . "</td>
                <td class='table-cell'>
                    <select class='editable-dropdown' data-id='" . $row['product_id'] . "' data-column='classification_id'>";
                        foreach ($classifications as $classification) {
                            $selected = ($row['classification'] == $classification['c_name']) ? 'selected' : '';
                            echo "<option value='" . $classification['classification_id'] . "' $selected>" . $classification['c_name'] . "</option>";
                        }
        echo        "</select>
                </td>
                <td class='table-cell'>
                    <select class='editable-dropdown' data-id='" . $row['stck_id'] . "' data-column='storage_id'>";
                        foreach ($storage_locations as $storage) {
                            $selected = ($row['strg_location'] == $storage['strg_location']) ? 'selected' : '';
                            echo "<option value='" . $storage['storage_id'] . "' $selected>" . $storage['strg_location'] . "</option>";
                        }
        echo        "</select>
                </td>
                <td class='table-cell editable' contenteditable='true' data-id='" . $row['stck_id'] . "' data-column='num_stck'>" . $row["num_stck"] . "</td>
                <td class='table-cell'>
                    <input type='date' class='editable' data-id='" . $row['product_id'] . "' data-column='date_delivered' value='" . $row['date_delivered'] . "' />
                </td>
                <td class='table-cell' style='font-weight: bold;'>" . $remarks . "</td>
                <td class='table-cell'>
                    <a href='delete.php?id={$row['product_id']}' class='btn btn-delete'>Delete</a>
                </td>
            </tr>";
    }

    echo "</tbody></table></div>";
} else {
    echo "No results found";
}

$conn->close();
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="assets/js/tablescript.js"></script>
<script src="assets/js/table-sortmain.js"></script>
<script src="assets/js/scroll.js"></script>
<script src="assets/js/scroll-table.js"></script>
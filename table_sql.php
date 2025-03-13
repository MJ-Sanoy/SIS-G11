<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
include 'db_connect.php';

// Fetch classifications from the 'c' table
$classifications = [];
$classification_sql = "SELECT classification_id, c_name FROM c";
$classification_result = $conn->query($classification_sql);

if ($classification_result->num_rows > 0) {
    while ($classification_row = $classification_result->fetch_assoc()) {
        $classifications[] = $classification_row;
    }
}

// Fetch storage locations from the 'strg' table
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
            p.size,
            d.date_delivered,
            stck.remarks
        FROM p
        LEFT JOIN c ON p.classification_id = c.classification_id
        LEFT JOIN stck ON p.product_id = stck.product_id
        LEFT JOIN d ON stck.date_id = d.date_id
        LEFT JOIN strg ON stck.storage_id = strg.storage_id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table id='dataTable' border='1'>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Description</th>
                <th>Classification</th>
                <th>Storage Location</th>
                <th>Stock Number</th>
                <th>Size</th>
                <th>Date Delivered</th>
                <th>Remarks</th>
                <th>Action</th>
            </tr>";

    while($row = $result->fetch_assoc()) {
        $remarks = ($row['num_stck'] == 0) ? 'No available stock' : (($row['num_stck'] <= 32) ? 'Low stock' : 'In stock');
        echo "<tr>
                <td style='font-weight: bold;'>" . $row["product_id"] . "</td>
                <td contenteditable='true' class='editable' data-id='" . $row['product_id'] . "' data-column='name'>" . $row["product_name"] . "</td>
                <td contenteditable='true' class='editable' data-id='" . $row['product_id'] . "' data-column='p_desc'>" . $row["p_desc"] . "</td>
                <td>
                    <select class='editable-dropdown' data-id='" . $row['product_id'] . "' data-column='classification_id'>";
                        foreach ($classifications as $classification) {
                            $selected = ($row['classification'] == $classification['c_name']) ? 'selected' : '';
                            echo "<option value='" . $classification['classification_id'] . "' $selected>" . $classification['c_name'] . "</option>";
                        }
        echo        "</select>
                </td>
                <td>
                    <select class='editable-dropdown' data-id='" . $row['stck_id'] . "' data-column='storage_id'>";
                        foreach ($storage_locations as $storage) {
                            $selected = ($row['strg_location'] == $storage['strg_location']) ? 'selected' : '';
                            echo "<option value='" . $storage['storage_id'] . "' $selected>" . $storage['strg_location'] . "</option>";
                        }
        echo        "</select>
                </td>
                <td contenteditable='true' class='editable' data-id='" . $row['stck_id'] . "' data-column='num_stck'>" . $row["num_stck"] . "</td>
                <td contenteditable='true' class='editable' data-id='" . $row['product_id'] . "' data-column='size'>" . $row["size"] . "</td>
                <td>
                    <input type='date' class='editable' data-id='" . $row['product_id'] . "' data-column='date_delivered' value='" . $row['date_delivered'] . "' />
                </td>
                <td style='font-weight: bold;'>" . $remarks . "</td>
                <td>
                    <a href='delete.php?id={$row['product_id']}' class='btn btn-delete'>Delete</a>
                </td>
            </tr>";
    }

    echo "</table>";
} else {
    echo "No results found";
}

$conn->close();
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="tablescript.js"></script>
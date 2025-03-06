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
?>

<form action="insert.php" method="POST" class = "insert-form">
    <table border="1">
        <tr>
            <th>Product Name</th>
            <th>Description</th>
            <th>Classification</th>
            <th>Storage Location</th>
            <th>Stock Number</th>
            <th>Size</th>
            <th>Date Delivered</th>
            <th>Action</th>
        <tr>
            <td><input type="text" name="name" required></td>
            <td><input type="text" name="p_desc" required></td>
            <td>
                <select name="classification_id" required>
                    <option value="">--Select--</option>
                    <?php
                    foreach ($classifications as $classification) {
                        echo "<option value='" . $classification['classification_id'] . "'>" . $classification['c_name'] . "</option>";
                    }
                    ?>
                </select>
            </td>
            <td>
                <select name="storage_id" required>
                    <option value="">--Select--</option>
                    <?php
                    foreach ($storage_locations as $storage) {
                        echo "<option value='" . $storage['storage_id'] . "'>" . $storage['strg_location'] . "</option>";
                    }
                    ?>
                </select>
            </td>
            <td><input type="number" name="num_stck" required></td>
            <td><input type="text" name="size" required></td>
            <td><input type="date" name="date_delivered" required></td>
            <td><button type="submit" name="submit">Insert</button></td>
        </tr>
    </table>
</form>
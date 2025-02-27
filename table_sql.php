<?php
include 'db_connect.php';
$sql = "SELECT 
            p.product_id,
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
        LEFT JOIN strg ON stck.storage_id = strg.storage_id;";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>
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
                <td>" . $row["product_id"] . "</td>
                <td contenteditable='true' class='editable' data-id='" . $row['product_id'] . "' data-column='name'>" . $row["product_name"] . "</td>
                <td contenteditable='true' class='editable' data-id='" . $row['product_id'] . "' data-column='p_desc'>" . $row["p_desc"] . "</td>
                <td>
                    <select class='editable-dropdown' data-id='" . $row['product_id'] . "' data-column='classification_id'>
                        <option value='1' " . ($row['classification'] == 'Chips' ? 'selected' : '') . ">Chips</option>
                        <option value='2' " . ($row['classification'] == 'Candies' ? 'selected' : '') . ">Candies</option>
                        <option value='3' " . ($row['classification'] == 'Drinks' ? 'selected' : '') . ">Drinks</option>
                        <option value='4' " . ($row['classification'] == 'Snacks' ? 'selected' : '') . ">Snacks</option>
                        <option value='5' " . ($row['classification'] == 'Noodles' ? 'selected' : '') . ">Noodles</option>
                        <option value='6' " . ($row['classification'] == 'Canned Goods' ? 'selected' : '') . ">Canned Goods</option>
                        <option value='7' " . ($row['classification'] == 'Condiments' ? 'selected' : '') . ">Condiments</option>
                        <option value='8' " . ($row['classification'] == 'Baking' ? 'selected' : '') . ">Baking</option>
                        <option value='9' " . ($row['classification'] == 'Spreads' ? 'selected' : '') . ">Spreads</option>
                        <option value='10' " . ($row['classification'] == 'Sauces' ? 'selected' : '') . ">Sauces</option>
                    </select>
                </td>
                <td>
                    <select class='editable-dropdown' data-id='" . $row['product_id'] . "' data-column='storage_id'>
                        <option value='1' " . ($row['strg_location'] == 'Storage A' ? 'selected' : '') . ">Storage A</option>
                        <option value='2' " . ($row['strg_location'] == 'Storage B' ? 'selected' : '') . ">Storage B</option>
                        <option value='3' " . ($row['strg_location'] == 'Storage C' ? 'selected' : '') . ">Storage C</option>
                    </select>
                </td>
                <td contenteditable='true' class='editable' data-id='" . $row['product_id'] . "' data-column='num_stck'>" . $row["num_stck"] . "</td>
                <td contenteditable='true' class='editable' data-id='" . $row['product_id'] . "' data-column='size'>" . $row["size"] . "</td>
                <td contenteditable='true' class='editable' data-id='" . $row['product_id'] . "' data-column='date_delivered'>" . $row["date_delivered"] . "</td>
                <td>" . $remarks . "</td>
                <td>
                    <a href='delete.php?id={$row['product_id']}' class='btn btn-delete' onclick='return confirm(\"Are you sure you want to delete this?\")'>Delete</a>
                </td>
            </tr>";
    }

    echo "</table>";
} else {
    echo "No results found";
}

$conn->close();
?>
<script src="tablescript.js"></script>

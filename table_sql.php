<?php
include 'db_connect.php';
$sql = "SELECT 
            p.product_id,
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
                        <th>Date Delivered</th>
                        <th>Remarks</th>
                        <th>Action</th>
                    </tr>";

            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["product_id"] . "</td>
                        <td>" . $row["product_name"] . "</td>
                        <td>" . $row["p_desc"] . "</td>
                        <td>" . $row["classification"] . "</td>
                        <td>" . $row["strg_location"] . "</td>
                        <td>" . $row["num_stck"] . "</td>
                        <td>" . $row["date_delivered"] . "</td>
                        <td>" . $row["remarks"] . "</td>
                        <td>
                            <a href='edit.php?id={$row['product_id']}' class='btn btn-edit'>Edit</a>
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
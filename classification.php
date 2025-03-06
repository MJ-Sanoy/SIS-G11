<link rel="stylesheet" href="css-main.css">
<link rel="stylesheet" href="css-table.css">
<div class="nav"><?php include 'navpan.php';?></div>
<?php
    include 'db_connect.php';
    $sql = 'SELECT * FROM c';

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>Classification ID</th>
                    <th>Classification Name</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['classification_id'] . "</td>
                    <td>" . $row['c_name'] . "</td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "No classifications found.";
    }

$conn->close();
?>
<?php include 'footer.php';?>
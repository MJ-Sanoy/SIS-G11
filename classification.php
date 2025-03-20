<link rel="stylesheet" href="css-main.css">
<link rel="stylesheet" href="css-table.css">
<link rel="stylesheet" href="css-classification.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<div class="nav"><?php include 'navpan.php';?></div>
    <style>
        #classification{
            background-color:rgba(76, 27, 101, 0.8);
        }
    </style>
        <div class='table-container'>
        <form id='addClassificationForm' method='POST'>
            <input type='text' name='new_classification' id='new_classification' placeholder='New Classification' required>
            <button type='submit'>ADD</button>
        </form>
        <table id='classificationTable' border='1'>
            <thead>
                <tr>
                    <th>Classification ID</th>
                    <th>Classification Name</th>
                    <th>Action</th>
                </tr>
            </thead>
<?php
include 'db_connect.php';

$sql = 'SELECT * FROM c ORDER BY classification_id';
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr data-id='" . $row['classification_id'] . "'>
                <td style='text-align: center; font-weight: bold;'>" . $row['classification_id'] . "</td>
                <td contenteditable='true' class='editable' data-column='c_name'>" . $row['c_name'] . "</td>
                <td><button class='delete-button' data-id='" . $row['classification_id'] . "'>Delete</button></td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='3'>No classifications found.</td></tr>";
}

echo "</tbody></table></div>";

$conn->close();
?>
<?php include 'footer.php';?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="insert_classification.js"></script>

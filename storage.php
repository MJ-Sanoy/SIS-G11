<link rel="stylesheet" href="assets/css/css-main.css">
<link rel="stylesheet" href="assets/css/css-storage.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<title>Storage</title>
<div class="nav"><?php include 'navpan.php';?></div>
<div class='table-container'>
    <form id='addStorageForm' method='POST'>
        <input type='text' name='new_storage' id='new_storage' placeholder='New Storage Location' required>
        <button type='submit'>ADD</button>
    </form>

    <table id='storageTable' border='1'>
        <thead>
            <tr>
                <th>Storage ID</th>
                <th>Storage Location</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        include 'db_connect.php';

        $sql = 'SELECT * FROM strg ORDER BY storage_id';
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr data-id='" . $row['storage_id'] . "'>
                        <td style='text-align: center; font-weight: bold;'>" . $row['storage_id'] . "</td>
                        <td contenteditable='true' class='editable' data-column='strg_location'>" . $row['strg_location'] . "</td>
                        <td><button class='delete-button' data-id='" . $row['storage_id'] . "'>Delete</button></td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No storage locations found.</td></tr>";
        }

        $conn->close();
        ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php';?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="assets/js/insert_storage.js"></script>
<script src="assets/js/update_stoname.js"></script>
<script src="assets/js/scroll.js"></script>

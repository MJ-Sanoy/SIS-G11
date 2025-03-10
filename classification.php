<link rel="stylesheet" href="css-main.css">
<link rel="stylesheet" href="css-table.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<div class="nav"><?php include 'navpan.php';?></div>
<?php
include 'db_connect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['new_classification'])) {
    $new_classification = $_POST['new_classification'];
    $sql_insert = "INSERT INTO c (c_name) VALUES ('$new_classification')";
    if ($conn->query($sql_insert) === TRUE) {
        echo "<script>
                $(document).ready(function() {
                    Swal.fire({
                        title: 'Success!',
                        text: 'New classification added successfully.',
                        icon: 'success',
                        customClass: {
                            popup: 'swal2-gray-popup'
                        }
                    }).then(() => {
                        var newRow = `<tr data-id='{$conn->insert_id}'>
                                        <td>{$conn->insert_id}</td>
                                        <td contenteditable='true' class='editable' data-column='c_name'>{$new_classification}</td>
                                        <td><button class='delete-button' data-id='{$conn->insert_id}'>Delete</button></td>
                                      </tr>`;
                        $('#classificationTable tbody').append(newRow);
                        $('#classificationTable tbody tr:last').hide().fadeIn(1000);
                    });
                });
              </script>";
    } else {
        echo "Error: " . $sql_insert . "<br>" . $conn->error;
    }
}

$sql = 'SELECT * FROM c ORDER BY classification_id';
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<div class='table-container'>
            <form id='addClassificationForm' method='POST'>
                <input type='text' name='new_classification' placeholder='New Classification' required>
                <button type='submit'>Add</button>
            </form>
            <table id='classificationTable' border='1'>
                <thead>
                    <tr>
                        <th>Classification ID</th>
                        <th>Classification Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr data-id='" . $row['classification_id'] . "'>
                <td>" . $row['classification_id'] . "</td>
                <td contenteditable='true' class='editable' data-column='c_name'>" . $row['c_name'] . "</td>
                <td><button class='delete-button' data-id='" . $row['classification_id'] . "'>Delete</button></td>
              </tr>";
    }
    echo "</tbody></table></div>";
} else {
    echo "No classifications found.";
}

$conn->close();
?>
<?php include 'footer.php';?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    // Handle contenteditable changes
    $('.editable').on('blur', function() {
        var id = $(this).closest('tr').data('id');
        var column = $(this).data('column');
        var value = $(this).text();

        $.ajax({
            url: 'update_classification_name.php',
            method: 'POST',
            data: {
                id: id,
                column: column,
                value: value
            },
            success: function(response) {
                console.log(response);
            }
        });
    });

    // Handle delete button click with SweetAlert2 confirmation
    $(document).on('click', '.delete-button', function() {
        var id = $(this).data('id');
        var row = $(this).closest('tr');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#F7A511',
            cancelButtonColor: '#744491',
            confirmButtonText: 'Yes, delete it!',
            customClass: {
                popup: 'swal2-gray-popup',
                icon: 'swal2-warning-icon'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'delete_classification.php',
                    method: 'POST',
                    data: { id: id },
                    success: function(response) {
                        console.log(response);
                        row.fadeOut(1000, function() {
                            $(this).remove();
                        });
                        Swal.fire({
                            title: 'Deleted!',
                            text: 'The classification has been deleted.',
                            icon: 'success',
                            customClass: {
                                popup: 'swal2-gray-popup'
                            }
                        });
                    }
                });
            }
        });
    });
});
</script>
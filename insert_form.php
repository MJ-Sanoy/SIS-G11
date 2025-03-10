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

<form id="insertForm" class="insert-form">
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
        </tr>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    $('#insertForm').on('submit', function(e) {
        e.preventDefault();
        var formData = $(this).serialize();

        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to add this data?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#F7A511',
            cancelButtonColor: '#744491',
            confirmButtonText: 'Yes, add it!',
            customClass: {
                popup: 'swal2-gray-popup',
                icon: 'swal2-warning-icon'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'insert.php',
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        var data = JSON.parse(response);
                        if (data.id) {
                            var newRow = `<tr data-id='${data.id}'>
                                            <td>${data.name}</td>
                                            <td>${data.p_desc}</td>
                                            <td>${data.classification_name}</td>
                                            <td>${data.storage_location}</td>
                                            <td>${data.num_stck}</td>
                                            <td>${data.size}</td>
                                            <td>${data.date_delivered}</td>
                                          </tr>`;
                            $('#dataTable tbody').append(newRow);
                            $('#dataTable tbody tr:last').hide().fadeIn(1000, function() {
                                $('html, body').animate({
                                    scrollTop: $(this).offset().top
                                }, 1000);
                            });
                            Swal.fire({
                                title: 'Added!',
                                text: 'The data has been added.',
                                icon: 'success',
                                customClass: {
                                    popup: 'swal2-gray-popup'
                                }
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'There was an error adding the data.',
                                icon: 'error',
                                customClass: {
                                    popup: 'swal2-gray-popup'
                                }
                            });
                        }
                    }
                });
            }
        });
    });
});
</script>
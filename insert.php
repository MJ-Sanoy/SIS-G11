<?php
include 'db_connect.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $p_desc = $_POST['p_desc'];
    $classification_id = $_POST['classification_id'];
    $storage_id = $_POST['storage_id'];
    $num_stck = $_POST['num_stck'];
    $size = $_POST['size'];
    $date_delivered = $_POST['date_delivered'];

    $insert_product = "INSERT INTO p (name, p_desc, classification_id, size) VALUES ('$name', '$p_desc', '$classification_id', '$size')";
    if ($conn->query($insert_product) === TRUE) {
        $last_id = $conn->insert_id;

        $insert_date = "INSERT INTO d (date_delivered) VALUES ('$date_delivered')";
        $conn->query($insert_date);
        $date_id = $conn->insert_id;

        $insert_stock = "INSERT INTO stck (product_id, num_stck, storage_id, date_id) VALUES ('$last_id', '$num_stck', '$storage_id', '$date_id')";
        $conn->query($insert_stock);

        echo "<script>
                Swal.fire('Success!', 'Product Inserted Successfully!', 'success').then(() => {
                    window.location.href = window.location.href;
                });
              </script>";
    } else {
        echo "<script>
                Swal.fire('Error!', 'Failed to Insert Product!', 'error');
              </script>";
    }
}
?>

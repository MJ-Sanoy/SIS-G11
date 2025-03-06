<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $product_name = $_POST['product-name'];
    $product_description = $_POST['product-description'];
    $classification_id = $_POST['product-classification'];
    $storage_id = $_POST['product-stock-location'];
    $product_quantity = $_POST['product-quantity'];
    $product_delivery_date = $_POST['product-delivery-date'];
    $size = $_POST['size']; // Get the size

    // Insert the data into the database
    $sql = "INSERT INTO p (name, p_desc, classification_id, size) VALUES ('$product_name', '$product_description', '$classification_id', '$size')";
    
    if ($conn->query($sql) === TRUE) {
        $product_id = $conn->insert_id;

        $sql_stock = "INSERT INTO stck (product_id, storage_id, num_stck, date_id) VALUES ('$product_id', '$storage_id', '$product_quantity', (SELECT date_id FROM d WHERE date_delivered = '$product_delivery_date'))";
        
        if ($conn->query($sql_stock) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql_stock . "<br>" . $conn->error;
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
<script>
    // Redirect back to the index page after insertion
    window.location.href = "index.php";
</script>
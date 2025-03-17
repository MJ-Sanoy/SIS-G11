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

<meta charset="UTF-8">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="nav"><?php include 'navpan.php'?></div>
<link rel="stylesheet" href="css-table.css">
<link rel="stylesheet" href="css-main-Home.css">
<link rel="stylesheet" href="css-main.css">
<style>
    #landingpage a{
        color: #1F1C2C;
        background-color: goldenrod;
    }
</style>
<div class="row">
    <div class="column-form">
        <form action="insert-front.php" method="POST">
            <div class="product-name">
                <label for="product-name">Product Name: </label>
                <input type="text" name="product-name" id="pname" required>
            </div>
            <div class="product-description">
                <label for="product-description">Product Description: </label>
                <input type="text" name="product-description" id="pdesc" required>
            </div>
            <div class="product-classification">
                <label for="product-classification">Product Classification: </label>
                <select name="product-classification" required>
                    <option value="">Select</option>
                    <?php
                    foreach ($classifications as $classification) {
                        echo "<option value='" . $classification['classification_id'] . "'>" . $classification['c_name'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="product-stock-location">
                <label for="product-stock-location">Product Stock Location: </label>
                <select name="product-stock-location" required>
                    <option value="">Select</option>
                    <?php
                    foreach ($storage_locations as $storage) {
                        echo "<option value='" . $storage['storage_id'] . "'>" . $storage['strg_location'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="product-quantity">
                <label for="product-quantity">Product Quantity: </label>
                <input type="number" name="product-quantity" required min="0" max="100">
            </div>
            <div class="product-size">
                <label for="size">Size: </label>
                <input type="text" name="size" required>
            </div>
            <div class="product-delivery-date">
                <label for="product-delivery-date">Delivery Date: </label><br>
                <input type="date" name="product-delivery-date" id="date" required placeholder="MM/DD/YYYY">
            </div>
            <div class="submit-button">
                <input type="submit" value="Submit">
            </div>
        </form>
    </div>
    <div class="column-table">
        <h1>Table Data Overview</h1>
        <?php include 'D:\xampp\htdocs\SIS-G11\table_sql.php'; ?>
    </div>
</div>
<?php include 'footer.php'; ?>
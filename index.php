<meta charset="UTF-8">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="nav"><?php include 'navpan.php'?></div>
<link rel="stylesheet" href="css-table.css">
<link rel="stylesheet" href="css-main.css">
<div class="row">
    <div class="column-form">
        <form action="inputdata.php" method="POST">
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
                    <option>Select</option>
                    <option value="1">Chips</option>
                    <option value="2">Candies</option>
                    <option value="3">Drinks</option>
                    <option value="4">Snacks</option>
                    <option value="5">Noodles</option>
                    <option value="6">Canned Goods</option>
                    <option value="7">Condiments</option>
                    <option value="8">Baking</option>
                    <option value="9">Spreads</option>
                    <option value="10">Sauces</option>
                </select>
            </div>
            <div class="product-stock-location">
                <label for="product-stock-location">Product Stock Location: </label>
                <select name="product-stock-location" required>
                    <option>Select</option>
                </select>
            </div>
            <div class="product-quantity">
                <label for="product-quantity">Product Quantity: </label>
                <input type="number" name="product-quantity" required min="0" max="100">
            </div>
            <div class="product-delivery-date">
                <label for="product-delivery-date">Delivery Date: </label><br>
                <input type="date" name="product-delivery-date" id="date" required placeholder="MM/DD/YYYY">
            </div>
            <div class="submit-button">
                <input type="Submit" value="Submit" a href="insert.php">
            </div>
        </form>
    </div>
    <div class="column-table">
        <h1>Table Data Overview</h1>
        <?php include 'D:\xampp\htdocs\SIS-G11\table_sql.php';?>
    </div>
</div>
<?php include 'footer.php';?>
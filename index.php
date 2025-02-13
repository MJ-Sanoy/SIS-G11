<div class="nav"><?php include 'navpan.php'?></div>

<link rel="stylesheet" href="css-main.css">
<div class="row">
    <div class="column-form">
        <form action="inputdata.php" method="POST">
            <div class="product-name">
                <label for="product-name">Product Name: </label>
                <input type="text" name="product-name" id="pname">
            </div>
            <div class="product-description">
                <label for="product-description">Product Description: </label>
                <input type="text" name="product-description" id="pdesc">
            </div>
            <div class="product-classification">
                <label for="product-classification">Product Classification: </label>
                <select name="product-classification">
                    <option>Select</option>
                </select>
            </div>
            <div class="product-stock-location">
                <label for="product-stock-location">Product Stock Location: </label>
                <select name="product-stock-locatio">
                    <option>Select</option>
                </select>
            </div>
            <div class="product-quantity">
                <label for="product-quantity">Product Quantity: </label>
                <input type="number" name="product-quantity">
            </div>
            <div class="product-delivery-date">
                <label for="product-delivery-date">Delivery Date: </label>
                <input type="date" name="product-delivery-date">
            </div>
            <div class="submit-button">
                <input type="Submit" value="Submit">
            </div>
        </form>
    </div>
</div>
<meta charset="UTF-8">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="ticker.js"></script>
<link rel="stylesheet" href="css-ticker.css">
<link rel="stylesheet" href="css-main.css">
<link rel="stylesheet" href="css-index.css">
<style>
    #home{
        background-color:rgba(76, 27, 101, 0.8);
    }
</style>
<div class="nav"><?php include 'navpan.php'?></div>

<div class="ticker">
    <div class="ticker-content">
        <span>Click the queriessssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss</span>
    </div>
</div>

<div class="box-container">
    <div class="row-front1">
        <div class="box">
            <a href="query1.php" id="query">
                <h2>Query 1</h2>
                <p>Product name, product description, classification, stock location</p>
            </a>
        </div>
        <div class="box">
            <a href="query2.php" id="query">
                <h2>Query 2</h2>
                <p>Product name, classification, stock location, number of stocks available</p>
            </a>
        </div>
        <div class="box">
            <a href="query3.php" id="query">
                <h2>Query 3</h2>
                <p>Classification, date delivered, number of stocks available, remarks</p>
                <p style="font-size: 10px;" >Remarks should tell if the product is low on stock, in stock, or no available stocks</p>
            </a>
        </div>
    </div>
    <div class="row-front2">
        <div class="box">
            <a href="query4.php" id="query">
                <h2>Query 4</h2>
                <p>The stock location, and classification of products with low stock, in stock, or no available stock</p>
            </a>
        </div>
        <div class="box">
            <a href="query5.php" id="query">
                <h2>Query 5</h2>
                <p>Classification of products delivered on a certain date.</p>
            </a>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
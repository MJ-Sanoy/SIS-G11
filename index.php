<meta charset="UTF-8">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="no-scroll.js"></script>
<link rel="stylesheet" href="css-main.css">
<link rel="stylesheet" href="css-index.css">
<title>HOME - QUERIES</title>
<style>
    #home{
        background-color:rgba(76, 27, 101, 0.8);
    }
    html, body {
        overflow: hidden;
        height: 100%;
    }
</style>
<div class="box-container">
<div class="nav"><?php include 'navpan.php'?></div>
    <div class="row-front1">
        <div class="box">
            <a href="query1.php" id="query">
                <h2>Query 1</h2>
                <p>Product name | Description | Classification | Stock Location</p>
            </a>
        </div>
        <div class="box">
            <a href="query2.php" id="query">
                <h2>Query 2</h2>
                <p>Product name | Classification | Stock location | Number of Stocks Available</p>
            </a>
        </div>
        <div class="box">
            <a href="query3.php" id="query">
                <h2>Query 3</h2>
                <p>Classification | Date Delivered | Number of Stocks Available | Remarks</p><br>
                <div class="description">
                    <p style="font-size: 13px;"><b id='remarks'>Remarks</b> should tell if the product is <br> <b id='low-stock'>low on stock</b>, <b id='in-stock'>in stock</b>, or <b id='no-stock'>no available stocks</b></p>
                </div>
            </a>
        </div>
    </div>
    <div class="row-front2">
        <div class="box">
            <a href="query4.php" id="query">
                <h2>Query 4</h2>
                <p>The Stock Location | Classification of Products with low stock, in stock, or no available stock</p>
            </a>
        </div>
        <div class="box">
            <a href="query5.php" id="query">
                <h2>Query 5</h2>
                <p>Classification of Products Delivered on a Certain Date.</p>
            </a>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
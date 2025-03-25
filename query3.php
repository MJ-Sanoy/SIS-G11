<?php include 'db_connect.php';?>
<script src="ticker.js"></script>
<link rel="stylesheet" href="css-main.css">
<link rel="stylesheet" href="css-table.css">
<link rel="stylesheet" href="css-query-np.css">
<link rel="stylesheet" href="css-query-table.css">
<link rel="stylesheet" href="css-ticker.css">
<div class="nav"><?php include 'navpan.php';?></div>

<div class="ticker">
    <div class="ticker-content">
        <span>Click any of the header to change sort option: ASC/DESC</span>
    </div>
</div>

<div class="next-previous">
        <div>
            <div class="previous"><a href="query2.php">Previous</a></div>
        </div>
            <div class="Ptitle">QUERY 3</div>
        <div>
            <div class="next"><a href="query4.php">Next Query</a></div>
        </div>
    </div>
    
    <div class="content">
        <div class="query">
            <?php include 'queryf3.php'?>
        </div>
    </div>   
<?php include 'footer.php';?>
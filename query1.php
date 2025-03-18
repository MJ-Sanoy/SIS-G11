<?php include 'db_connect.php';?>
<link rel="stylesheet" href="css-main.css">
<link rel="stylesheet" href="css-table.css">
<link rel="stylesheet" href="css-query-np.css">
<link rel="stylesheet" href="css-query-table.css">
<div class="nav"><?php include 'navpan.php'; ?> 
    <div class="Ptitle">QUERY 1</div>
</div>
    
<div class="next-previous">
        <div>
            <div class="previous"><a href="index.php">Home</a></div>
        </div>
        <div>
            <div class="next"><a href="query2.php">Next Query</a></div>
        </div>
    </div>
    
    <div class="content">
        <div class="query">
            <?php include 'queryf1.php'?>
        </div>
    </div>    
<?php include 'footer.php';?>


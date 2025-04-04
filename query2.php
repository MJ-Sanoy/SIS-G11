<?php include 'db_connect.php';?>
<link rel="stylesheet" href="assets/css/css-main.css">
<link rel="stylesheet" href="assets/css/css-table.css">
<link rel="stylesheet" href="assets/css/css-query-np.css">
<link rel="stylesheet" href="assets/css/css-query-table.css">
<link rel="stylesheet" href="assets/css/transition.css">
<link rel="stylesheet" href="assets/css/transition.scss">
<script src="assets/js/q2func.js"></script>
<title>QUERY 2</title>
<div class="nav"><?php include 'navpan.php';?></div>

<div class="Ptitle"><a href="index.php">QUERY 2</a></div>
<div class="next-previous">
        <div>
            <div class="previous"><a href="query1.php">Previous</a></div>
        </div>
        <div>
            <div class="next"><a href="query3.php">Next Query</a></div>
        </div>
    </div>
    
    <div class="content">
        <div class="query">
            <?php include 'queryf2.php'?>
        </div>
    </div>    
<?php include 'footer.php';?>
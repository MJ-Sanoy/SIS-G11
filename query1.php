<?php include 'db_connect.php';?>
<link rel="stylesheet" href="assets/css/css-main.css">
<link rel="stylesheet" href="assets/css/css-table.css">
<link rel="stylesheet" href="assets/css/css-query-np.css">
<link rel="stylesheet" href="assets/css/css-query-table.css">
<link rel="stylesheet" href="assets/css/transition.css">
<link rel="stylesheet" href="assets/css/transition.scss">
<script src="assets/js/q1func.js" defer></script>
<title>QUERY 1</title>
<div class="nav"><?php include 'navpan.php'; ?></div>

<div class="Ptitle"><a href="index.php">QUERY 1</a></div>
<div class="Psub"><p>Product name | Description | Classification | Stock Location</p></div>
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


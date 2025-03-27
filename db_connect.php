<?php
    $username="root";
    $password="";
    $server=""; 
    $db_name="sis";
    $conn = new mysqli ($server, $username, $password, $db_name);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>  
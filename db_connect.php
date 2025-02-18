<?php
    $username="root";
    $password="";
    $server="localhost";
    $db_name="sis";

    $con = new mysqli ($server, $username, $password, $db_name);

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }
?>
<?php
    $username="root";
    $password="";
    $server="localhost";
    $db_name="sis";

    $conn = new mysqli ($server, $username, $password, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }
?>
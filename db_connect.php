<?php
    $username="root";
    $password=""; // CHANGE PASSWORD HERE
    $server="localhost:8080"; // CHANGE THESE PORTS SA SCHOOL
    $db_name="sis";
    $conn = new mysqli ($server, $username, $password, $db_name);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>  
<?php
    $database = "pcos";
    $port = 3306;
    $username = "Hanna";
    $password = "Hanna10";
    $hostname = "localhost";
    $dbhandle = mysqli_connect($hostname, $username, $password, $database, $port) or die("Unable to connect to MySQL");

    

    $selected = mysqli_select_db($dbhandle, $database) or die("Could not connect to database");


?>
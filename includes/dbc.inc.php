<?php

    $dbServername = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "toptrave_db";

    $conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

    mysqli_set_charset($conn,"utf8");
<?php
$dbServername = "91.212.213.31";
$dbUsername = "pepoge_user";
$dbPassword = "bU63el6t3P";
$dbName = "pepoge_travel";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

mysqli_set_charset($conn,"utf8");
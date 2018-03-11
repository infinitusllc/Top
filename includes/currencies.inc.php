<?php
include "dbc.inc.php";
$currencies = [];

$sql_currencies = "SELECT * FROM currenсies";
$result_sql = mysqli_query($conn, $sql_currencies);

$i = 0;
while ($row = mysqli_fetch_assoc($result_sql)){
    $currencies[$i] = $row;
    $i++;
}


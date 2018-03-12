<?php
include "dbc.inc.php";
$food_options = [];

$sql_food = "SELECT * FROM food_options ORDER BY group_id";
$result_sql = mysqli_query($conn, $sql_food);

$i = 0;
while ($row = mysqli_fetch_assoc($result_sql)) {
    $food_options[$i] = $row;
    $i++;
}


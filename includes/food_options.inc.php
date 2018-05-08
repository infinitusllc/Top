<?php
include "dbc.inc.php";
$food_options = [];

$sql_food = "SELECT * FROM food_options ORDER BY group_id";
$result_sql = mysqli_query($conn, $sql_food);

while ($row = mysqli_fetch_assoc($result_sql)) {
    array_push($food_options, $row);
}


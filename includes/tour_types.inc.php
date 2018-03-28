<?php
include "dbc.inc.php";

$sql = "SELECT * FROM tour_types ORDER BY `index` ASC";
$result = mysqli_query($conn, $sql);

$tour_types = [];

$i = 0;
while ($row = mysqli_fetch_assoc($result)){
    $tour_types[$i] = $row;
    $i++;
}
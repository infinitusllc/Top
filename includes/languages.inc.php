<?php
include "dbc.inc.php";

$sql = "SELECT * FROM languages";
$result = mysqli_query($conn, $sql);

$languages = [];

$i = 0;
while ($row = mysqli_fetch_assoc($result)){
    $languages[$i] = $row;
    $i++;
}
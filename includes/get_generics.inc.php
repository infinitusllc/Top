<?php
include "dbc.inc.php";
$generics = [];

$sql = "SELECT * FROM generic_page_content ORDER BY keyword";
$r = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($r)){
    $generics[$row['keyword']][$row['language_key']] = $row;
}


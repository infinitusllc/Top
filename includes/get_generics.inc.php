<?php
include "dbc.inc.php";
$generics = [];

$sql = "SELECT * FROM generic_page_content tr ORDER BY keyword";
$result_sql = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result_sql)){
    $generics[$row['keyword']][$row['language_key']] = $row;
}


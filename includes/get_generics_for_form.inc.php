<?php
include "dbc.inc.php";
$gens= [];

$sql = "SELECT * FROM generic_page_content tr GROUP BY keyword";
$result_sql = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result_sql)){
    $gens[$row['keyword']] = $row;
}


<?php
    include "dbc.inc.php";
    $countries = [];

    $sql_countries = "SELECT * FROM countries";
    $result_sql = mysqli_query($conn, $sql_countries);

    $i = 0;
    while ($row = mysqli_fetch_assoc($result_sql)){
        $countries[$i] = $row;
        $i++;
    }


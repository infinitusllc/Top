<?php
    include "dbc.inc.php";

    $sql = "SELECT * FROM tour_categories";
    $result = mysqli_query($conn, $sql);

    $tour_categories = [];

    $i = 0;
    while ($row = mysqli_fetch_assoc($result)){
        $tour_categories[$i] = $row;
        $i++;
    }
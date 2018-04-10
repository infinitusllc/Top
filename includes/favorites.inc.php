<?php

function getFavorites($user_id) {
    include "dbc.inc.php";

    $sql = "SELECT * FROM favorites fv INNER JOIN tours tr on fv.tour_id = tr.tour_id INNER JOIN tour_content tc ON tr.tour_id = tc.tour_id 
                            INNER JOIN tour_images img ON tr.tour_id = img.tour_id WHERE fv.user_id = $user_id";
    $result = mysqli_query($conn, $sql);

    $tours = [];
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($tours, $row);
    }

    return $tours;
}

function isFavorite($user_id, $tour_id) {
    include "dbc.inc.php";

    $sql = "SELECT * FROM favorites WHERE user_id = $user_id and tour_id = $tour_id";
    $result = mysqli_query($conn, $sql);

    return (mysqli_num_rows($result) > 0);
}
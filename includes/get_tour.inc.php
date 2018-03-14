<?php
function getTour($id) {
    include "dbc.inc.php";

    $sql = "SELECT * FROM tours WHERE tour_id = $id";
    $result_sql = mysqli_query($conn, $sql);

    $tour = null;
    while ($row = mysqli_fetch_assoc($result_sql)){
        $tour = $row;
    }

    return $tour;
}

function getTourContent($id, $langKey) {
    include "dbc.inc.php";

    $sql = "SELECT * FROM tour_content WHERE tour_id = $id AND language_key = '$langKey'";
    $result_sql = mysqli_query($conn, $sql);

    $content = null;
    while ($row = mysqli_fetch_assoc($result_sql)){
        $content = $row;
    }

    return $content;
}

function getTourImages($id) {
    include "dbc.inc.php";

    $sql = "SELECT * FROM tour_images WHERE tour_id = $id ORDER BY is_main DESC";
    $result_sql = mysqli_query($conn, $sql);

    $images = null;
    $i=0;
    while ($row = mysqli_fetch_assoc($result_sql)){
        $images[$i] = $row;
        $i++;
    }

    return $images;
}

function getLatestTourIds(){
    include "dbc.inc.php";

    $sql = "SELECT tour_id FROM tours ORDER BY created_time DESC LIMIT 4";
    $result_sql = mysqli_query($conn, $sql);

    $tour = null;
    $i=0;
    while ($row = mysqli_fetch_assoc($result_sql)){
        $tour[$i] = $row;
        $i++;
    }

    return $tour;
}
<?php

    session_start();

    $param = "";
    if (isset($_GET['param']))
        $param = $_GET['param'];

    include "dbc.inc.php";

    if (isset($_SESSION['lang'])) {
        $lang = $_SESSION['lang'];
    } elseif (isset($lang_key)) {
        $lang = $lang_key;
    } else {
        $lang = 'geo';
    }

    $sql = "SELECT * FROM tours INNER JOIN tour_content tc ON tours.tour_id = tc.tour_id INNER JOIN tour_images on tours.tour_id = tour_images.tour_id
WHERE language_key = '$lang' AND is_deleted = 0 and is_main = 1";

    switch ($param) {
        case "incoming":
            $sql = $sql . " AND type = 2";
            break;
        case "outgoing":
            $sql = $sql . " AND type = 1";
            break;
    }

    $result = mysqli_query($conn, $sql);

    $tours = [];

    while ($row = mysqli_fetch_assoc($result)) {
        array_push($tours, $row);
    }

    $_SESSION['tours'] = $tours;

    header("Location: ../search_results.php");
    exit();



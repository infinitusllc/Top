<?php
session_start();

    include 'dbc.inc.php';

    $category = mysqli_real_escape_string($conn, $_POST['tour_category']);
    $type = mysqli_real_escape_string($conn, $_POST['tour_type']);
    $cities = mysqli_real_escape_string($conn, $_POST['tour_cities']);
    $name = mysqli_real_escape_string($conn, $_POST['tour_name']);
    $lang_key = mysqli_real_escape_string($conn, $_POST['lang']);

    $actual = mysqli_real_escape_string($conn, $_POST['actual']);

    if (isset($_SESSION['lang'])) {
        $lang = $_SESSION['lang'];
    } elseif (isset($lang_key)) {
        $lang = $lang_key;
    } else {
        $lang = 'geo';
    }

    $sql = "SELECT * FROM tours INNER JOIN tour_content tc ON tours.tour_id = tc.tour_id INNER JOIN tour_images on tours.tour_id = tour_images.tour_id
WHERE language_key = '$lang' AND is_deleted = 0 and is_main = 1";

    if (!empty($category) and $category != -1) {
        $sql = $sql." AND category = $category";
    }
    if (!empty($type) and $type != -1) {
        $sql = $sql." AND type = $type";
    }
    if (!empty($cities)) {
        $sql = $sql." AND tour_cities LIKE '%$cities%'";
    }
    if (!empty($name)) {
        $sql = $sql." AND tour_name LIKE '%$name%'";
    }
    if (!empty($actual)) {
        $sql = $sql." AND is_actual = $actual";
    }

    $result = mysqli_query($conn, $sql);

    $tours = [];

    while ($row = mysqli_fetch_assoc($result)) {
        array_push($tours, $row);
    }

    $_SESSION['tours'] = $tours;

    header("Location: ../search_results.php");
    exit();
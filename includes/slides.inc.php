<?php

function getSlides($lang) {
    include "dbc.inc.php";

    $sql = "SELECT * FROM  slide INNER JOIN slide_content sc ON slide.id = sc.slide_id WHERE lang_key = '$lang'";
    $result = mysqli_query($conn, $sql);

    $slides = [];
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($slides, $row);
    }

    return $slides;
}

function getSlide($keyword, $lang) {
    include "dbc.inc.php";

    $sql = "SELECT * FROM  slide INNER JOIN slide_content sc ON slide.id = sc.slide_id WHERE keyword = 
'$keyword' AND lang_key = '$lang'";
    $result = mysqli_query($conn, $sql);

    $slides = [];
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($slides, $row);
    }

    return $slides;
}


function getAllSlides() {
    include "dbc.inc.php";

    $sql = "SELECT * FROM  slide";
    $result = mysqli_query($conn, $sql);

    $slides = [];
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($slides, $row);
    }

    return $slides;
}
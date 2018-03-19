<?php

/**
 * returns a list of categories in the given language
 * @param $lang (int)
 * @return array
 */
function getCategories($lang)
{
    include "dbc.inc.php";

    $sql = "SELECT * FROM tour_categories WHERE language_key = $lang";
    $result = mysqli_query($conn, $sql);

    $tour_categories = [];

    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $tour_categories[$i] = $row;
        $i++;
    }

    return $tour_categories;
}

function getTypes($lang)
{
    include "dbc.inc.php";

    $sql = "SELECT * FROM tour_types WHERE language_key = $lang";
    $result = mysqli_query($conn, $sql);

    $tour_categories = [];

    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $tour_categories[$i] = $row;
        $i++;
    }

    return $tour_categories;
}
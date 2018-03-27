<?php

/**
 * returns a list of categories in the given language
 * @param $lang (int)
 * @return array
 */
function getCategories($lang) {
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

function getCategory($id, $lang_key) {
    include "dbc.inc.php";

    $sql = "SELECT * FROM tour_categories WHERE group_id = $id AND language_key = $lang_key";
    $result = mysqli_query($conn, $sql);

    $tour_categories = [];

    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $tour_categories[$i] = $row;
        $i++;
    }
    return $tour_categories;
}


function getTypeById($group_id, $lang_key) {
    include "dbc.inc.php";

    $sql = "SELECT * FROM tour_types WHERE language_key = $lang_key AND group_id = $group_id";
    $result = mysqli_query($conn, $sql);

    $tour_categories = [];

    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $tour_categories[$i] = $row;
        $i++;
    }

    return $tour_categories;
}


function getTypes($lang_key) {
    include "dbc.inc.php";

    $sql = "SELECT * FROM tour_types WHERE language_key = $lang_key";
    $result = mysqli_query($conn, $sql);

    $tour_categories = [];

    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $tour_categories[$i] = $row;
        $i++;
    }

    return $tour_categories;
}

function getTypesByCategory($lang, $categ_id) {
    include "dbc.inc.php";

    $sql = "SELECT * FROM tour_types inner join category_to_type on tour_types.group_id = category_to_type.type_id
INNER join tour_categories on category_to_type.category_id = tour_categories.group_id
WHERE tour_types.language_key = $lang AND  tour_categories.language_key = $lang AND tour_category_id = $categ_id";
    $result = mysqli_query($conn, $sql);

    $tour_categories = [];

    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $tour_categories[$i] = $row;
        $i++;
    }

    return $tour_categories;
}

function getCategoriesByType($lang_key, $type_id) {
    include "dbc.inc.php";

    $sql = "SELECT * FROM tour_types inner join category_to_type on tour_types.group_id = category_to_type.type_id
  INNER join tour_categories on category_to_type.category_id = tour_categories.group_id
WHERE tour_types.language_key = $lang_key AND  tour_categories.language_key = $lang_key AND tour_types.group_id = $type_id";

    $result = mysqli_query($conn, $sql);

    $tour_categories = [];

    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $tour_categories[$i] = $row;
        $i++;
    }

    return $tour_categories;
}
<?php

function getEvents($lang_key) {
    include "dbc.inc.php";
    $sql = "SELECT * FROM generic_page_content WHERE language_key = $lang_key AND type = 'event'";
    $result = mysqli_query($conn, $sql);

    $events = [];
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($events, $row);
    }

    return $events;
}
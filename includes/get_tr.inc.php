<?php
    include "dbc.inc.php";
    $translations = [];

    $sql_translations = "SELECT * FROM translations tr INNER JOIN languages lg ON tr.language_key = lg.id ORDER BY title";
    $result_sql = mysqli_query($conn, $sql_translations);

    $i = 0;
    $j = -1;
    $title = "";
    while ($row = mysqli_fetch_assoc($result_sql)){
        if ($row['title'] == $title) {
            $translations[$j][$row['language_key']] = $row['value'];
        } else {
            $j++;
            $title = $row['title'];
            $translations[$j]['title'] = $title;
            $translations[$j][$row['language_key']] = $row['value'];
        }
        $i++;
    }


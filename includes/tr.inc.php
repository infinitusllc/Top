<!--get constant variables according to language-->
<?php
function getTranslations($language) {
    include "dbc.inc.php";
    $translations = [];

    $sql_translations = "SELECT * FROM translations tr INNER JOIN languages lg ON tr.language_key = lg.id WHERE lg.keyword = '$language'";
    $result_sql = mysqli_query($conn, $sql_translations);

    $i = 0;
    while ($row = mysqli_fetch_assoc($result_sql)){
        $result[$row['title']] = $row['value'];
        $i++;
    }

    return $translations;
}
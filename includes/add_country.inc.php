<?php
session_start();

if(isset($_POST['submit'])) {
    include 'dbc.inc.php';

    $values = [];

    include "languages.inc.php";
    for ($i=0; $i<sizeof($languages); $i++){
        $values[$i] =  mysqli_real_escape_string($conn, $_POST['value_'.$languages[$i]['id']]);
        if (empty($values[$i])) {
            header("Location: ../admin.php?tab=combinations&option=food_options&message=error1");
            exit();
        }
    }


    $sql1 = "INSERT INTO countries (country_name, language_key) VALUES ('$values[0]', 'geo')";
    mysqli_query($conn, $sql1);

    $sql2 = "SELECT country_id FROM countries ORDER BY country_id DESC LIMIT 1";
    $result2 = mysqli_query($conn, $sql2);

    $row = mysqli_fetch_assoc($result2);
    $id = $row['country_id'];

    for ($i = 1; $i < sizeof($values); $i++) {
        if (!empty($values[$i])) {
            $lang = $languages[$i]['keyword'];
            $sql = "INSERT INTO countries (country_name, language_key, group_id) VALUES ('$values[$i]', '$lang', $id)";
            mysqli_query($conn, $sql);
        }
    }

    $sql3 = "UPDATE countries SET group_id = $id WHERE country_id = $id;";
    mysqli_query($conn, $sql3);

    header("Location: ../admin2.php?tab=combinations&option=countries&message=success");
    exit();

}
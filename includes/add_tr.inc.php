<?php
session_start();

if(isset($_POST['submit'])) {
    include 'dbc.inc.php';

    $title = mysqli_real_escape_string($conn, $_POST['title']);

    $keywords = [];
    $values = [];

    include "languages.inc.php";
    for ($i=0; $i<sizeof($languages); $i++){
        $keywords[$i] =  $languages[$i]['id'];
        $values[$i] =  mysqli_real_escape_string($conn, $_POST['value_'.$languages[$i]['id']]);
    }

    for ($i=0; $i<sizeof($values); $i++) {
        if (!empty($values[$i])) {
            $sql = "INSERT INTO translations (title, value, language_key) VALUES ('$title', '$values[$i]', $keywords[$i])";
            echo $sql;
            $result = mysqli_query($conn, $sql);
        }
    }

    header("Location: ../translations.php");
    exit();

}
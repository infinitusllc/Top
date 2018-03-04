<?php
session_start();

if(isset($_POST['submit'])) {
    include 'dbc.inc.php';

    $title = mysqli_real_escape_string($conn, $_POST['title']);

    if (!isset($title) || $title == "") {
        header("Location: ../translations.php?message=error1");
        exit();
    }

    $keywords = [];
    $values = [];

    include "languages.inc.php";
    for ($i=0; $i<sizeof($languages); $i++){
        $keywords[$i] =  $languages[$i]['id'];
        $values[$i] =  mysqli_real_escape_string($conn, $_POST['value_'.$languages[$i]['id']]);
    }

    $old_title = mysqli_real_escape_string($conn, $_POST['old_title']);
    $is_change = mysqli_real_escape_string($conn, $_POST['is_change']);

    echo $old_title."</br>";
    echo $is_change."</br>";

    if ($is_change != 'true') {

        $sql = "SELECT * FROM translations WHERE title = '$title'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            header("Location: ../translations.php?message=error1");
            exit();
        }

        for ($i = 0; $i < sizeof($values); $i++) {
            if (!empty($values[$i])) {
                $sql = "INSERT INTO translations (title, value, language_key) VALUES ('$title', '$values[$i]', $keywords[$i])";
                echo $sql;
                $result = mysqli_query($conn, $sql);
            }
        }
    } else {
        $sql = "DELETE FROM translations WHERE title = '$old_title'";
        $result = mysqli_query($conn, $sql);

        for ($i = 0; $i < sizeof($values); $i++) {
            if (!empty($values[$i])) {
                $sql = "INSERT INTO translations (title, value, language_key) VALUES ('$title', '$values[$i]', $keywords[$i])";
                echo $sql;
                $result = mysqli_query($conn, $sql);
            }
        }
    }

    header("Location: ../translations.php?message=success");
    exit();

}
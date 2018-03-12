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


    $sql1 = "INSERT INTO food_options (food_option, language_key) VALUES ('$values[0]', 1)";
    $result1 = mysqli_query($conn, $sql1);

    $sql2 = "SELECT food_option_id FROM food_options ORDER BY food_option_id DESC LIMIT 1";
    $result2 = mysqli_query($conn, $sql2);
    $row = mysqli_fetch_assoc($result2);
    $id = $row['food_option_id'];
    echo $id;

    for ($i = 1; $i < sizeof($values); $i++) {
        if (!empty($values[$i])) {
            $sql = "INSERT INTO food_options (food_option, language_key, group_id) VALUES ('$values[$i]', $i+1, $id)";
            $result = mysqli_query($conn, $sql);
        }
    }

    $sql3 = "UPDATE food_options SET group_id = $id WHERE food_option_id = $id;";
    $result = mysqli_query($conn, $sql3);

    header("Location: ../admin.php?tab=combinations&option=food_options&message=success");
    exit();

}
<?php
session_start();

if(isset($_POST['submit'])) {
    include 'dbc.inc.php';

    include "languages.inc.php";

    $id = mysqli_real_escape_string($conn, $_POST['group_id']);

    echo $id."<br>";
    if (isset($id) and !empty($group_id)) {   // changing existing category
        $group_id =  $id;
        for ($i=1; $i<=sizeof($languages); $i++) {
            $value = mysqli_real_escape_string($conn, $_POST["value_$i"]);
            $sql = "UPDATE tour_categories SET tour_category = '$value' WHERE language_key = $i AND group_id = $id";
            echo $sql;
            mysqli_query($conn, $sql);
        }

        $index = mysqli_real_escape_string($conn, $_POST['index']);

        if (isset($index) and !empty($index)) {
            mysqli_query($conn, "UPDATE tour_categories SET `index` = $index WHERE group_id = $group_id");
        }

        $type = mysqli_real_escape_string($conn, $_POST['type']);

        $sql = "UPDATE category_to_type SET type_id = $type WHERE category_id = $group_id";
        mysqli_query($conn, $sql);

        header("Location: ../admin.php?tab=combinations&option=categories&message=success");
        exit();
    } else {    // creating new category
        $group_id = -1;
        for ($i = 1; $i <= sizeof($languages); $i++) {
            $value = mysqli_real_escape_string($conn, $_POST["value_$i"]);
            $sql = "INSERT INTO tour_categories (tour_category, language_key, group_id) VALUES ('$value', $i, $group_id)";
            mysqli_query($conn, $sql);

            if ($i == 1) {
                $sql = "SELECT tour_category_id FROM tour_categories ORDER BY tour_category_id DESC";
                $result = mysqli_query($conn, $sql);
                $group_id = mysqli_fetch_assoc($result)['tour_category_id'];
                $sql = "UPDATE tour_categories SET group_id = $group_id WHERE tour_category_id = $group_id";
                mysqli_query($conn, $sql);
            }
        }

        $index = mysqli_real_escape_string($conn, $_POST['index']);

        if (isset($index) and !empty($index)) {
            mysqli_query($conn, "UPDATE tour_categories SET `index` = $index WHERE group_id = $group_id");
        }

        $type = mysqli_real_escape_string($conn, $_POST['type']);

        $sql = "INSERT INTO category_to_type (category_id, type_id) VALUES ($group_id, $type)";
        mysqli_query($conn, $sql);

        header("Location: ../admin.php?tab=combinations&option=categories&message=success");
        exit();
    }
}
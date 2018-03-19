<?php
session_start();

if(isset($_POST['submit'])) {
    include 'dbc.inc.php';

    include "languages.inc.php";
    $group_id = -1;
    for ($i=1; $i<=sizeof($languages); $i++) {
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

    header("Location: ../admin.php?tab=combinations&options=categories&message=success");
    exit();


}
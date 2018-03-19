<?php
session_start();

if(isset($_POST['submit'])) {
    include 'dbc.inc.php';

    include "languages.inc.php";
    $group_id = -1;
    for ($i=1; $i<=sizeof($languages); $i++) {
        $value = mysqli_real_escape_string($conn, $_POST["value_$i"]);
        $sql = "INSERT INTO tour_types (tour_type, language_key, group_id) VALUES ('$value', $i, $group_id)";
        mysqli_query($conn, $sql);

        if ($i == 1) {
            $sql = "SELECT id FROM tour_types ORDER BY id DESC";
            $result = mysqli_query($conn, $sql);
            $group_id = mysqli_fetch_assoc($result)['id'];
            $sql = "UPDATE tour_types SET group_id = $group_id WHERE id = $group_id";
            mysqli_query($conn, $sql);
        }
    }

    $category = mysqli_real_escape_string($conn, $_POST['category']);

    $sql = "INSERT INTO category_to_type (category_id, type_id) VALUES ($category, $group_id)";
    mysqli_query($conn, $sql);
    $sql = null;

    header("Location: ../admin.php?tab=combinations&options=types&message=success");
    exit();
}
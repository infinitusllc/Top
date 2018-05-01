<?php

if (!isset($_GET['id'])) {
    header("Location: ../admin2.php?message=error");
    exit();
}

$id = $_GET['id'];

include "dbc.inc.php";

$sql = "DELETE FROM tour_content WHERE tour_id = $id";
if (mysqli_query($conn, $sql)) {
    $sql = "DELETE FROM tours WHERE tour_id = $id";
    if (mysqli_query($conn, $sql)) {
        //redirect, success
        header("Location: ../admin2.php?message=success");
        exit();
    } else {
        //redirect, error
        header("Location: ../admin2.php?message=error1");
        exit();
    }
} else {
    //redirect, error
    header("Location: ../admin2.php?message=error2");
    exit();
}
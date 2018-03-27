<?php

session_start();

if (isset($_POST['submit'])) {
    include 'dbc.inc.php';
    date_default_timezone_set('Europe/Samara');

    $review_id = mysqli_real_escape_string($conn, $_POST['id']);
    $url = "reviews.php";
    $time = date('c');
    $time = substr($time, 0, 19);

    $sql = "UPDATE reviews SET is_deleted = 1, time_deleted = '$time' WHERE id = $review_id";
    echo $sql;

    if (mysqli_query($conn, $sql)) {
        header("Location: ../$url");
        exit();
    } else {
        header("Location: ../$url.error");
        exit();
    }
}
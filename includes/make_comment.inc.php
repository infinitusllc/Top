<?php

session_start();

if (isset($_POST['submit'])) {
    include "dbc.inc.php";

    $tour_id = mysqli_real_escape_string($conn, $_POST['tour_id']);
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);
    $url = mysqli_real_escape_string($conn, $_POST['url']);
    date_default_timezone_set('Europe/Samara');
    $time = date('c');

    if (strlen($comment) <= 0) { //empty comment
        header("Location: ../$url");
        exit();
    }

    $sql = "INSERT INTO comments (tour_id, user_id, subject, comment, time) 
                          VALUES ($tour_id, $user_id, '$subject', '$comment', '$time')";
    echo $sql;
    if (mysqli_query($conn, $sql)) {
        header("Location: ../$url");
        exit();
    } else {
        header("Location: ../$url.error");
        exit();
    }
}
<?php

session_start();

if (isset($_POST['submit'])) {
    include 'dbc.inc.php';
    date_default_timezone_set('Europe/Samara');

    $comment_id = mysqli_real_escape_string($conn, $_POST['id']);
    $url = mysqli_real_escape_string($conn, $_POST['url']);
    $time = date('c');
    $time = substr($time, 0, 19);

    $sql = "UPDATE comments SET is_deleted_by_mod = 1, deleted_time = '$time' WHERE id = $comment_id";
    echo $sql;

    if (mysqli_query($conn, $sql)) {
        header("Location: ../$url");
        exit();
    } else {
        header("Location: ../$url.error");
        exit();
    }
}
<?php

session_start();

if (isset($_POST['submit'])) {
    include "dbc.inc.php";

    $e_mail = mysqli_real_escape_string($conn, $_POST['e_mail']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $review = mysqli_real_escape_string($conn, $_POST['review']);
    date_default_timezone_set('Europe/Samara');
    $time = date('c');

    if (strlen($review) <= 0) { //empty comment
        header("Location: ../reviews.php?error");
        exit();
    }

    $sql = "INSERT INTO reviews (`e-mail`, subject, review, time) 
                          VALUES ('$e_mail', '$subject', '$review', '$time')";
    if (mysqli_query($conn, $sql)) {
        header("Location: ../reviews.php");
        exit();
    } else {
        echo $sql;
        header("Location: ../reviews.php?error");
        exit();
    }
}
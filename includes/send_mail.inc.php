<?php

session_start();

if (isset($_POST['submit'])) {
    include "dbc.inc.php";

    $e_mail = mysqli_real_escape_string($conn, $_POST['e_mail']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $msg = mysqli_real_escape_string($conn, $_POST['message']);
    date_default_timezone_set('Europe/Samara');
    $time = date('c');

    $to = "turdzeladze@gmail.com";
    $subject = "message from toptravel: ".$subject;

    $message = $msg."\n\n\n sent by: ".$e_mail;

    // More headers
    $headers .= 'From: <$e_mail>' . "\r\n";

    mail($to,$subject,$message,$headers);

    header("Location: ../mail.php?success");
    exit();
}
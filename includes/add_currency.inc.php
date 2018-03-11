<?php
session_start();

if(isset($_POST['submit'])) {
    include 'dbc.inc.php';

    $currency = mysqli_real_escape_string($conn, $_POST['currency']);

    if (!isset($currency) || $currency == "" || sizeof($currency) > 4) {
        header("Location: ../admin.php?tab=combinations&options=currency&message=error1");
        exit();
    }

    $sql = "INSERT INTO currenсies (currency) VALUES ('$currency')";

    if (mysqli_query($conn, $sql)) {
        header("Location: ../admin.php?tab=combinations&options=currency&message=success");
        exit();
    }

}
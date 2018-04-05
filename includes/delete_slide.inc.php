<?php

if (!isset($_GET['keyword'])) {
    header("Location: ../admin.php?tab=slide&message=error0");
    exit();
}

$keyword = $_GET['keyword'];

include "dbc.inc.php";

$sql = "SELECT id FROM slide WHERE keyword = '$keyword'";

if($result = mysqli_query($conn, $sql)) {
    $id = mysqli_fetch_assoc($result)['id'];

    $sql = "DELETE FROM slide_content WHERE slide_id = $id";
    if (mysqli_query($conn, $sql)) {
        $sql = "DELETE FROM slide WHERE id = $id";
        if (mysqli_query($conn, $sql)) {
            //redirect, success
            header("Location: ../admin.php?tab=slide&message=success");
            exit();
        } else {
            //redirect, error
            header("Location: ../admin.php?tab=slide&message=error1");
            exit();
        }
    } else {
        //redirect, error
        header("Location: ../admin.php?tab=slide&message=error2");
        exit();
    }
} else {
    //redirect, error
    header("Location: ../admin.php?tab=slide&message=error3");
    exit();
}
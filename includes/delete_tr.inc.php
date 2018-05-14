<?php
    $title = $_GET['title'];

    include "dbc.inc.php";

    $sql = "DELETE FROM translations WHERE title = '$title'";
    $result = mysqli_query($conn, $sql);

    header("Location: ../admin2.php?tab=translations&message=success");
    exit();
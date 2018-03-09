<?php
    $title = $_GET['title'];

    include "dbc.inc.php";

    $sql = "DELETE FROM translations WHERE title = '$title'";
    $result = mysqli_query($conn, $sql);

    header("Location: ../translations.php?tab=translations&message=success");
    exit();
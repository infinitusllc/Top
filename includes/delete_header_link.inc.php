<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    include "dbc.inc.php";

    $sql1 = "DELETE FROM header_links WHERE id = $id";
    $sql2 = "DELETE FROM header_content WHERE group_id = $id";

    if (mysqli_query($conn, $sql1) and mysqli_query($conn, $sql2)) {
        header("Location: ../admin.php?tab=header&msg=s");
        exit();
    }
}

header("Location: ../admin.php?tab=header&msg=5");
exit();
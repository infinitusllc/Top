<?php
$id = $_GET['id'];

include "dbc.inc.php";

$sql = "DELETE FROM countries WHERE group_id = $id";
if ( mysqli_query($conn, $sql)) {
    header("Location: ../admin.php?tab=combinations&option=country&message=success");
    exit();
} else {
    header("Location: ../admin.php?tab=combinations&option=country&message=error");
    exit();
}


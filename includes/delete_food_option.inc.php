<?php
$id = $_GET['id'];

include "dbc.inc.php";

$sql = "SELECT * FROM food_options WHERE food_option_id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$group_id = $row['group_id'];

$sql = "DELETE FROM food_options WHERE group_id = $group_id";
$result = mysqli_query($conn, $sql);

header("Location: ../admin.php?tab=combinations&option=food_options&message=success");
exit();
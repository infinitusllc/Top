<?php
$keyword = $_GET['keyword'];

include "dbc.inc.php";

$sql = "DELETE FROM generic_page_content WHERE keyword = '$keyword'";
$result = mysqli_query($conn, $sql);

header("Location: ../admin.php?tab=generic&message=success");
exit();
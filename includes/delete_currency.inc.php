<?php
$id = $_GET['id'];

include "dbc.inc.php";

$sql = "DELETE FROM currenсies WHERE currency_id = '$id'";
$result = mysqli_query($conn, $sql);

header("Location: ../admin.php?tab=combinations&options=currency&message=success");
exit();
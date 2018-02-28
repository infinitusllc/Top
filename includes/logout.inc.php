<?php

session_start();

$_SESSION["logged"] = false;
$_SESSION['user'] = null;

header("Location: ../index.php");
exit();
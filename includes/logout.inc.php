<?php

session_start();

$_SESSION["logged"] = false;
$_SESSION['user'] = null;
$_SESSION['unlogged'] = true;

unset($_COOKIE['e_mail']);
unset($_COOKIE['password']);

header("Location: ../index.php");
exit();
<?php

    if(session_id() == '' || !isset($_SESSION))  // session isn't started
        session_start();

    $lang = 'geo';
    if (isset($_SESSION['lang']))
        $lang = $_SESSION['lang'];
?>

<!-- Stylesheets -->
<link rel="icon" href="images/favicon.ico" type="image/x-icon">
<link href='//fonts.googleapis.com/css?family=Lato:400,300,400italic,700,900,100' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/lang_<?php echo $lang ?>.css">
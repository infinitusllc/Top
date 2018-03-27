<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> TopTravel </title>
    <meta name="description" content="Free Bootstrap Theme by BootstrapMade.com">
    <meta name="keywords" content="free website templates, free bootstrap themes, free template, free bootstrap, free website template">
    <link rel="stylesheet" href="css/style.css">
</head>


<body>

<?php
session_start();

include "includes/get_generics.inc.php";
$keyword = -1;

if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
}

$lang_key = -1;
if (isset($_SESSION['lang_key'])) {
    $lang_key = $_SESSION['lang_key'];
} elseif (isset($_GET['lang'])) {
    $lang_key = $_GET['lang'];
}

include "mods/header.mod.php";
?>

<div style="width: 70%; margin: 80px auto auto;">
    <form id="review-form" action="includes/send_mail.inc.php" method="post" accept-charset="UTF-8" style="text-align: center; margin-bottom: 20px">
        <p> თქვენი ი-მეილი: </p>
        <input name="e_mail" style="border: solid grey; outline: grey">
        <p> საკითხი: </p>
        <input name="subject" style="border: solid grey; outline: grey">
        <p> მესიჯი: </p>
        <textarea name="message" style="border: solid grey; outline: grey; width: 60%; height: 20%"></textarea> <br><br>
        <input type="submit" name="submit" value="მესიჯის გაგზავნა" style="outline: gray; border: solid gray; padding: 10px">
    </form>
</div>

</body>
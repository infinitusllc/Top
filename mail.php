<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> TopTravel </title>
    <meta name="description" content="Free Bootstrap Theme by BootstrapMade.com">
    <meta name="keywords" content="free website templates, free bootstrap themes, free template, free bootstrap, free website template">
    <?php
        if (session_id() == '' || !isset($_SESSION)) // session isn't started
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

        include "mods/style.mod.php";
    ?>
</head>


<body>

<?php

include "mods/header.comm.mod.php";
?>

<div class="container-common">
	<h2> 
		მოგვწერეთ შეტყობინება..
	</h2>
	<div class="common-style" style="text-align:left;">
		<form id="mail-form" action="includes/send_mail.inc.php" method="post" accept-charset="UTF-8">
			<input name="e_mail" style="width:20%;" placeholder="ი-მეილი"><br>
			<input name="subject" style="width:100%;" placeholder="სათაური"><br>
			<textarea name="message" style="width:100%;height:250px;" placeholder="შეტყობინება"></textarea><br>
			<input type="submit" name="submit" value="შეტყობინების გაგზავნა">
		</form>
	</div>
</div>

<?php include "mods/footer.mod.php"; ?>


</body>
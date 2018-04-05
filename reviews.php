<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> TopTravel </title>
    <meta name="description" content="Free Bootstrap Theme by BootstrapMade.com">
    <meta name="keywords" content="free website templates, free bootstrap themes, free template, free bootstrap, free website template">
    <?php include "mods/style.mod.php"; ?>
</head>


<body>

<?php
    //session_start();

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

<div class="container-common">
	<h2> 
		გაგვიზიარეთ თქვენი მოსაზრება..
	</h2>
	<div class="common-style" style="text-align:left;">
		<form id="review-form" action="includes/make_review.inc.php" method="post" accept-charset="UTF-8">
			<input name="e_mail" style="width:20%;" placeholder="ი-მეილი"><br>
			<input name="subject" style="width:100%;" placeholder="საკითხი"><br>
			<textarea name="review" style="width:100%;" placeholder="რევიუ"></textarea><br>
			<input type="submit" name="submit" value="რევიუს დატოვება">
		</form>
	</div>
</div>
<div class="container" style="text-align:left;">
<div style="background-color: ghostwhite;padding: 10px;border: 1px solid #6f588a;color: #6f588a;margin: 10px 0;">
	<?php
		require_once "includes/comments.inc.php";
		$reviews = getReviews();
		$first = true;
		foreach ($reviews as $review) {
		if($first) { ?>
			<?php
			$first = false;
			} else { ?>
			<div style="background-color: ghostwhite;padding: 10px;border: 1px solid #6f588a;color: #6f588a;margin: 10px 0;">
				<?php } ?>
				<p> <strong>კომენტატორი:</strong> <?php echo $review['e-mail'] ?> <br>
					<strong>საკითხი:</strong> <?php echo $review['subject']; ?> </p>
				<p style="text-align: left"> <?php echo $review['review']; ?> </p>
				<p style="text-align: right"> <?php echo $review['time']; ?> </p>

				<?php if (isset($_SESSION["logged"]) and $_SESSION["logged"] and ($_SESSION['user']['is_admin'] == 1
						or $_SESSION['user']['id'] == $comment['user_id'])) { ?>
					<form id="delete-review" action="includes/delete_review.inc.php" method="post" style="text-align: center">
						<input type="hidden" value="<?php echo $review['id']; ?>" name="id">
						<input type="submit" name="submit" value="წაშლა" style="color: red">
					</form>
			<?php } ?>
		</div>
	<?php } ?>
    </div>
</div>
	<!--========================================================
    FOOTER
    ==========================================================-->
    <?php include "mods/footer.mod.php"; ?>
</body>
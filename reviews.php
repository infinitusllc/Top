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
    <form id="review-form" action="includes/make_review.inc.php" method="post" accept-charset="UTF-8" style="text-align: center; margin-bottom: 20px">
        <p> ი-მეილი: </p>
        <input name="e_mail" style="border: solid grey; outline: grey">
        <p> საკითხი: </p>
        <input name="subject" style="border: solid grey; outline: grey">
        <p> რევიუ: </p>
        <textarea name="review" style="border: solid grey; outline: grey; width: 60%; height: 20%"></textarea> <br><br>
        <input type="submit" name="submit" value="რევიუს დატოვება" style="outline: gray; border: solid gray; padding: 10px">
    </form>
</div>

<?php
    require_once "includes/comments.inc.php";
    $reviews = getReviews();
    $first = true;
    foreach ($reviews as $review) {
    if($first) { ?>
    <div style="width: 60%; margin: auto; background-color: ghostwhite; padding: 20px; border: dotted gray">
        <?php
        $first = false;
        } else { ?>
        <div style="width: 60%; margin: auto; background-color: ghostwhite; padding: 20px; border: dotted gray; border-top: none">
            <?php } ?>
            <p> <strong>კომენტატორი:</strong> <?php echo $review['e-mail'] ?> <br>
                <strong>საკითხი:</strong> <?php echo $review['subject']; ?> </p>
            <p style="text-align: center"> <?php echo $review['review']; ?> </p>
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

</body>
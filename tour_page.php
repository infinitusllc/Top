<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> TopTravel </title>
    <meta name="description" content="Free Bootstrap Theme by BootstrapMade.com">
    <meta name="keywords" content="free website templates, free bootstrap themes, free template, free bootstrap, free website template">
    <meta name="format-detection" content="telephone=no"/>
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>

    <!-- Stylesheets -->
    <?php include "mods/style.mod.php"; ?>

    <!--[if lt IE 10]>
    <script src="js/html5shiv.min.js"></script>
    <![endif]-->


    <?php
    if (session_id() == '' || !isset($_SESSION)) // session isn't started
        session_start();

    include "includes/get_tour.inc.php";
    $id = -1;
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }

    $lang_key = -1;
    if (isset($_GET['lang'])) {
        $lang_key = $_GET['lang'];
    }

    $tour = getTour($id);
    $tour_content = getTourContent($id, $lang_key);
    $tour_images = getTourImages($id);

    $logged = $_SESSION['admin'];
    if (!isset($logged) || $logged == false){
        header("Location: ind.php");
        exit();
    }
    ?>

    <?php
    include "includes/tr.inc.php";
    $lang = "geo";
    if (isset($_GET['lang'])){
        $lang = $_GET['lang'];
    }

    $lang_key = 1;
    switch ($lang) {
        case "rus":
            $lang_key = 3;
            break;
        case "eng":
            $lang_key = 2;
            break;
    }

    ?>

    <script>
        function openNav() {
            document.getElementById("myNav").style.display = "block";
        }

        function closeNav() {
            document.getElementById("myNav").style.display = "none";
        }

    </script>

</head>
<body>

<div id="myNav" class="overlay">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div class="overlay-content" style="background-color: gray; width: fit-content; padding: 50px; margin: auto">
        <h4 style="margin-bottom: 15px"> შესვლა </h4>
        <form id="login_form" action="includes/login.inc.php" method="post">
            <input type="text" name="e_mail" placeholder="e-mail" style="border: solid darkgray; background-color: floralwhite"/> <br> <br>
            <input type="password" name="password" placeholder="password" style="border: solid darkgray; background-color: floralwhite"/> <br> <br>
            <button type="submit" class="button sub" name="submit" style="border: solid darkgray; padding: 10px"> შესვლა</button> <br> <br>
        </form>
        <form action="registration.php" style="display: inline-block; margin: 5px">
            <input type="submit" value="რეგისტრაცია" style="border: solid darkgray; padding: 10px"/>
        </form>
    </div>
</div>

<section id="content-section">
    <!-- bonus header -->
    <!--          if not logged in      -->
    <?php include "mods/header.mod.php"; ?>
<div style="margin-top: 100px;">
    <div style="width: 20%; float: left; display: inline-block; text-align: center">
        <?php
            require_once "includes/categories.inc.php";
            $categories = getCategories($lang_key);
            foreach ($categories as $category) {
                echo "<a href='#'> <p style='display: inline-block; margin-top: 10px'>".$category['tour_category']."</p></a></br>";
            }
        ?>
    </div>

    <div style="width: 80%; float: left; display: inline-block;">
        <h1 style="text-align: center; color:black"> <?php echo $tour_content['tour_name']; ?> </h1></br>
        <h4 style="text-align: center"> <?php echo $tour_content['tour_intro']; ?> </h4></br>
        <div style="max-width: 60%; margin: auto auto 30px;"> <?php echo $tour_content['tour_description']; ?> </div>

        <div name="images" style="width: 800px; margin: auto">
            <?php for ($i=0; $i<sizeof($tour_images); $i++) {
                if ($i == 0) echo "<p style='text-align: center'> ძირითადი სურათი: </p>"
                ?>
                <img src="<?php echo $tour_images[$i]['image_url'] ?>" style="width:800px; margin-bottom: 100px"> </br>
            <?php } ?>
        </div>
    </div>
</div>

<div style="width: 80%; margin-left: 20%;">
    <div style="width: 80%; margin: auto;">
        <form id="comment-form" action="includes/make_comment.inc.php" method="post" accept-charset="UTF-8" style="text-align: center; margin-bottom: 20px">
            <p> საკითხი: </p>
            <input name="subject" style="border: solid grey; outline: grey">
            <p> კომენტარი: </p>
            <textarea name="comment" style="border: solid grey; outline: grey; width: 60%; height: 20%"></textarea> <br><br>
            <input type="submit" name="submit" value="დაკომენტარება" style="outline: gray; border: solid gray; padding: 10px">

            <input type="hidden" name="user_id" value="<?php if (isset($_SESSION["logged"]) and $_SESSION["logged"]) {echo $_SESSION['user']['id']; } else {echo '-1'; } ?>">
            <input type="hidden" name="tour_id" value="<?php echo $id; ?>">
            <input type="hidden" name="url" value="tour_page.php?id=<?php echo $id;?>&lang=<?php echo $lang; ?>">
        </form>

        <?php
            require_once "includes/comments.inc.php";
            $comments = getCommentsByTour($id);
            $first = true;
            foreach ($comments as $comment) {
                    if($first) { ?>
                <div style="width: 60%; margin: auto; background-color: ghostwhite; padding: 20px; border: dotted gray">
                    <?php
                    $first = false;
                    } else { ?>
                <div style="width: 60%; margin: auto; background-color: ghostwhite; padding: 20px; border: dotted gray; border-top: none">
                    <?php } ?>
                    <p> <strong>კომენტატორი:</strong> <?php echo $comment['first_name']." ".$comment['last_name']; ?> <br>
                        <strong>საკითხი:</strong> <?php echo $comment['subject']; ?> </p>
                    <p style="text-align: center"> <?php echo $comment['comment']; ?> </p>
                    <p style="text-align: right"> <?php echo $comment['time']; ?> </p>

                    <?php if (isset($_SESSION["logged"]) and $_SESSION["logged"] and ($_SESSION['user']['is_admin'] == 1
                                    or $_SESSION['user']['id'] == $comment['user_id'])) { ?>
                        <form id="delete-comment" action="includes/delete_comment.inc.php" method="post" style="text-align: center">
                            <input type="hidden" value="<?php echo $comment['id']; ?>" name="id">
                            <input type="hidden" name="url" value="tour_page.php?id=<?php echo $id;?>&lang=<?php echo $lang; ?>">
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
<!DOCTYPE html>
<html lang="en" class="wide wow-animation">
<head>
    <!-- Site Title -->
    <title>Home</title>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>

    <!-- Stylesheets -->
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link href='//fonts.googleapis.com/css?family=Lato:400,300,400italic,700,900,100' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/style.css">

    <!--[if lt IE 10]>
    <script src="js/html5shiv.min.js"></script>
    <![endif]-->

    <script>
        function openNav() {
            document.getElementById("login-form").style.display = "block";
            document.getElementById("content-section").style.display = "none";
        }

        function closeNav() {
            document.getElementById("login-form").style.display = "none";
            document.getElementById("content-section").style.display = "block";
        }

        function displayTypes(selectObject) {
            var value = selectObject.value;
            if (value === '-1') {
                window.location.href = 'search_results.php?';
            } else {
                window.location.href = 'search_results.php?type=' + value;
            }
        }

        function changeLanguage(selectObject) {
            var value = selectObject.value;
            window.location.href = 'index.php?lang=' + value;
        }
    </script>
    <?php
    session_start();
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

    $contents = getTranslations($lang);
    ?>

</head>
<body>

<!-- login form -->
<?php include "mods/login_form.mod.php"; ?>


<!-- The Main Wrapper -->
<div id="content-section" class="page">

    <!--For older internet explorer-->
    <div class="old-ie" style='background: #212121; padding: 10px 0; box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3); clear: both; text-align:center; position: relative; z-index:1;'>
        <a href="http://windows.microsoft.com/en-US/internet-explorer/..">
            <img src="images/ie8-panel/warning_bar_0000_us.jpg" height="42" width="820"
                 alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."/>
        </a>
    </div>
    <!--END block for older internet explorer-->

    <!--========================================================
                              HEADER
    =========================================================-->
    <?php include "mods/header.mod.php"; ?>

    <header class="page-header">
        <div class="container">
            <!-- RD Navbar Brand -->
            <!-- <div class="rd-navbar-brand">
                <a href="index.php" class="brand-name primary-color">
                    &#95;world<span class="text-primary">around</span><span class="brand-slogan text-regular">travel operator</span>
                </a>
           </div> -->
            <!-- END RD Navbar Brand -->

        </div>
    </header>
    <!--========================================================
                              CONTENT
    =========================================================-->
    <main class="page-content">
        <section>

            <!-- Swiper -->
                <?php include "mods/slide_display.mod.php"; ?>
                <!-- END Swiper -->
            <div id="sc_down">
                <a class="btn" href="#ex1">ჩასქროლე</a>
            </div>
        </section>

        <section>
            <div class="container">
                <!-- RD Mailform -->
                <form class='rd-mailform1' method="post" action="includes/tour_search.inc.php">
                    <!-- RD Mailform Type -->
                    <input type="hidden" name="form-type" value="contact"/>
                    <!-- END RD Mailform Type -->

                    <a href="index.php" class="brand-name primary-color">
                        <img src="images/logo.png" data-srcset-base="images/" data-srcset-ext="logo.png" alt="" width="100" height="100">
                    </a>
                    <!--<h4 class="text-bold">მოძებნე ტური</h4>-->

                    <p>ტურის ტიპი</p>
                    <label data-add-placeholder>
                        <select name="tour_type" onchange="displayTypes(this)">
                            <option value="-1"> ნებისმიერი </option>
                            <?php
                            require_once "includes/categories.inc.php";
                            $types = getTypes($lang_key);

                            foreach ($types as $type) {?>
                                <option value="<?php echo $type['id']; ?>"> <?php echo $type['tour_type']; ?> </option>
                                <?php
                            } ?>
                        </select>
                    </label>

                    <p>ტურის კატეგორია</p>
                    <label data-add-placeholder>
                        <select name="tour_category"">
                            <?php
                            $categories = getCategories($lang_key);

                            if(isset($_GET['type'])) {
                                $categories = getCategoriesByType($lang_key, $_GET['type']);
                                print_r($categories);
                            } ?>

                            <option value="-1"> ნებისმიერი </option>

                        <?php
                            foreach ($categories as $category) { ?>
                                    <option value="<?php echo $category['tour_category_id']; ?>"> <?php echo $category['tour_category']; ?> </option>
                                    <?php
                            }
                            ?>
                        </select>
                    </label>
                    <p>ქალაქი / ქალაქები: </p>
                    <label data-add-placeholder>
                        <input type="text"
                               name="tour_cities"/>
                    </label>
                    <p>ტურის სახელი:</p>
                    <label data-add-placeholder>
                        <input type="text"
                               name="tour_name"/>
                    </label>
                    <input type="hidden" name="lang" value="<?php echo $lang; ?>">
                    <div class="mfControls">
                        <button class="btn btn-sm btn-primary" type="submit" name="submit">ძებნა</button>
                    </div>
                    <div class="mfInfo"></div>
                </form>
                <!-- END RD Mailform -->
            </div>
        </section>
        <!-- Welcome -->

    </main>

    <h2 style="text-align: center"> ძებნის შედეგები </h2> <br>
    <a href="index.php" style="text-align: center"> <h6 style="text-align: center; color: grey"> მთავარ გვერდზე დაბრუნება </h6> </a>

    <?php
    $tours = $_SESSION['tours'];

    echo "sizeof(tours) ".sizeof($tours)."<br>";
    for ($i=0; $i < sizeof($tours); $i+=4) {
    ?>
        <section class="well-xs">
        <div class="container">
            <div class="row">
                <div class="col-md-2">

                </div>
                <div class="col-md-8 offset-2 text-lg-left text-center">
                    <div class="row">
                        <?php
                        if (sizeof($tours) > $i) {
                            $id = $tours[$i]['tour_id'];
                            $name = $tours[$i]['tour_name'];
                            $intro = $tours[$i]['tour_intro'];
                            $image = $tours[$i]['image_url']; ?>
                            <div class="col-md-6 col-sm-6">
                                <div class="box-skin-1">
                                    <img src="<?php echo $image; ?>"  alt="tour_image" width="100%" height="100%">
                                    <div>
                                        <h4 class="text-primary"><br><a href="tour_page.php?id=<?php echo $id; ?>&lang=<?php echo $lang; ?>"> <?php if (!empty($name)) { echo $name; } else { echo "This Tour hasn't been translated yet"; } ?> </a></h4>
                                        <p class="text-white" style="max-width: 40%; margin: auto">
                                            <?php echo $intro; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php }
                        if (sizeof($tours) > $i + 1) {
                            $id = $tours[$i + 1]['tour_id'];
                            $name = $tours[$i + 1]['tour_name'];
                            $intro = $tours[$i + 1]['tour_intro'];
                            $image = $tours[$i + 1]['image_url']; ?>
                            <div class="col-md-6 col-sm-6">
                                <div class="box-skin-1">
                                    <img src="<?php echo $image; ?>" alt="" width="370" height="357">
                                    <div>
                                        <h4 class="text-primary"><br><a href="tour_page.php?id=<?php echo $id; ?>&lang=<?php echo $lang; ?>"> <?php if (!empty($name)) { echo $name; } else { echo "This Tour hasn't been translated yet"; } ?> </a></h4>
                                        <p class="text-white">
                                            <?php echo $intro; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php }
                        if (sizeof($tours) > $i + 2) {
                            $id = $tours[$i + 2]['tour_id'];
                            $name = $tours[$i + 2]['tour_name'];
                            $intro = $tours[$i + 2]['tour_intro'];
                            $image = $tours[$i + 2]['image_url']; ?>
                            <div class="col-md-6 offset-3 col-sm-6">
                                <div class="box-skin-1">
                                    <img src="<?php echo $image; ?>" alt="" width="370" height="357">
                                    <div>
                                        <h4 class="text-primary"><br><a href="tour_page.php?id=<?php echo $id; ?>&lang=<?php echo $lang; ?>"> <?php if (!empty($name)) { echo $name; } else { echo "This Tour hasn't been translated yet"; } ?> </a></h4>
                                        <p class="text-white">
                                            <?php echo $intro; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        if (sizeof($tours) > $i + 3) {
                            $id = $tours[$i + 3]['tour_id'];
                            $name = $tours[$i + 3]['tour_name'];
                            $intro = $tours[$i + 3]['tour_intro'];
                            $image = $tours[$i + 3]['image_url']; ?>
                            <div class="col-md-6 offset-3 col-sm-6">
                                <div class="box-skin-1">
                                    <img src="<?php echo $image; ?>" alt="" width="370" height="357">
                                    <div>
                                        <h4 class="text-primary"><br><a href="tour_page.php?id=<?php echo $id; ?>&lang=<?php echo $lang; ?>"> <?php if (!empty($name)) { echo $name; } else { echo "This Tour hasn't been translated yet"; } ?> </a></h4>
                                        <p class="text-white">
                                            <?php echo $intro; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
        }
    ?>
    <!--========================================================
                              FOOTER
    ==========================================================-->
    <footer class="page-footer text-md-left text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <!-- RD Navbar Brand -->
                    <div class="rd-navbar-brand">
                        <a href="index.php" class="brand-name">
                            &#95;world<span class="text-primary">around</span>
                        </a>
                    </div>
                    <!-- END RD Navbar Brand -->
                    <div class="copyright">
                        &#169; <span id="copyright-year"></span> |
                        All rights reserved
                        <!-- {%FOOTER_LINK} -->
                    </div>
                </div>
                <div class="col-md-4">
                    <address class="contact-info">
                        <dl>
                            <dt>USA - LOS ANGELES,</dt>
                            <dt>901 East E Street, Wilmington, CA 90744</dt>
                            <dt>E -mail:<a href="mailto:#">mail@demolink.org</a></dt>
                            <dd>
                                <a href="callto:#">(800)<span>2345 6789</span></a>
                            </dd>
                        </dl>
                    </address>
                </div>
                <div class="col-md-4">
                    <ul class="inline-list text-center text-lg-left">
                        <li>
                            <a class="icon-xs fa-facebook" href="#"></a>
                        </li>
                        <li>
                            <a class="icon-xs fa-google-plus" href="#"></a>
                        </li>
                        <li>
                            <a class="icon-xs fa-linkedin" href="#"></a>
                        </li>
                        <li>
                            <a class="icon-xs fa-twitter" href="#"></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Coded by crash -->
    </footer>
</div>
<!-- Core Scripts -->
<script src="js/core.min.js"></script>
<!-- Additional Functionality Scripts -->
<script src="js/script.js"></script>
</body>
</html>
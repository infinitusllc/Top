﻿﻿<!DOCTYPE html>
<html lang="en" class="wide wow-animation">
<head>
    <!-- Site Title -->
    <title>Home</title>
    <meta name="format-detection" content="telephone=no" />
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />

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
            // document.getElementById("content-section").style.display = "none";
        }

        function closeNav() {
            document.getElementById("login-form").style.display = "none";
            // document.getElementById("content-section").style.display = "block";
        }

        function displayTypes(selectObject) {
            var value = selectObject.value;
            if (value === '-1') {
                window.location.href = 'index.php?';
            } else {
                window.location.href = 'index.php?category=' + value;
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
                     alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." />
            </a>
        </div>
        <!--END block for older internet explorer-->
        <!--========================================================
        HEADER
        =========================================================-->
        <div style="position: fixed; top: 0; background-color: lavender; width: 100%; height: 60px; z-index: 100">
            <section id="rd-topmenu">
                <div style="position: relative; bottom: 50px">
                    <!-- RD Mailform -->
                    <ul class="navbar-nav">
                        <li><a href="#news">ტურები</a></li>
                        <li><a href="#products">ჩვენს შესახებ</a></li>
                        <li><a href="#faculity-member">პარტნიორები</a></li>
                        <li><a href="#contact">  კონტაქტი </a></li>
                    </ul>
                    <ul class="navbar-flags">
                        <li><a href="index.php?lang=geo"> <img src="images/geo-scr.png"> </a></li>
                        <li><a href="index.php?lang=eng"> <img src="images/eng-scr.png"> </a></li>
                        <li><a href="index.php?lang=rus"> <img src="images/rus-scr.png"> </a></li>
                        <!-- <li><a href="index.php?lang=geo"> <img src="images/geo.png"> </a></li>
                        <li><a href="index.php?lang=eng"> <img src="images/eng.png"> </a></li>
                        <li><a href="index.php?lang=rus"> <img src="images/rus.png"> </a></li> -->
                    </ul>
                    <ul class="navbar-user" >
                        <li><a href="#"><span onclick="openNav()" class="material-icons-account_circle"></span></a></li>
                    </ul>

                </div>
        </div>

        <header class="page-header">
            <div class="container">
                <!-- RD Navbar Brand -->
                <div class="rd-navbar-brand">
                    <a href="index.php" class="brand-name primary-color" style="position: relative; top: 60px">
                        <img src="images/logo1.png" data-srcset-base="images/" data-srcset-ext="logo.png" alt="" width="322" height="100">
                    </a>
                    <!--<a href="index.php" class="brand-name primary-color">
                        &#95;world<span class="text-primary">around</span><span class="brand-slogan text-regular">travel operator</span>
                    </a>-->
                </div>
                <!-- END RD Navbar Brand -->

            </div>
        </header>
        <!--========================================================
        CONTENT
        =========================================================-->
        <main class="page-content" style="margin-top: 30px">
            <section>
                <!-- Swiper -->
                <div class="swiper-container swiper-slider" data-height="853px" data-min-height="500px" data-autoplay="false">
                    <div class="swiper-wrapper">
                        <?php
                            require_once "includes/slides.inc.php";
                            $slides = getSlides($lang);
                            $i = 1;
                            foreach ($slides as $slide) {
                                $img = $slide['image_url']; ?>
                        <div class="swiper-slide" data-slide-bg="<?php echo $img; ?>" style="background-image: url('<?php echo $img; ?>');">
                            <div class="swiper-slide-caption">
                                <div class="container">
                                    <div class="text-center text-lg-left">
                                        <div class="col-lg-3 col-md-12">
                                            <!-- <h2 class="text-bold"> <?php echo $i++; ?> </h2> -->
                                            <a href="<?php echo $slide['tour_url']; ?>"> <?php echo $slide['intro']; ?> </a>
                                        </div>
                                        <?php echo $slide['description']; ?>
                                        <!-- <div class="col-lg-4 col-md-12 offset-1 display_none">
                                            <h3 class="text-bold">ღირებულება 899 USD-დან</h3>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>

                    </div>
                    <!-- Slider Navigation -->
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
                <!-- END Swiper -->
                <div id="sc_down">
                    <a href="#ex1"><div class="mouse"></div></a>
					<a href="#ex1" class="mouse-hover"><div class="mouse"></div></a>
                </div>
            </section>

                <!-- END RD Mailform -->
            </section>
    <!-- Welcome -->
    <section class="well-welcome" id="ex1">
        <div class="container">
            <div class="row" style="text-align: center;">
                <!--<h2>საქართველო..</h2>
                    <h4>
                        <?php
                        include "includes/get_generics.inc.php";
                        echo $generics['about'][$lang_key]['title'];
                        ?>
                    </h4>-->
                    <?php echo $generics['about'][$lang_key]['intro']; ?>
                    <a class="btn-xs btn-default" href="generic_page.php?lang=<?php echo $lang_key; ?>&keyword=<?php echo $generics['about'][$lang_key]['keyword'];?>">- <?php echo $contents['read_more']; ?>..</a>
                <!--<div class="col-md-3 col-xs-6 col-md-preffix-1">
                    <ul class="marked-list">
                        <?php
                            foreach ($categories as $category) {
                        ?>
                        <li><a href="#">&#8212; <?php echo $category['tour_category']; ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="col-md-3 col-xs-6 col-md-preffix-1">
                    <ul class="marked-list">
                        <?php
                            foreach ($types as $type) {
                        ?>
                        <li><a href="#">&#8212; <?php echo $type['tour_type']; ?></a></li>
                        <?php } ?>
                    </ul>
                </div>-->
            </div>
        </div>
    </section>
    <!-- End Welcome -->



    <!-- Carousel -->
    <section class="well-sm">
        <div class="container">
            <!--<h2>New Tours</h2>-->
            <div class="owl-carousel" data-nav="true" data-items="1" data-loop="false">
                <?php
                    require_once "includes/events.inc.php";
                    $events = getEvents($lang_key);

                    foreach ($events as $event) {
                        $img_src = $event['image_url'];
                ?>
                    <div class="owl-item">
                        <img src="<?php echo $img_src ?>"  alt="" width="1170" height="451">
                        <div class="box-text">
                            <h3> <?php echo $event['title']; ?> </h3>
                            <p class="text-white">
                                <?php echo $event['intro']; ?>
                            </p>
                            <a class="btn btn-xs btn-default" href="generic_page.php?lang=<?php echo $lang_key; ?>&keyword=<?php echo $event['keyword'];?>">&#8212; სრულად ნახვა </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="carousel-counter-container">
                <div class="current-counter"></div>
                <div class="count">/</div>
                <div class="carousel-count"></div>
            </div>
            <div class="clear"></div>
        </div>
    </section>
    <!-- End Carousel -->



    <!-- Welcome -->
    <section class="well-md" id="ex1">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h2>საქართველო..</h2>
                    <h4>
                        <?php
                        include "includes/get_generics.inc.php";
                        echo $generics['about'][$lang_key]['title'];
                        ?>
                    </h4>
                    <p>
                        <?php echo $generics['about'][$lang_key]['intro']; ?>
                    </p>
                    <a class="btn btn-xs btn-default" href="generic_page.php?lang=<?php echo $lang_key; ?>&keyword=<?php echo $generics['about'][$lang_key]['keyword'];?>">- <?php echo $contents['read_more']; ?>..</a>
                </div>
                <div class="col-md-3 col-xs-6 col-md-preffix-1">
                    <ul class="marked-list">
                        <?php
                        foreach ($categories as $category) {
                        ?>
                        <li><a href="#">&#8212; <?php echo $category['tour_category']; ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="col-md-3 col-xs-6 col-md-preffix-1">
                    <ul class="marked-list">
                        <?php
                        foreach ($types as $type) {
                        ?>
                        <li><a href="#">&#8212; <?php echo $type['tour_type']; ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End Welcome -->
    <!-- List + Box-skin -->
    <section class="well-xs">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <?php
                        require_once "includes/categories.inc.php";

                        $types = getTypes($lang_key);
                        foreach ($types as $type) {
                            echo $type['tour_type'];
                            $categories = getCategoriesByType($lang_key, $type['group_id']);
                            ?>
                    <ul class="type-list" style="margin-bottom: 50px;">
                        <?php foreach ($categories as $category) { ?>
                            <li class="category-list-item"> <?php echo $category['tour_category']; ?> </li>
                        <?php } ?>
                    </ul>
                    <?php } ?>
                </div>
                <div class="col-md-8 offset-2 text-lg-left text-center">
                    <div class="row">
                        <?php
                        include 'includes/get_tour.inc.php';
                        $tour_ids = getLatestTourIds();

                        if (sizeof($tour_ids) > 0) {
                        $id = $tour_ids[0]['tour_id'];
                        $content = getTourContent($id, $lang);
                        $tour = getTour($id);
                        $images = getTourImages($id); ?>
                        <div class="col-md-6 col-sm-6">
                            <div class="box-skin-1">
                                <img src="<?php echo $images[0]['image_url']; ?>" alt="tour_image" width="100%" height="100%">
                                <div>
                                    <h4 class="text-primary"><br><a href="tour_page.php?id=<?php echo $id; ?>&lang=<?php echo $lang; ?>"> <?php if (!empty($content['tour_name'])) { echo $content['tour_name']; } else { echo "This Tour hasn't been translated yet"; } ?> </a></h4>
                                    <p class="text-white" style="max-width: 80%">
                                        <?php echo $content['tour_intro']; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <?php }
                        if (sizeof($tour_ids) > 1) {
                        $id = $tour_ids[1]['tour_id'];
                        $content = getTourContent($id, $lang);
                        $tour = getTour($id);
                        $images = getTourImages($id);
                        ?>
                        <div class="col-md-6 col-sm-6">
                            <div class="box-skin-1">
                                <img src="<?php echo $images[0]['image_url']; ?>" alt="" width="370" height="357">
                                <div>
                                    <h4 class="text-primary"><br><a href="tour_page.php?id=<?php echo $id; ?>&lang=<?php echo $lang; ?>"> <?php if (!empty($content['tour_name'])) { echo $content['tour_name']; } else { echo "This Tour hasn't been translated yet"; } ?> </a></h4>
                                    <p class="text-white">
                                        <?php echo $content['tour_intro']; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <?php }
                        if (sizeof($tour_ids) > 2) {
                        $id = $tour_ids[2]['tour_id'];
                        $content = getTourContent($id, $lang);
                        $tour = getTour($id);
                        $images = getTourImages($id);
                        ?>
                        <div class="col-md-6 offset-3 col-sm-6">
                            <div class="box-skin-1">
                                <img src="<?php echo $images[0]['image_url']; ?>" alt="" width="370" height="357">
                                <div>
                                    <h4 class="text-primary"><br><a href="tour_page.php?id=<?php echo $id; ?>&lang=<?php echo $lang; ?>"> <?php if (!empty($content['tour_name'])) { echo $content['tour_name']; } else { echo "This Tour hasn't been translated yet"; } ?> </a></h4>
                                    <p class="text-white">
                                        <?php echo $content['tour_intro']; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        if (sizeof($tour_ids) > 3) {
                        $id = $tour_ids[3]['tour_id'];
                        $content = getTourContent($id, $lang);
                        $tour = getTour($id);
                        $images = getTourImages($id);
                        ?>
                        <div class="col-md-6 offset-3 col-sm-6">
                            <div class="box-skin-1">
                                <img src="<?php echo $images[0]['image_url']; ?>" alt="" width="370" height="357">
                                <div>
                                    <h4 class="text-primary"><br><a href="tour_page.php?id=<?php echo $id; ?>&lang=<?php echo $lang; ?>"> <?php if (!empty($content['tour_name'])) { echo $content['tour_name']; } else { echo "This Tour hasn't been translated yet"; } ?> </a></h4>
                                    <p class="text-white">
                                        <?php echo $content['tour_intro']; ?>
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
    <!-- End List + Box-skin -->
    <!-- Index-list -->
    <section class="well-xs">
        <div class="container">
            <ul class="row index-list">
                <li class="col-md-4">
                    <h4>
                        Construct your own tour
                        with our Tour Builder
                    </h4>
                    <p>
                        Now you can build and customize
                        your very own tour that will meet all
                        your needs and requirements. With
                        the help of our brand new online tour
                        builder you will be able to add or
                        remove any tour features except the
                        crucial ones. Thanks to the modular
                        system, the process is fast and easy.
                    </p>
                    <a class="btn btn-xs btn-default" href="#">&#8212; read more</a>
                </li>
                <li class="col-md-4">
                    <h4>
                        Browse our most popular
                        tours
                    </h4>
                    <p>
                        We prepared a digest of our most
                        demanded offers to help you
                        decide. Included are the tours that
                        received the highest score from our
                        clients. Here you will find the most
                        popular cruises, beach resorts,
                        safaris and culinary travel programs.
                    </p>
                    <a class="btn btn-xs btn-default" href="#">&#8212; read more</a>
                </li>
                <li class="col-md-4">
                    <h4>
                        Meet our professional team of travel agents.
                    </h4>
                    <p>
                        Our agents have 21 years of
                        experience on the average, and more
                        than 500 years in total. They are
                        professionals, whose main goal is to
                        make your trip unforgettable. Our
                        travel advisors are ready to help you
                        today with everything you need
                        to travel.
                    </p>
                    <a class="btn btn-xs btn-default" href="#">&#8212; read more</a>
                </li>
            </ul>
        </div>
    </section>
    <!-- End Index-list -->
    <!-- RD Google Map -->
    <div class="rd-google-map margin-negative-top box-hover">
        <div id="google-map" class="rd-google-map__model"></div>
        <ul class="rd-google-map__locations">
            <li data-x="-73.9898268" data-y="40.649980" data-basic="images/gmap_marker.png"
                data-active="images/gmap_marker_active.png">
                <p>
                    8901 Marmora Road, Glasgow,D04 89GR.
                </p>
            </li>
        </ul>
    </div>
    <!-- End RD Google Map -->
    </main>
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
    </div>
    <!-- Core Scripts -->
    <script src="js/core.min.js"></script>
    <!-- Additional Functionality Scripts -->
    <script src="js/script.js"></script>
</body>
</html>
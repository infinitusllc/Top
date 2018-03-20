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
        function displayTypes(selectObject) {
            var value = selectObject.value;
            window.location.href = 'index.php?category=' + value;
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
<!-- The Main Wrapper -->
<div class="page">

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

            <!-- bonus header -->
            <div style="position:relative; left: 40%; padding: 5px;">
                <?php if (!isset($_SESSION["logged"]) || $_SESSION["logged"] == false) { ?>
                    <form id="login_form" action="includes/login.inc.php" method="post"
                          style="display: inline-block; margin: 5px">
                        <input type="text" name="e_mail" placeholder="e-mail"/>
                        <input type="password" name="password" placeholder="password"/>
                        <button type="submit" class="button sub" name="submit"> შესვლა</button>
                    </form>

                    <form action="registration.php" style="display: inline-block; margin: 5px">
                        <input type="submit" value="რეგისტრაცია" />
                    </form>

                <?php } else { ?>
                    <p style="display: inline-block; margin: 5px"> <span style="font-weight:none"> <?php echo $contents['main_page_username']; ?> </span> <?php echo $_SESSION['user']['name']; ?> </p>
                    <form action="profile.php" style="display: inline-block; margin: 5px">
                        <input type="submit" value="ჩემი პროფილი" />
                    </form>
                    <?php if ($_SESSION['user']['is_admin'] == 1) { ?>
                        <form action="admin.php" style="display: inline-block; margin: 5px">
                            <input type="submit" value="ადმინის პანელი" />
                        </form>
                    <?php } ?>
                    <form action="includes/logout.inc.php" style="display: inline-block; margin: 5px">
                        <input type="submit" value="გამოსვლა" />
                    </form>
                <?php } ?>
                <a href="index.php?lang=geo"> <img src="images/geo.png"> </a>
                <a href="index.php?lang=eng"> <img src="images/eng.png"> </a>
                <a href="index.php?lang=rus"> <img src="images/rus.png"> </a>

            </div>

        <!-- Swiper -->
		<div class="swiper-container swiper-slider" data-height="853px" data-min-height="500px" data-autoplay="false">
            <div class="swiper-wrapper">
                <div class="swiper-slide" data-slide-bg="images/page-01_slide01.jpg" style="background-image: url('images/page-01_slide01.jpg');">
                    <div class="swiper-slide-caption">
                        <div class="container">
                            <div class="row text-center text-lg-left">
                                <div class="col-lg-3 col-md-12 preffix-1">
                                    <h2 class="text-bold">01/</h2>
                                    <h2 class="text-bold">გერგეთი</h2>
                                    <p>
                                        6-7 ღამე, ბილეთების საფასური,<br>
                                        3-5 ვარსკვლავიანი სასტუმროები
                                    </p>
                                    <h4>
                                        ქართლი, ყაზბეგის რაიონი,<br>
                                        გერგეთი, სნო, მყინვარი...
                                    </h4>
                                </div>
                                <div class="col-lg-4 col-md-12 offset-1 display_none">
                                    <p>
                                        შესანიშნავი ბუნება, დაუვიწყარი სანახაობა და სიმაღლეები. სათხილამურო ტრასები და სრული მომსახურება, ტრანსპორტირება და დაბინავება.
                                        თქვენ შესაძლებლობა გეძლევათ იხილოთ<br>
                                        უმშვენიერესი მწვერვალები. 
                                    </p>
                                    <h3 class="text-bold">ღირებულება 899 USD-დან</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide" data-slide-bg="images/page-01_slide02.jpg"  style="background-image: url('images/page-01_slide02.jpg');">
                    <div class="swiper-slide-caption">
                        <div class="container">
                            <div class="row text-center text-lg-left">
                                <div class="col-lg-3 col-md-12 preffix-1">
                                    <h2 class="text-bold">02/</h2>
                                    <h2 class="text-bold">UK</h2>
                                    <p>
                                        6-7 nights, airfare,<br>
                                        3-5 star hotels
                                    </p>
                                    <h4>
                                        London, Liverpool,<br>
                                        Edinburgh...
                                    </h4>
                                </div>
                                <div class="col-lg-4 col-md-12 offset-1 display_none">
                                    <p>
                                        We handpicked hundreds of the most spectacular destinations on all 
                                        continents. Relax your body and 
                                        soul in the most remote corners <br>
                                        of the world. 
                                    </p>
                                    <h3 class="text-bold">from 799USD</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide" data-slide-bg="images/page-01_slide03.jpg"  style="background-image: url('images/page-01_slide03.jpg');">
                    <div class="swiper-slide-caption">
                        <div class="container">
                            <div class="row text-center text-lg-left">
                                <div class="col-lg-3 col-md-12 preffix-1">
                                    <h2 class="text-bold">03/</h2>
                                    <h2 class="text-bold">Islands</h2>
                                    <p>
                                        6-7 nights, airfare,<br>
                                        3-5 star hotels
                                    </p>
                                    <h4>
                                        Bora-Bora, Hawaii,<br>
                                        Maldives...
                                    </h4>
                                </div>
                                <div class="col-lg-4 col-md-12 offset-1 display_none">
                                    <p>
                                        We handpicked hundreds of the most spectacular destinations on all 
                                        continents. Relax your body and 
                                        soul in the most remote corners <br>
                                        of the world. 
                                    </p>
                                    <h3 class="text-bold">from 699USD</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide" data-slide-bg="images/page-01_slide04.jpg" style="background-image: url('images/page-01_slide04.jpg');">
                    <div class="swiper-slide-caption">
                        <div class="container">
                            <div class="row text-center text-lg-left">
                                <div class="col-lg-3 col-md-12 preffix-1">
                                    <h2 class="text-bold">01/</h2>
                                    <h2 class="text-bold">China</h2>
                                    <p>
                                        6-7 nights, airfare,<br>
                                        3-5 star hotels
                                    </p>
                                    <h4>
                                        Beijing, Shanghai,<br>
                                        Xi'an, Tibet ...
                                    </h4>
                                </div>
                                <div class="col-lg-4 col-md-12 offset-1 display_none">
                                    <p>
                                        We handpicked hundreds of the most spectacular destinations on all
                                        continents. Relax your body and
                                        soul in the most remote corners <br>
                                        of the world.
                                    </p>
                                    <h3 class="text-bold">from 899 USD</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--<div class="swiper-slide" data-slide-bg="images/page-01_slide05.jpg">
                    <div class="swiper-slide-caption">
                        <div class="container">
                            <div class="row text-center text-lg-left">
                                <div class="col-lg-3 col-md-12 preffix-1">
                                    <h2 class="text-bold">02/</h2>
                                    <h2 class="text-bold">UK</h2>
                                    <p>
                                        6-7 nights, airfare,<br>
                                        3-5 star hotels
                                    </p>
                                    <h4>
                                        London, Liverpool,<br>
                                        Edinburgh...
                                    </h4>
                                </div>
                                <div class="col-lg-4 col-md-12 offset-1 display_none">
                                    <p>
                                        We handpicked hundreds of the most spectacular destinations on all
                                        continents. Relax your body and
                                        soul in the most remote corners <br>
                                        of the world.
                                    </p>
                                    <h3 class="text-bold">from 799USD</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>-->
                <div class="swiper-slide" data-slide-bg="images/page-01_slide07.jpg" style="background-image: url('images/page-01_slide07.jpg');">
                    <div class="swiper-slide-caption">
                        <div class="container">
                            <div class="row text-center text-lg-left">
                                <div class="col-lg-3 col-md-12 preffix-1">
                                    <h2 class="text-bold">03/</h2>
                                    <h2 class="text-bold">Islands</h2>
                                    <p>
                                        6-7 nights, airfare,<br>
                                        3-5 star hotels
                                    </p>
                                    <h4>
                                        Bora-Bora, Hawaii,<br>
                                        Maldives...
                                    </h4>
                                </div>
                                <div class="col-lg-4 col-md-12 offset-1 display_none">
                                    <p>
                                        We handpicked hundreds of the most spectacular destinations on all
                                        continents. Relax your body and
                                        soul in the most remote corners <br>
                                        of the world.
                                    </p>
                                    <h3 class="text-bold">from 699USD</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Slider Navigation -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
        <!-- END Swiper -->
        <div id="sc_down">
          <a class="btn" href="#ex1">ჩასქროლე</a>
        </div>
    </section>
    <section>
       <div class="container">
        <!-- RD Mailform -->
        <form class='rd-mailform1' method="post" action="bat/rd-mailform.php">
            <!-- RD Mailform Type -->
            <input type="hidden" name="form-type" value="contact"/>
            <!-- END RD Mailform Type -->

                <a href="index.php" class="brand-name primary-color">
					<img src="images/logo.png" data-srcset-base="images/" data-srcset-ext="logo.png" alt="" width="100" height="100">
				</a>
                <!--<h4 class="text-bold">მოძებნე ტური</h4>-->
                <p>ტურის კატეგორია</p>
                <label data-add-placeholder>
                    <select name="tour_category" onchange="displayTypes(this)">
                        <?php
                            require_once "includes/categories.inc.php";
                            $categories = getCategories($lang_key);
                            foreach ($categories as $category) {
                                ?>
                                <option value="<?php echo $category['tour_category_id']; ?>"> <?php echo $category['tour_category']; ?> </option>
                                <?php
                            }
                        ?>
                    </select>
                </label>
                <p>ტურის ტიპი</p>
                <label data-add-placeholder>
                    <select name="gender">
                        <?php
                        $types = getTypes($lang_key);
                        foreach ($types as $type) {
                            ?>
                            <option value="<?php echo $type['id']; ?>"> <?php echo $type['tour_type']; ?> </option>
                            <?php
                        }
                        ?>
                    </select>
                </label>
                <p>ქალაქი / ქალაქები: </p>
                <label data-add-placeholder>
                    <input type="text"
                           name="cities"
                           data-placeholder="ყაზბეგი"/>
                </label>
                <p>ტურის სახელი:</p>
                <label data-add-placeholder>
                    <input type="text"
                           name="tour_name"
                           data-placeholder="თბილისის ტური"/>
                </label>
                <div class="mfControls">
                    <button class="btn btn-sm btn-primary" type="submit">ძებნა</button>
                </div>
                <div class="mfInfo"></div>

        </form>
        <!-- END RD Mailform -->
    </div>
</section>
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
                        <ul class="list1 text-sm-left text-center">
                            <li>
                                <span class="icon-lg material-icons-explore"></span>
                                <h2> 
                                    <a href="#">ჩვენი<br/>მხარდაჭერა
                                   </a>
                               </h2>
                           </li>
                            <li>
                                <span class="icon-lg material-icons-drafts"></span>
                                <h2> <a href="#">გამოწერე<br/>ჩვენი სიახლეები</a></h2>
                            </li>
                            <li>
                                <span class="icon-lg material-icons-mouse"></span>
                                <h2> <a href="#">გააკეთე<br/>რეზერვაცია</a></h2>
                            </li>
                            <li>
                                <span class="icon-lg material-icons-assignment"></span>
                                <h2> <a href="#">დარეგისტრირდი<br/>გახდი მოგზაური</a></h2>
                            </li>
                        </ul>
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
                                    $images = getTourImages($id);
                            ?>
                                <div class="col-md-6 col-sm-6">
                                    <div class="box-skin-1">
                                        <img src="<?php echo $images[0]['image_url']; ?>"  alt="tour_image" width="100%" height="100%">
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
        <!-- Carousel -->
        <section class="well-sm">
            <div class="container">
                <h2>New Tours</h2>
                <div class="owl-carousel" data-nav="true" data-items="1" data-loop="false">
                    <div class="owl-item">
                        <img src="images/lg_page-1_img05.jpg" data-srcset-base="images/" data-srcset-ext="_page-1_img05.jpg" data-srcset="lg 991w, md 1199w, lg 1400w" alt="" width="1170" height="451">
                        <div class="box-text">
                            <h3>Spain tours</h3>
                            <p class="text-white">
                                If passion is what you're after, Spain is the answer. With sultry Flamenco shows, mouthwatering tapas, and the luxury of private guide, you'll discover a new rhythm of
                                life.
                            </p>
                            <a class="btn btn-xs btn-default" href="#">&#8212; view tours</a>
                        </div>
                    </div>
                    <div class="owl-item">
                        <img src="images/lg_page-1_img06.jpg" data-srcset-base="images/" data-srcset-ext="_page-1_img06.jpg" data-srcset="lg 991w, md 1199w, lg 1400w" alt="" width="1170" height="451">
                        <div class="box-text">
                            <h3>Thailand tours</h3>
                            <p class="text-white">
                                Venture deep into the jungle to lost cities and experience the kaleidoscope that is Bangkok with private guide and then relax on serene beaches. A gateway to all South 
                                East Asia, Thailand awaits.
                            </p>
                            <a class="btn btn-xs btn-default" href="#">&#8212; view tours</a>
                        </div>
                    </div>
                    <div class="owl-item">
                        <img src="images/lg_page-1_img07.jpg" data-srcset-base="images/" data-srcset-ext="_page-1_img07.jpg" data-srcset="lg 991w, md 1199w, lg 1400w" alt="" width="1170" height="451">
                        <div class="box-text">
                            <h3>Italy tours</h3>
                            <p class="text-white">
                                So rich in historic, cultural, and gastronomic treasures, 
                                the only way to experience Italy is your way – 
                                with private guide and an itinerary perfectly 
                                matched to your passions.
                            </p>
                            <a class="btn btn-xs btn-default" href="#">&#8212; view tours</a>
                        </div>
                    </div>
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
<!-- Core Scripts -->
<script src="js/core.min.js"></script>
<!-- Additional Functionality Scripts -->
<script src="js/script.js"></script>
</body>
</html>
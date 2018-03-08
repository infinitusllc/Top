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
            <div class="rd-navbar-brand">
                <a href="index.php" class="brand-name primary-color">
                    &#95;world<span class="text-primary">around</span><span class="brand-slogan text-regular">travel operator</span>
                </a>
           </div>
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
                    <p style="display: inline-block; margin: 5px"> <span style="font-weight:bold"> მომხმარებელი: </span> <?php echo $_SESSION['user']['name']; ?> </p>
                    <form action="profile.php" style="display: inline-block; margin: 5px">
                        <input type="submit" value="ჩემი პროფილი" />
                    </form>
                    <form action="admin.php" style="display: inline-block; margin: 5px">
                        <input type="submit" value="ადმინის პანელი" />
                    </form>
<!--                    <form action="addTour.php" style="display: inline-block; margin: 5px">-->
<!--                        <input type="submit" value="ტურის დამატება" />-->
<!--                    </form>-->
                    <form action="includes/logout.inc.php" style="display: inline-block; margin: 5px">
                        <input type="submit" value="გამოსვლა" />
                    </form>
                <?php } ?>


                <select id="langChange" style="margin: 5px; display: inline-block; padding:3px;
    margin: 0; width: 300px; height:40px;
    -webkit-border-radius:4px;
    -moz-border-radius:4px;
    border-radius:4px;
    -webkit-box-shadow: 0 3px 0 #ccc, 0 -1px #fff inset;
    -moz-box-shadow: 0 3px 0 #ccc, 0 -1px #fff inset;
    box-shadow: 0 3px 0 #ccc, 0 -1px #fff inset;
    background: #f8f8f8;
    color:#888;
    border:none;
    outline:none;
    display: inline-block;
    -webkit-appearance:none;
    -moz-appearance:none;
    appearance:none;
    cursor:pointer;" onchange="changeLanguage(this)">
                    <?php
                    $language_links_array = [];
                    $language_links_array['geo'] = "<option value=\"geo\"> ქართული </option>";
                    $language_links_array['eng'] = "<option value=\"eng\">English</option>";

                    switch ($lang) {
                        case "geo":
                            echo $language_links_array['geo'];
                            foreach ($language_links_array as $item){
                                if ($item != "<option value=\"geo\"> ქართული </option>")
                                    echo $item;
                            }
                            break;
                        case "eng":
                            echo $language_links_array['eng'];
                            foreach ($language_links_array as $item){
                                if ($item != "<option value=\"eng\">English</option>")
                                    echo $item;
                            }
                    }
                    ?>
                </select>
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
        <form class='rd-mailform rd-mailform1' method="post" action="bat/rd-mailform.php">
            <!-- RD Mailform Type -->
            <input type="hidden" name="form-type" value="contact"/>
            <!-- END RD Mailform Type -->
            <fieldset>
                <img src="images/logo_toptravel.png" data-srcset-base="images/" data-srcset-ext="logo_toptravel.png" alt="" width="234" height="54">
                <!--<h4 class="text-bold">მოძებნე ტური</h4>-->
                <p>ტურის მიმართულება</p>
                <label data-add-placeholder>
                    <select name="gender">
                        <option>ქვეყანა</option>
                        <option>America</option>
                        <option>Canada</option>
                        <option>Mexico</option>
                    </select>
                </label>
                <p>ტურის ტიპი</p>
                <label data-add-placeholder>
                    <select name="gender">
                        <option>შიდა/გარე</option>
                        <option>Business tour</option>
                        <option>Family tour</option>
                        <option>Group tour</option>
                    </select>
                </label>
                <p>სავარაუდო თარიღი</p>
                <label data-add-placeholder>
                    <input type="date"
                           name="birthday"
                           data-placeholder="დდ / თთ / წწ"
                           data-constraints="@Date"/>
                </label>
                <p>ხანგრძლივობა</p>
                <label data-add-placeholder>
                    <input type="date"
                           name="birthday"
                           data-placeholder="დდ / თთ / წწ"
                           data-constraints="@Date"/>
                </label>
                <div class="mfControls">
                    <button class="btn btn-sm btn-primary" type="submit">ძებნა</button>
                </div>
                <div class="mfInfo"></div>
            </fieldset>
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
                            დაუვიწყარი კულტურა, ხალხი, გარემო, ქვეყანა...
                        </h4>
                        <p>
                            There is nothing better than spending your free time with family or friends while traveling. Book one of our tours and save more than $200 on each member. Our turnkey travel solutions include full insurance, guided and escorted tour vacations, accommodation in best hotels and custom features that you can choose yourself.
                        </p>
                        <a class="btn btn-xs btn-default" href="#">&#8212; read more</a>
                    </div>
                    <div class="col-md-3 col-xs-6 col-md-preffix-1">
                        <ul class="marked-list">
                            <li><a href="#">&#8212; Asia-Pacific</a></li>
                            <li><a href="#">&#8212; France</a></li>
                            <li><a href="#">&#8212; Italy</a></li>
                            <li><a href="#">&#8212; Spain</a></li>
                            <li><a href="#">&#8212; Rest of Europe</a></li>
                            <li><a href="#">&#8212; Africa &#38; Middle East</a></li>
                            <li><a href="#">&#8212; North America</a></li>
                            <li><a href="#">&#8212; Latin America</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-xs-6 col-md-preffix-1">
                        <ul class="marked-list">
                            <li><a href="#">&#8212; Biking</a></li>
                            <li><a href="#">&#8212; Walking</a></li>
                            <li><a href="#">&#8212; Family</a></li>
                            <li><a href="#">&#8212; Food + Wine</a></li>
                            <li><a href="#">&#8212; Multi-Active</a></li>
                            <li><a href="#">&#8212; Wildlife</a></li>
                            <li><a href="#">&#8212; Corporate</a></li>
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
                                    <a href="#">ჩვენი<br/>მხარდაწერა
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
                            <div class="col-md-6 col-sm-6">
                                <div class="box-skin-1">
                                    <img src="images/lg_page-1_img01.jpg" data-srcset-base="images/" data-srcset-ext="_page-1_img01.jpg" data-srcset="lg 991w, md 1199w, lg 1400w" alt="" width="370" height="357">
                                    <div>
                                        <h4 class="text-primary">01/<br><a href="#">Culinary travel</a></h4>
                                        <p class="text-white">
                                            Best cuisines of the world<br>are opened to you.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="box-skin-1">
                                    <img src="images/lg_page-1_img02.jpg" data-srcset-base="images/" data-srcset-ext="_page-1_img02.jpg" data-srcset="lg 991w, md 1199w, lg 1400w" alt="" width="370" height="357">
                                    <div>
                                        <h4 class="text-primary">02/<br><a href="#">Honeymoons</a></h4>
                                        <p class="text-white">
                                            Romantic voyages for two.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 offset-3 col-sm-6">
                                <div class="box-skin-1">
                                    <img src="images/lg_page-1_img03.jpg" data-srcset-base="images/" data-srcset-ext="_page-1_img03.jpg" data-srcset="lg 991w, md 1199w, lg 1400w" alt="" width="370" height="357">
                                    <div>
                                        <h4 class="text-primary">03/<br><a href="#">Customizable tours</a></h4>
                                        <p class="text-white">
                                            Build your perfect tour yourself.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 offset-3 col-sm-6">
                                <div class="box-skin-1">
                                    <img src="images/lg_page-1_img04.jpg" data-srcset-base="images/" data-srcset-ext="_page-1_img04.jpg" data-srcset="lg 991w, md 1199w, lg 1400w" alt="" width="370" height="357">
                                    <div>
                                        <h4 class="text-primary">04/<br><a href="#">Luxury hotels</a></h4>
                                        <p class="text-white">
                                            Top-grade suites for the most<br>demanding travelers.
                                        </p>
                                    </div>
                                </div>
                            </div>
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
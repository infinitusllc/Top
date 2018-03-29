﻿<!DOCTYPE html>
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

        $_SESSION['lang'] = $lang;
        $_SESSION['lang_key'] = $lang_key;

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
		<section class="page-header">
			<div class="container">
				<!-- RD Navbar Brand -->
				<ul class="rd-navbar-brand">
					<a href="index.php" class="brand-name primary-color">
						<img src="images/logo.png" data-srcset-base="images/" data-srcset-ext="logo1.png" alt="" width="100" height="100">
					</a>
				</ul>
				<ul class="navbar-nav">
					<li><a href="#news">ტურები</a></li>
					<li><a href="#products">ჩვენს შესახებ</a></li>
					<li><a href="#faculity-member">პარტნიორები</a></li>
					<li><a href="#contact">კონტაქტი</a></li>
				</ul>
				<ul class="navbar-flags">
					<li><a href="index.php?lang=geo"> <img src="images/geo-scr.png"> </a></li>
					<li><a href="index.php?lang=eng"> <img src="images/eng-scr.png"> </a></li>
					<li><a href="index.php?lang=rus"> <img src="images/rus-scr.png"> </a></li>
					<!-- <li><a href="index.php?lang=geo"> <img src="images/geo.png"> </a></li>
					<li><a href="index.php?lang=eng"> <img src="images/eng.png"> </a></li>
					<li><a href="index.php?lang=rus"> <img src="images/rus.png"> </a></li> -->
				</ul>
				<ul class="navbar-user">
					<li>
					<li><a href="#"><span onclick="openNav()" class="material-icons-account_circle"></span></a></li>
					</li>
				</ul>
				<!-- END RD Navbar Brand -->
			</div>
		</section>
    
		<!--========================================================
		CONTENT
		=========================================================-->
		<?php include "mods/slide_display.mod.php"; ?>
    
	<!-- Welcome -->
	<section class="well-welcome" id="ex1">
		<div class="container">
			<div>
				<?php
				include "includes/get_generics.inc.php";
				echo $generics['about'][$lang_key]['intro']; ?>
				<a class="btn btn-xs btn-default" href="generic_page.php?lang=<?php echo $lang_key; ?>&keyword=<?php echo $generics['about'][$lang_key]['keyword'];?>">- <?php echo $contents['read_more']; ?>..</a>
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
		<!-- Index-list -->
	<section class="well-xs">
		<div class="container">
			<ul class="row list2">
				<li class="col-md-3">
					<span class="icon-lg material-icons-assignment"></span>
					<h2> <a href="#">დარეგისტრირდი<br />გახდი მოგზაური</a></h2>
				</li>
				<li class="col-md-3">
					<span class="icon-lg material-icons-mouse"></span>
					<h2> <a href="#">გააკეთე<br />რეზერვაცია</a></h2>
				</li>
				<li class="col-md-3">
					<span class="icon-lg material-icons-drafts"></span>
					<h2> <a href="#">გამოწერე<br />ჩვენი სიახლეები</a></h2>
				</li>
				<li class="col-md-3">
					<span class="icon-lg material-icons-explore"></span>
					<h2><a href="#">ჩვენი<br />მხარდაჭერა</a></h2>
				</li>
			</ul>
		</div>
	</section>
	<!-- End Index-list -->
	<!-- List + Box-skin -->
	<section class="well-xs">
		<div class="container">
			<div class="row">
				<div class="col-md-4 category">
					<?php
						require_once "includes/categories.inc.php";

						$types = getTypes($lang_key);
						foreach ($types as $type) {?>
							<form id="<?php echo $type['tour_type'].'_tours'; ?>" method="post" action="includes/tour_search.inc.php">
								<input type="hidden" name="tour_type" value="<?php echo $type['id']; ?>">
								<h4> <a href="#" onclick="document.getElementById(<?php echo "'".$type['tour_type']."_tours'"; ?>).submit();"><?php echo $type['tour_type']; ?></a></h4>
							</form>
						<?php
							$categories = getCategoriesByType($lang_key, $type['group_id']);
							?>
					<ul class="type-list">
						<?php foreach ($categories as $category) { ?>
							<form id="<?php echo $category['tour_category'].'_category'; ?>" method="post" action="includes/tour_search.inc.php">
								<input type="hidden" name="tour_category" value="<?php echo $category['tour_category_id']; ?>">
								<input type="hidden" name="tour_type" value="<?php echo $type['id']; ?>">
								<li class="category-list-item">- <a href="#" onclick="document.getElementById(<?php echo "'".$category['tour_category']."_category'"; ?>).submit();"> <?php echo $category['tour_category']; ?> </a> </li>
							</form>
						<?php } ?>
					</ul>
					<?php } ?>
				</div>
				<div class="col-md-8 offset-2 text-lg-left">
					<!-- <form id="all-tours" method="post" action="includes/tour_search.inc.php">
						<h4 style="text-align: center"> <a href="#" onclick="document.getElementById('all-tours').submit();">ტურები</a></h4>
					</form> -->
					<div class="row">
						<?php
						include 'includes/get_tour.inc.php';
						$tour_ids = getRecommendedTourIds(6);

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
							<div class="col-md-6 offset-3 col-sm-6" style="margin-bottom: 30px">
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
						<?php } if (sizeof($tour_ids) > 3) {
							$id = $tour_ids[3]['tour_id'];
							$content = getTourContent($id, $lang);
							$tour = getTour($id);
							$images = getTourImages($id);
							?>
							<div class="col-md-6 offset-3 col-sm-6" style="margin-bottom: 30px">
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
						<?php } if (sizeof($tour_ids) > 4) {
							$id = $tour_ids[4]['tour_id'];
							$content = getTourContent($id, $lang);
							$tour = getTour($id);
							$images = getTourImages($id);
							?>
							<div class="col-md-6 offset-6 col-sm-6">
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
						<?php }  if (sizeof($tour_ids) > 5) {
							$id = $tour_ids[5]['tour_id'];
							$content = getTourContent($id, $lang);
							$tour = getTour($id);
							$images = getTourImages($id);
							?>
							<div class="col-md-6 offset-6 col-sm-6">
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
	<!-- RD Google Map -->
	<div class="rd-google-map margin-negative-top box-hover">
		<div id="google-map" class="rd-google-map__model">
			<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d5955.91202732794!2d44.739061!3d41.721468!3m2!1i1024!2i768!4f13.1!4m3!3e6!4m0!4m0!5e0!3m2!1sen!2sge!4v1522321811424" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
		</div>
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

        <!-- REVIEW FORM -->
        <form id="review-form" action="includes/make_review.inc.php" method="post" accept-charset="UTF-8"
              style="text-align: center; margin-bottom: 20px; margin-top: 100px">
            <h3 style="color: darkgray; margin-bottom: 10px;"> დაგვიტოვეთ რევიუ </h3>
            <p> ი-მეილი: </p>
            <input name="e_mail" style="border: solid grey; outline: grey">
            <p> საკითხი: </p>
            <input name="subject" style="border: solid grey; outline: grey">
            <p> რევიუ: </p>
            <textarea name="review" style="border: solid grey; outline: grey; width: 40%; height: 200px"></textarea> <br><br>
            <input type="submit" name="submit" value="რევიუს დატოვება" style="outline: gray; border: solid gray; padding: 10px">
        </form>
        <!-- REVIEW FORM -->

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
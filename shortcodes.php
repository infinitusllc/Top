<?php
define("CSS_PATH", "css/");

$names = array(
    "Material icons", "Hotel pictograms", "Material design", "Linecons", "Sympletts",
    "Squared ui", "Soft icons", "Simpleicon communication",
    "Real estate", "Puppets", "Outicons", "Line ui",
    "Line icon set", "Justicons", "Icon works", "Great icon set",
    "Glypho", "Free chaos", "Flat icons set 2", "Fill round icons",
    "Dripicons", "Drawing tools", "Demo icons", "Crisp icons",
    "Continuous", "Clear icons", "Chapps", "Budicons launch", "Budicons free",
    "Bigmug line", "36 slim icons", "Beach icons", "Arrows", "Mercury icon pack", "Font awesome"
);

$packs = array(
    "material-icons", "hotel-icon", "material-design", "linecons", "fl-sympletts",
    "fl-squared-ui", "fl-soft-icons", "fl-simpleicon-communication",
    "fl-real-estate-3", "fl-puppets", "fl-outicons", "fl-line-ui",
    "fl-line-icon-set", "fl-justicons", "fl-icon-works", "fl-great-icon-set",
    "fl-glypho", "fl-free-chaos", "fl-flat-icons-set-2", "fl-fill-round-icons",
    "fl-dripicons", "fl-drawing-tools", "fl-demo-icons", "fl-crisp-icons",
    "fl-continuous", "fl-clear-icons", "fl-chapps", "fl-budicons-launch", "fl-budicons-free",
    "fl-bigmug-line", "fl-36-slim-icons", "beach-icons", "arrows", "mercury-icon", "fa"
);

$icons = array();

$di = new RecursiveDirectoryIterator(CSS_PATH);
$files = array();

foreach (new RecursiveIteratorIterator($di) as $filename => $file) {
    if (strpos($filename, ".css") > 0) {
        array_push($files, $filename);
    }
}

if (count($files) > 0) {
    foreach ($packs as $j => $pack){
        foreach ($files as $i => $filename) {
            $handle = fopen($filename, "r");
            $icons[$names[$j]] = array();

            while (($line = fgets($handle)) !== false) {
                if (preg_match("/\.(" . ( ($pack == "material-design") || ($pack == "hotel-pictograms") ? "(flaticon)|(material-design)" : $pack) . "-[\w\d_-]+)\:before\s*\{/i", $line, $result)) {
                    array_push($icons[$names[$j]], $result[1]);
                }
            }

            $bp = ceil(count($icons[$names[$j]]) / 3);
            fclose($handle);
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en" class="wide wow-animation">
<head>
    <!-- Site Title -->
    <title>Shortcodes</title>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="viewport"
          content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>

    <!-- Stylesheets -->
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/shortcodes.css">

    <!--[if lt IE 10]>
    <script src="js/html5shiv.min.js"></script>
    <![endif]-->
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
        <!-- Forms  -->
        <section class="well-sm text-center">
            <div class="container">
                <h3>Forms</h3>
                <h3>Subscribe Form</h3>
                <!-- RD Mailform -->
                <form class='rd-mailform' method="post" action="bat/rd-mailform.php">
                    <!-- RD Mailform Type -->
                    <input type="hidden" name="form-type" value="subscribe"/>
                    <!-- END RD Mailform Type -->
                    <fieldset>
                        <div class="row">
                            <div class="col-sm-4 col-sm-preffix-3">
                                <label data-add-placeholder data-add-icon>
                                    <input type="text"
                                           name="email"
                                           placeholder="Your email"
                                           data-constraints="@NotEmpty @Email"/>
                                </label>
                            </div>
                            <div class="col-sm-3 text-center text-sm-left">
                                <div class="mfControls btn-group mfControls1">
                                    <button class="btn btn-sm btn-primary" type="submit">Subscribe</button>
                                </div>
                            </div>
                        </div>

                        <div class="mfInfo"></div>
                    </fieldset>
                </form>
                <!-- END RD Mailform -->
            </div>

            <div class="container">
                <h3>Booking Form</h3>

                <div class="row row-xs-center">
                    <div class="col-sm-8">
                        <!-- RD Mailform -->
                        <form class='rd-mailform' method="post" action="bat/rd-mailform.php">
                            <!-- RD Mailform Type -->
                            <input type="hidden" name="form-type" value="order"/>
                            <!-- END RD Mailform Type -->
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label data-add-placeholder data-add-icon>
                                            <input type="text"
                                                   name="name"
                                                   placeholder="Full Name"
                                                   data-constraints="@NotEmpty @LettersOnly"/>
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <label data-add-placeholder data-add-icon>
                                            <input type="text"
                                                   name="email"
                                                   placeholder="Email"
                                                   data-constraints="@NotEmpty @Email"/>
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label data-add-placeholder data-add-icon>
                                            <input type="text"
                                                   name="guests"
                                                   placeholder="# of Guests"
                                                   data-constraints="@NotEmpty @NumbersOnly"/>
                                        </label>
                                    </div>
                                    <div class="col-md-4">
                                        <label data-add-placeholder data-add-icon>
                                            <input type="date"
                                                   name="date"
                                                   data-placeholder="Date"
                                                   data-constraints="@Date"
                                                />
                                        </label>
                                    </div>
                                    <div class="col-md-4">
                                        <label data-add-placeholder>
                                            <select name="time">
                                                <option>9:00</option>
                                                <option>14:00</option>
                                                <option>20:00</option>
                                            </select>
                                        </label>
                                    </div>
                                </div>

                                <div class="mfControls btn-group text-center">
                                    <button class="btn btn-sm btn-primary" type="submit">Submit</button>
                                    <button class="btn btn-sm btn-default" type="reset">Reset</button>
                                </div>
                                <div class="mfInfo"></div>
                            </fieldset>
                        </form>
                        <!-- END RD Mailform -->
                    </div>
                </div>
            </div>

            <div class="container">
                <h2>Contact Form</h2>

                <div class="row row-xs-center">
                    <div class="col-sm-8">
                        <!-- RD Mailform -->
                        <form class='rd-mailform' method="post" action="bat/rd-mailform.php">
                            <!-- RD Mailform Type -->
                            <input type="hidden" name="form-type" value="contact"/>
                            <!-- END RD Mailform Type -->
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label data-add-placeholder data-add-icon>
                                            <input type="text"
                                                   name="name"
                                                   placeholder="Your Name"
                                                   data-constraints="@NotEmpty @LettersOnly"/>
                                        </label>
                                    </div>
                                    <div class="col-md-4">
                                        <label data-add-placeholder data-add-icon>
                                            <input type="text"
                                                   name="email"
                                                   placeholder="Your Email"
                                                   data-constraints="@NotEmpty @Email"/>
                                        </label>
                                    </div>
                                    <div class="col-md-4">
                                        <label data-add-placeholder data-add-icon>
                                            <input type="text"
                                                   name="phone"
                                                   placeholder="Your Phone"
                                                   data-constraints="@Phone"/>
                                        </label>
                                    </div>
                                </div>

                                <label data-add-placeholder>
                           <textarea name="message" placeholder="Message"
                                     data-constraints="@NotEmpty"></textarea>
                                </label>

                                <div class="mfControls btn-group text-center">
                                    <button class="btn btn-sm btn-primary" type="submit">Submit</button>
                                    <button class="btn btn-sm btn-default" type="reset">Reset</button>
                                </div>
                                <div class="mfInfo"></div>
                            </fieldset>
                        </form>
                        <!-- END RD Mailform -->
                    </div>
                </div>
            </div>
        </section>
        <!-- END Forms -->

        <!-- Buttons -->
        <section class="well-sm text-center">
            <div class="container">
                <h2>Buttons Styles</h2>

                <div class="btn-group">
                    <div class="btn btn-sm btn-default"> <span class="icon fa-shopping-cart"></span> Buy Now</div>
                    <div class="btn btn-sm btn-primary"> <span class="icon fa-shopping-cart"></span> Buy Now</div>
                </div>
            </div>
            <div class="container">
                <h2>Buttons Sizing</h2>

                <div class="btn-group">
                    <div class="btn btn-xs btn-default"> <span class="icon fa-shopping-cart"></span> Buy Now</div>
                    <div class="btn btn-sm btn-default"> <span class="icon fa-shopping-cart"></span> Buy Now</div>
                    <div class="btn btn-md btn-default"> <span class="icon fa-shopping-cart"></span> Buy Now</div>
                    <div class="btn btn-lg btn-default"> <span class="icon fa-shopping-cart"></span> Buy Now</div>
                    <div class="btn btn-xl btn-default"> <span class="icon fa-shopping-cart"></span> Buy Now</div>
                </div>
            </div>
        </section>
        <!-- END Buttons-->
        <!-- RD Icons -->
        <section class="well-xs">
            <div class="container text-center">
                <h2>Icon Styles</h2>

                <ul class="inline-list">
                    <li>
                        <div class="icon icon-md icon-default fa-gears"></div>
                    </li>
                    <li>
                        <div class="icon icon-md icon-primary fa-gears"></div>
                    </li>
                </ul>
            </div>

            <div class="container text-center">
                <h2>Icon Sizing</h2>

                <ul class="inline-list">
                    <li>
                        <div class="icon icon-xs icon-primary fa-gears"></div>
                    </li>
                    <li>
                        <div class="icon icon-sm icon-primary fa-gears"></div>
                    </li>
                    <li>
                        <div class="icon icon-md icon-primary fa-gears"></div>
                    </li>
                    <li>
                        <div class="icon icon-lg icon-primary fa-gears"></div>
                    </li>
                    <li>
                        <div class="icon icon-xl icon-primary fa-gears"></div>
                    </li>
                </ul>
            </div>
        </section>
        <!-- END Icons-->
        <!-- Icons Fonts-->
        <section class="well-xs">
            <div class="container">
                <h2 class="text-center">Icon Fonts</h2>
                <div class="responsive-tabs responsive-tabs-variant-2">
                    <ul class="resp-tabs-list text-center">
                        <?php foreach ($icons as $i => $value) {
                            if (count($icons[$i]) > 0) { ?>
                                <li><span class="btn btn-sm btn-default"><?php echo $i; ?></span></li>
                            <?php }
                        } ?>
                    </ul>
                    <div class="resp-tabs-container">
                        <?php foreach ($icons as $i => $value) {
                            if (count($icons[$i]) > 0) { ?>
                                <div>
                                    <div class="row">
                                        <?php foreach ($icons[$i] as $j => $iconClass) { ?>
                                            <div class="col-xs-6 col-md-4 grid_4">
                                                <div class="icon-box <?php echo $iconClass; ?>"><?php echo $iconClass; ?></div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php }
                        } ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- END Icons -->
    </main>

    <!--========================================================
                              FOOTER
    =========================================================-->
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
                        <a href='index-5.html'>Privacy Policy</a>
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
    </footer>
</div>

<!-- Core Scripts -->
<script src="js/core.min.js"></script>
<!-- Additional Functionality Scripts -->
<script src="js/script.js"></script>
</body>
</html>
<?php

include "includes/get_generics.inc.php";

$lang_key = 1;

if (isset($_SESSION['lang_key'])) {
    $lang_key = $_SESSION['lang_key'];
}
?>

<section class="page-header">
    <div class="container">
        <!-- RD Navbar Brand -->
        <ul class="rd-navbar-brand">
            <a href="index.php" class="brand-name primary-color">
                <img src="images/logo.png" data-srcset-base="images/" data-srcset-ext="logo1.png" alt="" width="100" height="100">
            </a>
        </ul>
        <ul class="navbar-nav">
            <li><a href="#" onclick="document.getElementById('all-tours-hidden').submit();">ტურები</a></li>
            <li><a href="generic_page.php?lang=<?php echo $lang_key; ?>&keyword=<?php echo $generics['about'][$lang_key]['keyword'];?>">ჩვენს შესახებ</a></li>
            <li><a href="generic_page.php?lang=<?php echo $lang_key; ?>&keyword=<?php echo $generics['partners'][$lang_key]['keyword'];?>">პარტნიორები</a></li>
            <li><a href="generic_page.php?lang=<?php echo $lang_key; ?>&keyword=<?php echo $generics['contact'][$lang_key]['keyword'];?>">კონტაქტი</a></li>
        </ul>
        <ul class="navbar-flags">
            <li><a href="index.php?lang=geo"> <img src="images/geo-scr.png"> </a></li>
            <li><a href="index.php?lang=eng"> <img src="images/eng-scr.png"> </a></li>
            <li><a href="index.php?lang=rus"> <img src="images/rus-scr.png"> </a></li>
        </ul>
        <ul class="navbar-user">
            <li>
            <li><a href="#"><span onclick="openNav()" class="material-icons-account_circle"></span></a></li>
            </li>
        </ul>
        <!-- END RD Navbar Brand -->
    </div>
</section>

<form id="all-tours-hidden" method="post" action="includes/tour_search.inc.php" style="display: none">
</form>
<?php

if(session_id() == '' || !isset($_SESSION)) { // session isn't started
    session_start();
}

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
            <li>
                <div class="dropdown">
                    <button class="dropbtn">ტურები ↓</button>
                    <div class="dropdown-content" style="left:0;">
                        <a href="#" onclick="document.getElementById('actual-tours-hidden').submit()">აქტუალური ტურები</a>
                        <a href="#" onclick="document.getElementById('incoming-tours').submit()">შემომავალი ტურები</a>
                        <a href="#" onclick="document.getElementById('outgoing-tours').submit()">გამავალი ტურები</a>
                    </div>
                </div>
            </li>
            <li><a href="generic_page.php?lang=<?php echo $lang_key; ?>&keyword=<?php echo $generics['about'][$lang_key]['keyword'];?>">ჩვენს შესახებ</a></li>
            <li><a href="generic_page.php?lang=<?php echo $lang_key; ?>&keyword=<?php echo $generics['partners'][$lang_key]['keyword'];?>">პარტნიორები</a></li>
            <li><a href="generic_page.php?lang=<?php echo $lang_key; ?>&keyword=<?php echo $generics['contact'][$lang_key]['keyword'];?>">კონტაქტი</a></li>
        </ul>
        <ul class="navbar-flags">
            <li><a href="index.php?lang=geo"> <img src="images/geo.png"> </a></li>
            <li><a href="index.php?lang=eng"> <img src="images/eng.png"> </a></li>
            <li><a href="index.php?lang=rus"> <img src="images/rus.png"> </a></li>
        </ul>
        <ul class="navbar-user">
            <?php if (isset($_SESSION["logged"]) && $_SESSION["logged"] == true) { ?>

                <div class="dropdown" style="float:right;">
                    <button class="dropbtn"> <span id="ui-to-top1" class="ui-to-top1 fa material-icons-chat active"></span></button>
                    <div class="dropdown-content">
                        <a href="profile.php"> ჩემი პროფილი </a>
                        <a href="includes/logout.inc.php">გამოსვლა</a>
                    </div>
                </div>

            <?php } else { ?>
            <li>
            <li><a href="#"><span onclick="openNav()" class="material-icons-account_circle"></span></a></li>
            </li>
            <?php } ?>
        </ul>
        <!-- END RD Navbar Brand -->
    </div>
</section>

<form id="all-tours-hidden" method="post" action="includes/tour_search.inc.php" style="display: none">
</form>

<form id="actual-tours-hidden" method="post" action="includes/tour_search.inc.php" style="display: none">
    <input type="hidden" name="actual" value="1">
</form>

<form id="outgoing-tours" method="post" action="includes/tour_search.inc.php" style="display: none">
    <input type="hidden" name="tour_type" value="1">
</form>

<form id="incoming-tours" method="post" action="includes/tour_search.inc.php" style="display: none">
    <input type="hidden" name="tour_type" value="2">
</form>
<script>
    function openNav() {
        document.getElementById("login-form").style.display = "block";
    }

    function closeNav() {
        document.getElementById("login-form").style.display = "none";
    }
</script>

<?php

if(session_id() == '' || !isset($_SESSION)) { // session isn't started
    session_start();
}

include "includes/get_generics.inc.php";

$lang_key = 1;

if (isset($_SESSION['lang_key'])) {
    $lang_key = $_SESSION['lang_key'];
}

require_once "includes/tr.inc.php";
$labels = getTranslationsByKey($lang_key);

include "login_form.mod.php";

//ეს ხაზი არის საჭირო ჰედერის ლინკებისთვის
require_once "includes/get_headers.inc.php";

/*
 * ჰედერის ლინკების გამოყენება:
 * $links = getHeadersByLangKey(1); - ყველა ქართული ლინკი (2 - ინგლისური, 3 - რუსული
 * $links = getHeadersByLevel(1, 3); - ქართულ ენაზე მესამე ლეველის ყველა ლინკი
 * $link = $links[0];
 *
 * $link = getHeaderByID(1, 7); ქართულ ენაზე 7 id-ის მქონე ლინკი
 * $link = getHeaderByKeyword(1, example); ქართულ ენაზე example ქივორდიანი ლინკი
 *
 * $link-ს აქვს შემდეგი ველები:
 * id
 * parent_id (null თუ parent არ ჰყავს)
 * url - ლინკი შესაბამის გვერდზე
 * level
 * group_id - იგივე id, მეორე ცხრილთან დაჯოინების შედეგად
 * name
 * description
 * lang_key
 */

?>

<!--
	<div class="k-page-header">
        <div class="k-top-bar">
            <div class="k-logo">
                <a href="index.php" class="brand-name primary-color">
                    <img src="images/logo.png" alt="Top-Travel Logo" style="width:100%">
                </a>
            </div>
            <div class="k-menu">

                <div class="k-dropdown">
                    <a href="#">ტურები</a>
                    <div class="k-dropdown-content">
                        <div>
                            <a href="#" oncdivck="document.getElementById('actual-tours-hidden').submit()">&#8599; აქტუალური ტურები</a>
                        </div>
                        <div>
                            <a href="#" oncdivck="document.getElementById('incoming-tours').submit()">&#8599; შემომავალი ტურები</a>
                        </div>
                        <div>
                            <a href="#" oncdivck="document.getElementById('outgoing-tours').submit()">&#8599; გამავალი ტურები</a>
                        </div>
                    </div>
                </div>
                <div>
                    <a href="generic_page.php?lang=1&keyword=about">შესახებ</a>
                </div>
                <div>
                    <a href="generic_page.php?lang=1&keyword=partners">პარტნიორები</a>
                </div>
                <div>
                    <a href="generic_page.php?lang=1&keyword=contact">კონტაქტი</a>
                </div>

            </div>
            <div class="k-user">
                USER_INFO_GOES_HERE
            </div>
            <div class="k-flags">
                <a href="index.php?lang=geo">
                    <img src="images/geo.png">
                </a>
                <a href="index.php?lang=eng">
                    <img src="images/eng.png">
                </a>
                <a href="index.php?lang=rus">
                    <img src="images/rus.png">
                </a>
            </div>

        </div>
    </div>
	-->
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
                    <button class="dropbtn">ტურები</button>
                    <div class="dropdown-content">
                        <a href="#" onclick="document.getElementById('actual-tours-hidden').submit()"><?php echo $labels['mm_sub_active']; ?> &#8599;</a>
                        <a href="#" onclick="document.getElementById('incoming-tours').submit()"><?php echo $labels['mm_sub_incomming']; ?> &#8599;</a>
                        <a href="#" onclick="document.getElementById('outgoing-tours').submit()"><?php echo $labels['mm_sub_outgoing']; ?> &#8599;</a>
                    </div>
                </div>
            </li>
            <li><a href="generic_page.php?lang=<?php echo $lang_key; ?>&keyword=<?php echo $generics['about'][$lang_key]['keyword'];?>"><?php echo $labels['mm_about']; ?></a></li>
            <li><a href="generic_page.php?lang=<?php echo $lang_key; ?>&keyword=<?php echo $generics['partners'][$lang_key]['keyword'];?>"><?php echo $labels['mm_partners']; ?></a></li>
            <li><a href="generic_page.php?lang=<?php echo $lang_key; ?>&keyword=<?php echo $generics['contact'][$lang_key]['keyword'];?>"><?php echo $labels['mm_contact']; ?></a></li>
        </ul>
        <ul class="navbar-flags">
            <li><a href="?lang=geo"> <img src="images/geo.png"> </a></li>
            <li><a href="?lang=eng"> <img src="images/eng.png"> </a></li>
            <li><a href="?lang=rus"> <img src="images/rus.png"> </a></li>
        </ul>
        <ul class="navbar-user">
            <?php if (isset($_SESSION["logged"]) && $_SESSION["logged"] == true) { ?>
                <div class="dropdown">
                    <button class="dropbtn"> <span class="material-icons-account_box"></span></button>
                    <div class="dropdown-content1">
                        <a href="profile.php"><?php echo $labels['mm_sub_profile']; ?> &#8599;</a>
                        <?php if ($_SESSION['user']['is_admin'] == 1) { ?>
                            <a href="admin.php"><?php echo $labels['mm_sub_admin']; ?> &#8599;</a>
                        <?php } ?>
                        <a href="includes/logout.inc.php"><?php echo $labels['mm_sub_exit']; ?> &#8599;</a>
                    </div>
                </div>
            <?php } else { ?>
            <li>
				<a href="#"><span onclick="openNav()" class="material-icons-account_box"></span></a>
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
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

//ეს ორი ხაზია საჭირო
require_once "includes/tr.inc.php";
$labels = getTranslationsByKey($lang_key);

include "login_form.mod.php";

?>

<!--labels-ს აქვს id, value (რაც უნდა გამოვიდეს გვერდზე), title (რომლის მიხედვითაც ვიღებთ ამ არაიდან),-->
<!--language_key (ყველას ის აქვს, რაც getTranslationsByKey ფუნქციას გადავეცით,-->
<!--ქართული არის 1. ასევე შეიძლება ჰქონდეს page, რომელიც განსაზღვრავს, რომელ გვერდზე უნდა გამოდიოდეს ეს ლეიბლი, მაგ. index.php-->
<!--გამოყენება ასეთია:-->
<?php //echo $labels['some_title']; ?>

<section class="page-header" style="background-color: rgb(248, 248, 255, 1);">
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
                    <button class="dropbtn"><?php echo $labels['mm_tours']; ?></button>
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
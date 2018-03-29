<div style="position: fixed; top: 0; background-color: lavender; width: 100%; height: 60px; z-index: 100">
    <section id="rd-topmenu">
        <div style="position: relative; bottom: 50px">
            <!-- RD Mailform -->
            <ul class="navbar-nav" style="width: fit-content; position: absolute; left: 500px;">
                <li>
                    <div class="dropdown">
                        <button class="dropbtn">ტურები</button>
                        <div class="dropdown-content">
                            <?php
                            require_once "includes/categories.inc.php";

                            $types = getTypes($lang_key);
                            foreach ($types as $type) { ?>
                            <form id="<?php echo $type['tour_type'].'_tours1'; ?>" method="post" action="includes/tour_search.inc.php">
                                <input type="hidden" name="tour_type" value="<?php echo $type['id']; ?>">
                                <p style="text-align: center"> <a href="#" onclick="document.getElementById(<?php echo "'".$type['tour_type']."_tours1'"; ?>).submit();"><?php echo $type['tour_type']; ?></a></p>
                            </form>
                            <?php }?>
                        </div>
                    </div>
                </li>
                <!--
                <?php
                    if (isset($_SESSION["logged"]) && $_SESSION["logged"] == true) {
                ?>
                <li><a href="profile.php">ჩემი პროფილი</a></li>
                <?php
                        if ($_SESSION['user']['is_admin'] == 1) {
                            ?>
                            <li><a href="admin.php">ადმინის პანელი</a></li>
                            <?php
                        }
                    }
                ?>
                -->
                <li><a href="#products">ჩვენს შესახებ</a></li>
                <li><a href="#faculity-member">პარტნიორები</a></li>
                <li><a href="#contact">  კონტაქტი </a></li>
            </ul>
            <ul class="navbar-flags">
                <li><a href="index.php?lang=geo"> <img src="images/geo-scr.png"> </a></li>
                <li><a href="index.php?lang=eng"> <img src="images/eng-scr.png"> </a></li>
                <li><a href="index.php?lang=rus"> <img src="images/rus-scr.png"> </a></li>
            </ul>
            <?php if (!isset($_SESSION["logged"]) || $_SESSION["logged"] == false) { ?>
            <ul class="navbar-user" >
                <li><a href="#"><span onclick="openNav()" class="material-icons-account_circle"></span></a></li>
            </ul>
            <?php } ?>
        </div>
</div>
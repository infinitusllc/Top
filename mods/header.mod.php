<div style="position: fixed; top: 0; background-color: lavender; width: 100%; height: 60px; z-index: 100">
            <section id="rd-topmenu">
                <div style="position: relative; bottom: 50px">
                    <!-- RD Mailform -->
                    <ul class="navbar-nav" style="width: fit-content; position: absolute; left: 500px;">
                        <li><a href="#news">ტურები</a></li>
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
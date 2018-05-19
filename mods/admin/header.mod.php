<div id="header_form" class="mainArea">
    <h2> ჰედერის ლინკის შეცვლა </h2>

    <script type="text/javascript">

        function openTab(evt, tabName, tabContent, tabLinks) {
            // Declare all variables
            var i, tabcontent, tablinks;

            // Get all elements with class="tabcontent" and hide them
            tabcontent = document.getElementsByClassName(tabContent);
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            // Get all elements with class="tablinks" and remove the class "active"
            tablinks = document.getElementsByClassName(tabLinks);
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            // Show the current tab, and add an "active" class to the button that opened the tab
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }

        /*
            checks if the username contains illegal characters
            or is empty
        */
        function checkName(id){
            var name = document.getElementById(id).value;
            var bob = /^[-_!@#$%^&*()+=,.;'/"}{0-9 ]+$/;
            if(bob.test(name)) {
                document.getElementById("post_" + id).innerHTML = "სახელი არ უნდა შეიძლება, იყოს ცარიელი ან შედგებოდეს არავალიდური სიმბოლოებისგან!";
            } else {
                document.getElementById("post_" + id).innerHTML = "";
            }
        }
    </script>

    <!-- after the user submits the form, he's returned back to the same page, with the corresponding message -->
    <?php if (isset($_GET["msg"])) {
        $message = $_GET["msg"];
        switch ($message) {
            case "s": //unknown error
                ?>  <p> ოპერაცია წარმატებით შესრულდა </p>  <?php
                break;
            default: //not all mandatory inputs filled
                ?>  <p> ოპერაციის შესრულებისას მოხდა შეცდომა </p>  <?php
                break;
        }
    }  ?>

    <form id="header-form" action="includes/add_header_link.inc.php" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
        <ul class="tablinks">
            <?php
            include "includes/languages.inc.php";
            foreach ($languages as $language) { ?>
                <li class="tablinks1"><a class="tablinks1" onclick="openTab(event, 'h_main_tr_<?php echo $language['keyword']; ?>',  'tabcontent', 'tablinks1')"> <?php echo $language['name']; ?> </a></li>
            <?php } ?>
        </ul>

        <?php
        include "includes/languages.inc.php";
        foreach ($languages as $language) { ?>
            <div id="h_main_tr_<?php echo $language['keyword']; ?>" class="tabcontent" <?php if ($language['keyword'] == 'geo') echo 'style = "display: block"'; ?>>
                <h3> ენა: <?php echo $language['name'] ?> </h3>
                <div>
                    <p> სახელი: </p>
                    <input name="name_<?php echo $language['keyword']; ?>" class="textInput"> </br>

                    <p> აღწერა: </p>
                    <input name="description_<?php echo $language['keyword']; ?>" class="textInput"> <br>
                </div>
            </div>
        <?php } ?>

        <div id="main_non_tr">
            <div>
                <h5> აუცილებელია ქივორდის შეყვანა </h5>
                <p> ქივორდი: </p>
                <input name="keyword" class="textInput"> <br>
                <p> ლინკი: </p>
                <input name="url" class="textInput"> <br>
                <p> მშობლის id: </p>
                <input name="parent_id" class="textInput"> <br>
                <!--                <p> დონე: </p>-->
                <!--                <input name="level" class="textInput"> <br> -->
            </div>
        </div>
        <div>
            <button onclick="document.getElementById('header-form').submit();" type="submit" class="sub button"
                    name="submit" value="company"> შექმნა </button>
        </div>
    </form>
    <div name="existing-headers">
        <hr>
        <h4> არსებული ლინკები </h4>
        <?php

        include_once "includes/get_headers.inc.php";
        $slides = getHeaders();
        $i = 0;
        foreach ($slides as $slide) { ?>
            <form name="line_<?php echo $i; ?>">
                <hr>
                <p>
                    <?php
                    echo "ქივორდი: ".$slide['keyword']."</br></br>";
                    echo "ID: ".$slide['id']."</br></br>"; ?>
                    <br>
                    <a href="includes/delete_header_link.inc.php?id=<?php echo $slide['id']; ?>"> წაშლა </a>
                </p>
            </form>
            <?php $i++; } ?>
    </div>
</div>

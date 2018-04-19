<div id="header_form" class="tabcontent2">
    </br>
    <h2 style="max-width: 350px; margin: auto"> ჰედერის ლინკის შეცვლა </h2>
    </br>
    <a href="index.php"> <p style="max-width: 150px; margin: auto"> უკან დაბრუნება </p></a>
    </br>


    <!-- after the user submits the form, he's returned back to the same page, with the corresponding message -->
    <?php if (isset($_GET["msg"])) {
        $message = $_GET["msg"];
        switch ($message) {
            case "s": //unknown error
                ?>  <p style="margin: auto; text-align: center; color:red"> ოპერაცია წარმატებით შესრულდა </p>  <?php
                break;
            default: //not all mandatory inputs filled
                ?>  <p style="margin: auto; text-align: center; color:red"> ოპერაციის შესრულებისას მოხდა შეცდომა </p>  <?php
                break;
        }
    }  ?>

    <form id="header-form" action="includes/add_header_link.inc.php" method="post" accept-charset="UTF-8" enctype="multipart/form-data">

        <ul>
            <?php
            include "includes/languages.inc.php";
            foreach ($languages as $language) { ?>
                <li class="tablinks1" style="margin-left: 20px; float: left; cursor: pointer"><a class="tablinks1" onclick="openTab(event, 'h_main_tr_<?php echo $language['keyword']; ?>',  'tabcontent1', 'tablinks1')"> <?php echo $language['name']; ?> </a></li>
            <?php } ?>
        </ul>

        <?php
        include "includes/languages.inc.php";
        foreach ($languages as $language) { ?>
            <div id="h_main_tr_<?php echo $language['keyword']; ?>" class="tabcontent1">
                <h3 style="text-align: center"> ენა: <?php echo $language['name'] ?> </h3>
                <div style="width: 600px; margin: auto;">
                    <p> სახელი: </p>
                    <input name="name_<?php echo $language['keyword']; ?>" class="textInput"> </br>

                    <p> აღწერა: </p>
                    <input name="description_<?php echo $language['keyword']; ?>" class="textInput"> <br>
                </div>
            </div>
        <?php } ?>

        <div id="main_non_tr" style="display: inline-block; border: 1px solid #ccc; width: 83%;">
            <div style="width: 50%; margin-left: 25%; ">
                <h5 style="text-align: center"> აუცილებელია ქივორდის შეყვანა </h5>
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
        <div style="width: 500px; margin: 50px auto auto;">
            <button onclick="document.getElementById('header-form').submit();" type="submit" class="sub button"
                    name="submit" value="company" style="margin-left: 80px"> შექმნა </button>
        </div>
    </form>
</div>
<div name="existing-headers" style="width: 87%; margin: auto">
    <?php

    include_once "includes/get_headers.inc.php";
    $slides = getHeaders();
    $i = 0;
    foreach ($slides as $slide) { ?>
        <form name="line_<?php echo $i; ?>" style="width: 100%">
            <hr>
            <p style="text-align: center; margin: auto">
                <?php
                echo "ქივორდი: ".$slide['keyword']."</br></br>";
                echo "ID: ".$slide['id']."</br></br>"; ?>
                <br>
                <a href="includes/delete_header_link.inc.php?id=<?php echo $slide['id']; ?>"> წაშლა </a>
            </p>
        </form>
        <?php $i++; } ?>
</div>
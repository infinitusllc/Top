<div id="slide_form" class="mainArea">
    <script type="text/javascript">

        function displayDefault() {
            openTab(event, 'main_tr_geo', 'tabcontent1', 'tablinks1');
            <?php
            $tab = "";
            if (isset($_GET['tab'])){
                $tab = $_GET['tab'];
            }
            if ($tab == 'generic') {?>
            openTab(event, 'generic_tr_geo', 'tabcontent1', 'tablinks1');
            <?php } ?>
        }

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
    </script>

    <div>
        <!-- after the user submits the form, he's returned back to the same page, with the corresponding message -->
        <?php if (isset($_GET["message"])) {
            $message = $_GET["message"];
            switch ($message) {
                case "error1": //not all mandatory inputs filled
                    ?>  <p style="margin: auto; text-align: center; color:red"> გთხოვთ, შეავსოთ ყველა აუცილებელი ველი (მონიშნულია სიმბოლოთი *) </p>  <?php
                    break;
                case "success": //unknown error
                    ?>  <p style="margin: auto; text-align: center; color:red"> ტური წარმატებით დამატებულია </p>  <?php
                    break;
            }
        }
        include "includes/slides.inc.php";
        $change = false;
        $s = [];
        if (isset($_GET['keyword'])) {
            $change = true;
        }


        ?>



        <form id="slide-form" action="includes/add_slide.inc.php" method="post" accept-charset="UTF-8" enctype="multipart/form-data">

            <ul class="tablinks">
                <?php
                $id = -1;
                if (isset($_GET['id']))
                    $id = $_GET['id'];
                include "includes/languages.inc.php";
                foreach ($languages as $language) { ?>
                    <li class="tablinks1"><a class="tablinks1" onclick="openTab(event, 'main_tr_<?php echo $language['keyword']; ?>',  'tabcontent', 'tablinks1')"> <?php echo $language['name']; ?> </a></li>
                <?php } ?>
            </ul>

            <?php
            include "includes/languages.inc.php";
            require_once "includes/get_tour.inc.php";
            foreach ($languages as $language) {
                $content = getTourContent($id, $language['keyword']);
                if ($change) {
                    $s = getSlide($_GET['keyword'], $language['keyword'])[0];
                    ?><a href="admin2.php?tab=slides">ახლის შექმნა</a> <?
                }
                ?>
                <div id="main_tr_<?php echo $language['keyword']; ?>" class="tabcontent">
                    <h3> ენა: <?php echo $language['name'] ?> </h3>

                    <?php if ($language['keyword'] == 'geo') { ?>
                        <p> ქივორდი (იუზერი ვერ ხედავს): * </p>
                        <input name="slide_keyword" class="textInput" placeholder="*" id="slide_name_<?php echo $language['keyword']; ?>" <?php if($change) echo 'value="'.$s['keyword'].'"'; ?>/> </br>
                        <p> შესაბამისი ტურის url </p>
                        <input name="slide_tour_url" class="textInput" placeholder="" id="slide_name_<?php echo $language['keyword']; ?>" <?php if($change) echo 'value="'.$s['tour_url'].'"'; ?>/> </br>
                        <p> სურათი: </p>
                        <input type="file" name="fileToUpload" id="fileToUpload" style="margin-left: 100px;"> <br><br>
                        <?php if($change) {?>
                            <p> არსებული სურათი: </p>
                            <img src="<?php echo $s['image_url']; ?>" width="30%">
                            <?
                        }
                    } ?>

                    <p> სლაიდის ინტრო: </p>
                    <textarea name="slide_intro_<?php echo $language['keyword']; ?>" form="slide-form" class="textInput htmlClass" id="slide_intro_<?php echo $language['keyword']; ?>" placeholder="ინტრო"> <?php if($change) echo $s['intro']; ?> </textarea> </br>
                    <script>
                        CKEDITOR.replace( "slide_intro_<?php echo $language['keyword']; ?>" );
                    </script>


                    <p style="text-align: center"> სლაიდის აღწერა: </p>
                    <textarea name="slide_description_<?php echo $language['keyword']; ?>" form="slide-form" class="textInput htmlClass" placeholder="*"> <?php if($change) echo $s['description']; ?> </textarea> </br>
                    <script>
                        CKEDITOR.replace( "slide_description_<?php echo $language['keyword']; ?>" );
                    </script>

                    <input type="hidden" name="user_id" value=<?php echo "'" . $user['id'] . "''"; ?>>
                </div>
            <?php } ?>

            <div>
                <button onclick="document.getElementById('tour-form').submit();" type="submit" class="sub button"
                        name="submit" value="company"> დამახსოვრება </button>
            </div>
        </form>
    </div>

    <div name="existing-slides">
        <hr> <h2> არსებული სლაიდები </h2>
        <?php
        $slides = getAllSlides();
        $i = 0;
        foreach ($slides as $slide) { ?>
            <form name="line_<?php echo $i; ?>">
                <hr>
                <p style="text-align: center; width: auto; overflow: hidden; margin: auto">
                    <?php
                        echo "ქივორდი: ".$slide['keyword']."</br></br>";
                        if (isset($slide['image_url'])) { ?>
                            <img src="<?php echo $slide['image_url']; ?>" width="50%"> <br>
                        <?php }
                    ?>

                    <a href="includes/delete_slide.inc.php?keyword=<?php echo $slide['keyword']; ?>"> წაშლა </a> <br>
                    <a href="admin.php?tab=slide&keyword=<?php echo $slide['keyword']; ?>"> შეცვლა </a>
                </p>
            </form>
            <?php $i++; } ?>
    </div>

</div>
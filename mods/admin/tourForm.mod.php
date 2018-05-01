<script type="text/javascript">

    function displayDefault() {
        openTab(event, 'main_tr_geo', 'tabcontent1', 'tablinks1');
        <?php
        $tab = "";
        if (isset($_GET['tab'])){
            $tab = $_GET['tab'];
        }
        if ($tab = 'generic') {?>
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

    function checkQuantity(id) {
        var name = document.getElementById(id).value;
        var bob = /^[0-9]+$/;
        if(!bob.test(name)) {
            document.getElementById("post_" + id).innerHTML = "უნდა იყოს მთელი რიცხვი";
        } else {
            document.getElementById("post_" + id).innerHTML = "";
        }
    }

    function checkPrice() {
        var name = document.getElementById('price').value;
        var bob = /^[0-9.]+$/;
        if(!bob.test(name)) {
            document.getElementById("post_price").innerHTML = "უნდა იყოს რიცხვი";
        } else {
            document.getElementById("post_price").innerHTML = "";
        }
    }
</script>

<div class="mainArea">
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
    }  ?>

    <form id="tour-form" action="includes/add_tour.inc.php" method="post" accept-charset="UTF-8" enctype="multipart/form-data">

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
            $content = getTourContent($id, $language['keyword']); ?>
            <div id="main_tr_<?php echo $language['keyword']; ?>" class="tabcontent">
                <h3> ენა: <?php echo $language['name'] ?> </h3>
                <h5> აუცილებელია მინიმუმ ერთი ენაზე ტურის სახელისა და ინტროს შევსება </h5>
                <div>
                    <p> ტურის სახელი: * </p>
                    <input name="tour_name_<?php echo $language['keyword']; ?>" oninput="checkName('tour_name_<?php echo $language['keyword']; ?>')"
                           class="textInput" value="<?php echo $content['tour_name'];?>" id="tour_name_<?php echo $language['keyword']; ?>"/> </br>
                    <div id="post_tour_name_<?php echo $language['keyword']; ?>"> </div>

                    <p> ქალაქ(ებ)ი: </p>
                    <input name="cities_<?php echo $language['keyword']; ?>" class="textInput"
                           value="<?php echo $content['tour_cities'];?>" id="cities"/> </br>

                    <p> სასტუმროს სახელი: </p>
                    <input name="hotel_name_<?php echo $language['keyword']; ?>" class="textInput"
                           value="<?php echo $content['hotel_name'];?>" id="hotel_name"/> </br>
                </div>

                <div>
                    <p> ტურის ინტრო: * </p>
                    <textarea name="tour_intro_<?php echo $language['keyword']; ?>" form="tour-form" class="textInput htmlClass"
                              id="tour_intro_<?php echo $language['keyword']; ?>"><?php echo $content['tour_intro'];?></textarea> </br>
                    <script>
                        CKEDITOR.replace( "tour_intro_<?php echo $language['keyword']; ?>" );
                    </script>
                </div>

                <div>
                    <p> ტურის აღწერა: </p>
                    <textarea name="tour_description_<?php echo $language['keyword']; ?>" form="tour-form"
                              class="textInput htmlClass" placeholder="*"><?php echo $content['tour_description'];?></textarea> </br>
                    <script>
                        CKEDITOR.replace( "tour_description_<?php echo $language['keyword']; ?>" );
                    </script>
                </div>

                <input type="hidden" name="user_id" value=<?php echo "'" . $user['id'] . "''"; ?>>
                <input type="hidden" name="lang" value=<?php echo "'" . $language['keyword'] . "''"; ?>>
            </div>
        <?php } ?>

        <div id="main_non_tr">
            <?php $tour = getTour($id); ?>
            <input type="hidden" name="tour_id" value=<?php echo "'" . $id . "''"; ?>>
            <div class="column">
                <p> ქვეყანა: </p>
                <select name="country" id="country">
                    <?php
                        include "includes/countries.inc.php";
                        for ($i = 0; $i < sizeof($countries); $i++) {
                            $v = $countries[$i]['country_id'];
                            $n = $countries[$i]['country_name'];
                            if ($v == $tour['country'])
                                echo "<option value='$v'> $n </option>";
                        }
                        for ($i = 0; $i < sizeof($countries); $i++) {
                            $v = $countries[$i]['country_id'];
                            $n = $countries[$i]['country_name'];
                            if ($v != $tour['country'])
                                echo "<option value='$v'> $n </option>";
                        }
                    ?>
                </select>
                <p> ფასი: </p>
                <input name="price" class="textInput" value="<?php echo $tour['price']; ?>" id="price" oninput="checkPrice()"/> </br>
                <div id="post_price"> </div>
                <p> ვალუტა: </p>
                <select name="currency" id="currency">
                    <option value='0'> GEL </option>;
                    <option value='1'> USD </option>;
                    <option value='2'> EUR </option>;
                </select>

                <p> კატეგორია: </p>
                <select name="category" id="category">
                    <?php
                    include "includes/tour_categories.inc.php";
                    for ($i = 0; $i < sizeof($tour_categories); $i++) {
                        $n = $tour_categories[$i]['tour_category'];
                        $v = $tour_categories[$i]['tour_category_id'];
                        if ($v == $tour['category'])
                            echo "<option value='$v'> $n </option>";
                    }
                    for ($i = 0; $i < sizeof($tour_categories); $i++) {
                        $n = $tour_categories[$i]['tour_category'];
                        $v = $tour_categories[$i]['tour_category_id'];
                        if ($v != $tour['category'])
                            echo "<option value='$v'> $n </option>";
                    }
                    ?>
                </select>

                <p> ტიპი: </p>
                <select name="type" id="type">
                    <?php
                    include "includes/tour_types.inc.php";
                    for ($i = 0; $i < sizeof($tour_types); $i++) {
                        $n = $tour_types[$i]['tour_type'];
                        $v = $tour_types[$i]['id'];
                        if ($v == $tour['type'])
                            echo "<option value='$v'> $n </option>";
                    }
                    for ($i = 0; $i < sizeof($tour_types); $i++) {
                        $n = $tour_types[$i]['tour_type'];
                        $v = $tour_types[$i]['id'];
                        if ($v != $tour['type'])
                            echo "<option value='$v'> $n </option>";
                    }
                    ?>
                </select>

            </div>

            <div class="column">
                <p> რაოდენობა - სრულწლოვანი: </p>
                <input name="q_adult" class="textInput" value="<?php echo $tour['quantity_adult']; ?>" id="q_adult" oninput="checkQuantity('q_adult')"/> </br>
                <div id="post_q_adult"> </div>
                <p> რაოდენობა - ბავშვი: </p>
                <input name="q_kid" class="textInput" value="<?php echo $tour['quantity_small']; ?>" id="q_kid" oninput="checkQuantity('q_kid')"/> </br>
                <div id="post_q_kid"> </div>
                <p> რაოდენობა - ჩვილი: </p>
                <input name="q_small" class="textInput" value="<?php echo $tour['quantity_child']; ?>" id="q_small" oninput="checkQuantity('q_small')"/> </br>
                <div id="post_q_small"> </div>
                <p> კვება: </p>
                <select name="food_option" id="food_option">
                    <option value='0'> სამჯერადი </option>;
                    <option value='1'> საუზმე </option>;
                    <option value='2'> კვების გარეშე </option>;
                </select>
                <p> სასტუმროს ვარსკვლავები: </p>
                <input name="hotel_stars" type="text" class="textInput" value="<?php echo $tour['hotel_stars']; ?>"
                       id="hotel_stars"/> <br> <br>
            </div>
            <div>
                <p> სურათები (პირველი ძირითადია): </p>
                <input type="file" name="fileToUpload0" id="fileToUpload0"> <br>
                <input type="file" name="fileToUpload1" id="fileToUpload1"> <br>
                <input type="file" name="fileToUpload2" id="fileToUpload2"> <br>
                <input type="file" name="fileToUpload3" id="fileToUpload3"> <br>
                <input type="file" name="fileToUpload4" id="fileToUpload4"> <br>
                <input type="checkbox" name="rec" value="true"> რეკომენდირებული (გამოჩნდება მთავარ გვერდზე, მაქს. 4)<br><br>
                <input type="checkbox" name="actual" value="true"> აქტუალური <br><br>
            </div>
        </div>
        <div>
            <button onclick="document.getElementById('tour-form').submit();" type="submit" class="sub button"
                    name="submit" value="company"> დამახსოვრება </button>
        </div>
    </form>
</div>
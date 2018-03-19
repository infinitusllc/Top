<div id="tour_form" class="tabcontent2">
    </br>
    <h2 style="max-width: 250px; margin: auto"> ახალი ტურის შექმნა </h2>
    </br>
    <a href="index.php"> <p style="max-width: 150px; margin: auto"> უკან დაბრუნება </p></a>
    </br>


    <!-- after the user submits the form, he's returned back to the same page, with the corresponding message -->
    <?php if (isset($_GET["message"])) {
        $message = $_GET["message"];
        switch ($message) {
            case "error1": //not all mandatory inputs filled
                ?>  <p style="margin: auto; text-align: center; color:red"> გთხოვთ, შეავსოთ ყველა აუცილებელი ველი (მონიშნულია სიმბოლოთი *) </p>  <?php
                break;
            case "error2": //passwords don't match
                ?>  <p style="margin: auto; text-align: center; color:red"> შეყვანილი პაროლები არ ემთხვევა ერთმანეთს </p>  <?php
                break;
            case "error3": //password too short
                ?>  <p style="margin: auto; text-align: center; color:red"> შეყვანილი პაროლი ძალიან მოკლეა (მინ. 6 სიმბოლო) </p>  <?php
                break;
            case "error4": //e-mail already exists
                ?>  <p style="margin: auto; text-align: center; color:red"> შეყვანილი პაროლები არ ემთხვევა ერთმანეთს </p>  <?php
                break;
            case "success": //unknown error
                ?>  <p style="margin: auto; text-align: center; color:red"> ტური წარმატებით დამატებულია </p>  <?php
                break;
        }
    }  ?>

    <form id="tour-form" action="includes/add_tour.inc.php" method="post" accept-charset="UTF-8" enctype="multipart/form-data">

        <ul>
            <?php
            include "includes/languages.inc.php";
            foreach ($languages as $language) { ?>
                <li class="tablinks1" style="margin-left: 20px; float: left;"><a class="tablinks1" onclick="openTab(event, 'main_tr_<?php echo $language['keyword']; ?>',  'tabcontent1', 'tablinks1')"> <?php echo $language['name']; ?> </a></li>
            <?php } ?>
        </ul>

        <?php
        include "includes/languages.inc.php";
        foreach ($languages as $language) { ?>
            <div id="main_tr_<?php echo $language['keyword']; ?>" class="tabcontent1">
                <h3 style="text-align: center"> ენა: <?php echo $language['name'] ?> </h3>
                <h5 style="text-align: center"> აუცილებელია მინიმუმ ერთი ენაზე ტურის სახელისა და ინტროს შევსება </h5>
                <div style="width: 600px; margin: auto;">
                    <p> ტურის სახელი: * </p>
                    <input name="tour_name_<?php echo $language['keyword']; ?>" oninput="checkName('tour_name_<?php echo $language['keyword']; ?>')" class="textInput" placeholder="*" id="tour_name_<?php echo $language['keyword']; ?>"/> </br>
                    <div id="post_tour_name_<?php echo $language['keyword']; ?>"> </div>
                    <p> ქალაქ(ებ)ი: </p>
                    <input name="cities_<?php echo $language['keyword']; ?>" class="textInput" placeholder="" id="cities"/> </br>
                    <p> სასტუმროს სახელი: </p>
                    <input name="hotel_name_<?php echo $language['keyword']; ?>" class="textInput" placeholder="" id="hotel_name"/> </br>
                </div>

                <div style="width: 800px; margin: auto; padding-top: 50px; text-align: center">
                    <p style="text-align: center"> ტურის ინტრო: * </p>
                    <textarea name="tour_intro_<?php echo $language['keyword']; ?>" form="tour-form" class="textInput htmlClass" id="tour_intro_<?php echo $language['keyword']; ?>" placeholder="ინტრო">  </textarea> </br>
                    <script>
                        CKEDITOR.replace( "tour_intro_<?php echo $language['keyword']; ?>" );
                    </script>
                </div>

                <div style="width: 800px; margin: auto; margin-bottom: 100px; padding-top: 50px">
                    <p style="text-align: center"> ტურის აღწერა: </p>
                    <textarea name="tour_description_<?php echo $language['keyword']; ?>" form="tour-form" class="textInput htmlClass" placeholder="*">  </textarea> </br>
                    <script>
                        CKEDITOR.replace( "tour_description_<?php echo $language['keyword']; ?>" );
                    </script>
                </div>


                <input type="hidden" name="user_id" value=<?php echo "'" . $user['id'] . "''"; ?>>
                <input type="hidden" name="lang" value=<?php echo "'" . $lang . "''"; ?>>
            </div>
        <?php } ?>

        <div id="main_non_tr" style="display: inline-block; border: 1px solid #ccc; width: 1200px;">
            <div class="column">
                <p> ქვეყანა: </p>
                <select name="country" id="country"
                        style="margin-left: 100px; margin-bottom:30px; width: 200px; height: 25px">
                    <?php
                    for ($i = 0; $i < sizeof($countries); $i++) {
                        $v = $countries[$i]['country_id'];
                        $n = $countries[$i]['country_name'];
                        echo "<option value='$v'> $n </option>";
                    }
                    ?>
                </select>
                <p> ფასი: </p>
                <input name="price" class="textInput" placeholder="" id="price" oninput="checkPrice()"/> </br>
                <div id="post_price" style="margin-left: 100px; margin-bottom: 20px;"> </div>
                <p> ვალუტა: </p>
                <select name="currency" id="currency"
                        style="margin-left: 100px; margin-bottom:30px; width: 200px; height: 25px">
                    <option value='0'> GEL </option>;
                    <option value='1'> USD </option>;
                    <option value='2'> EUR </option>;
                </select>

                <p> კატეგორია: </p>
                <select name="category" id="category"
                        style="margin-left: 100px; margin-bottom:30px; width: 200px; height: 25px">
                    <?php
                    include "includes/tour_categories.inc.php";
                    for ($i = 0; $i < sizeof($tour_categories); $i++) {
                        $n = $tour_categories[$i]['tour_category'];
                        $v = $tour_categories[$i]['tour_category_id'];
                        echo "<option value='$v'> $n </option>";
                    }
                    ?>
                </select>

                <p> ტიპი: </p>
                <select name="type" id="type"
                        style="margin-left: 100px; margin-bottom:30px; width: 200px; height: 25px">
                    <?php
                    include "includes/tour_types.inc.php";
                    for ($i = 0; $i < sizeof($tour_types); $i++) {
                        $n = $tour_types[$i]['tour_type'];
                        $v = $tour_types[$i]['tour_type_id'];
                        echo "<option value='$v'> $n </option>";
                    }
                    ?>
                </select>

            </div>

            <div class="column">
                <p> რაოდენობა - სრულწლოვანი: </p>
                <input name="q_adult" class="textInput" placeholder="" id="q_adult" oninput="checkQuantity('q_adult')"/> </br>
                <div id="post_q_adult" style="margin-left: 100px; margin-bottom: 20px;"> </div>
                <p> რაოდენობა - ბავშვი: </p>
                <input name="q_kid" class="textInput" placeholder=""  id="q_kid" oninput="checkQuantity('q_kid')"/> </br>
                <div id="post_q_kid" style="margin-left: 100px; margin-bottom: 20px;"> </div>
                <p> რაოდენობა - ჩვილი: </p>
                <input name="q_small" class="textInput" placeholder="" id="q_small" oninput="checkQuantity('q_small')"/> </br>
                <div id="post_q_small" style="margin-left: 100px; margin-bottom: 20px;"> </div>
                <p> კვება: </p>
                <select name="food_option" id="food_option"
                        style="margin-left: 100px; margin-bottom:30px; width: 200px; height: 25px">
                    <option value='0'> სამჯერადი </option>;
                    <option value='1'> საუზმე </option>;
                    <option value='2'> კვების გარეშე </option>;
                </select>
                <p> სასტუმროს ვარსკვლავები: </p>
                <input name="hotel_stars" type="text" class="textInput" placeholder=""
                       id="hotel_stars"/> </br> </br>
                <p style="width: 150px; margin:auto;"> სურათები (პირველი ძირითადია): </p>
                <input type="file" name="fileToUpload0" id="fileToUpload0"> </br>
                <input type="file" name="fileToUpload1" id="fileToUpload1"> </br>
                <input type="file" name="fileToUpload2" id="fileToUpload2"> </br>
                <input type="file" name="fileToUpload3" id="fileToUpload3"> </br>
                <input type="file" name="fileToUpload4" id="fileToUpload4"> </br>
                <input type="checkbox" name="rec" value="true"> რეკომენდირებული (გამოჩნდება მთავარ გვერდზე, მაქს. 4)<br><br>

            </div>
        </div>
        <div style="width: 500px; margin: 50px auto auto;">
            <button onclick="document.getElementById('tour-form').submit();" type="submit" class="sub button"
                    name="submit" value="company"> შექმნა </button>
        </div>
    </form>
</div>
<div id="combinations" class="tabcontent2">

    <script>
        function changeLanguage(selectObject) {
            var value = selectObject.value;
            window.location.href = 'admin.php?tab=combinations&option=' + value;
        }
    </script>

    <h2 style="text-align: center"> კომბინაციების რედაქტირება </h2>
    </br>
    <a href="index.php"> <p style="max-width: 150px; margin: auto"> უკან დაბრუნება </p></a>
    </br>
    <select id="langChange" style="padding:3px; width: 300px; height:40px; -webkit-border-radius:4px; -moz-border-radius:4px;
    border-radius:4px; -webkit-box-shadow: 0 3px 0 #ccc, 0 -1px #fff inset; -moz-box-shadow: 0 3px 0 #ccc, 0 -1px #fff inset;
    box-shadow: 0 3px 0 #ccc, 0 -1px #fff inset;background: #f8f8f8; color:#888; border:none; outline:none;
    cursor:pointer; margin-left: 40.5%" onchange="changeLanguage(this)">
        <?php

        $option = "currency";
        if (isset($_GET['option'])){
            $option = $_GET['option'];
        }

        $options_links_array = [];
        $options_links_array['currency'] = "<option value=\"currency\"> ვალუტა </option>";
        $options_links_array['food_options'] = "<option value=\"food_options\"> კვება </option>";
        $options_links_array['countries'] = "<option value=\"countries\"> ქვეყნები </option>";
        $options_links_array['categories'] = "<option value=\"categories\"> კატეგორიები </option>";
        $options_links_array['types'] = "<option value=\"types\"> ტიპები </option>";

        switch ($option) {
            case "currency":
                echo $options_links_array['currency'];
                foreach ($options_links_array as $item){
                    if ($item != "<option value=\"currency\"> ვალუტა </option>")
                        echo $item;
                }
                break;
            case "food_options":
                echo $options_links_array['food_options'];
                foreach ($options_links_array as $item){
                    if ($item != "<option value=\"food_options\"> კვება </option>")
                        echo $item;
                }
                break;
            case "countries":
                echo $options_links_array['countries'];
                foreach ($options_links_array as $item){
                    if ($item != "<option value=\"countries\"> ქვეყნები </option>")
                        echo $item;
                }
                break;
            case "categories":
                echo $options_links_array['categories'];
                foreach ($options_links_array as $item){
                    if ($item != "<option value=\"categories\"> კატეგორიები </option>")
                        echo $item;
                }
                break;
            case "types":
                echo $options_links_array['types'];
                foreach ($options_links_array as $item){
                    if ($item != "<option value=\"types\"> ტიპები </option>")
                        echo $item;
                }
                break;
        }

        $lang_key = 1;
        $lang = 'geo';

        if (isset($_SESSION['lang_key']))
            $lang_key = $_SESSION['lang_key'];
        if (isset($_SESSION['lang_key']))
            $lang = $_SESSION['lang'];


        ?>
    </select>
    </br>

    <?php if ($option == "currency") { ?>
        <form id="currency-form" action="includes/add_currency.inc.php" method="post" accept-charset="UTF-8">
            <div style="width: 500px; margin: auto;">
                <p> ახალი ვალუტა (მაქს. 4 სიმბოლო): </p>
                <input name="currency" class = "textInput" placeholder="*" id = "currency_input" value="" /> </br>
                <button onclick="document.getElementById('currency-form').submit();" style="margin-left: 100px" type="submit" class="button sub" name="submit" value="client"> დამატება </button>

                <?php
                    include"includes/currencies.inc.php";

                    echo "<h4 style='text-align: center'> არსებული ვალუტები: </h4>";

                    foreach ($currencies as $currency) { ?>

                        <p> <?php echo $currency["currency"]; ?> ------------------------------------ <a href="includes/delete_currency.inc.php?id=<?php echo $currency['currency_id']; ?>""> წაშლა </a> </p>

                    <?php }
                ?>
            </div>
        </form>
    <?php } else if ($option == "food_options") { ?>
        <form id="food_options-form" action="includes/add_food_option.inc.php" method="post" accept-charset="UTF-8">
            <div style="width: 500px; margin: auto;">
                <p> ახალი მნიშვნელობა (აუცილებელია ყველას შევსება): </p>
                <?php
                for ($i = 0; $i<sizeof($languages); $i++){ ?>
                    <p> ცვლადის მნიშვნელობა - <?php echo $languages[$i]['name']; ?> </p>
                    <input name="value_<?php echo $languages[$i]['id'] ?>" class = "textInput" placeholder="" id = "value"
                           value="<?php if (isset($tr[$i+1])) { echo $tr[$i+1]; } ?>" /> </br>

                <?php } ?>
                <button onclick="document.getElementById('food_options-form').submit();" style="margin-left: 100px" type="submit" class="button sub" name="submit" value="client"> დამატება </button>
                <?php
                include"includes/food_options.inc.php";

                echo "<h4 style='text-align: center'> არსებული ოფციები: </h4>";

                $cur_id = -1;
                $i = 0;
                while (true) {
                    if(empty($food_options[0])) break;
                    if ($cur_id == -1 || $food_options[$i]['group_id'] != $cur_id) { // changed = news group
                        $cur_id = $food_options[$i]['group_id'];
                        for($j=0; $j<sizeof($languages); $j++) {
                            ?>  <p style="text-align: center"> <?php echo $food_options[$i+$j]["food_option"]; ?> </p> </br> <?php
                        }
                        ?><p style="text-align: center"> <a href="includes/delete_food_option.inc.php?id=<?php echo $food_options[$i]['food_option_id']; ?>""> წაშლა </a> </p> <hr> <?php
                        $i++;
                    } else {
                        break;
                    }
                }
                ?>
            </div>
        </form>
    <?php } else if ($option == "categories") { ?>
        <form id="category_form" action="includes/add_category.inc.php" method="post" accept-charset="UTF-8">
            <div style="width: 500px; margin: auto;">
                <p> ახალი მნიშვნელობა (აუცილებელია ყველას შევსება): </p>
                <?php
                require_once 'includes/categories.inc.php';
                $category = null;
                for ($i = 0; $i<sizeof($languages); $i++){
                    if (isset($_GET['id'])) {
                        $category = getCategory($_GET['id'], $languages[$i]['id']);
                    } ?>
                    <p> ცვლადის მნიშვნელობა - <?php echo $languages[$i]['name']; ?> </p>
                    <input name="value_<?php echo $languages[$i]['id'] ?>" class = "textInput" id = "value"
                           value="<?php if ( isset($category[0]) ) { echo $category[0]['tour_category']; $category = null; } ?>" /> </br>
                <?php } ?>

                <p> ტიპი </p>
                <select name="type" style="padding:3px; width: 300px; height:40px; -webkit-border-radius:4px; -moz-border-radius:4px;
    border-radius:4px; -webkit-box-shadow: 0 3px 0 #ccc, 0 -1px #fff inset; -moz-box-shadow: 0 3px 0 #ccc, 0 -1px #fff inset;
    box-shadow: 0 3px 0 #ccc, 0 -1px #fff inset;background: #f8f8f8; color:#888; border:none; outline:none;
    cursor:pointer; margin-left: 100px">
                    <?php
                    $tour_types = getTypes(1);
                    foreach ($tour_types as $type) { ?>
                        <option value="<?php echo $type['id']; ?>"> <?php echo $type['tour_type']; ?> </option>
                    <?php } ?>
                </select>
                <p>ინდექსი: </p>
                <input name="index" type="textInput" style="margin-left: 100px" value="<?php if (isset($category[0])) { echo $category[0]['index']; } else { echo '1'; } ?>">
                <button onclick="document.getElementById('category_form').submit();" style="margin-left: 100px" type="submit" class="button sub" name="submit" value="client"> დამატება </button>
            </div>
            <?php if (isset($_GET['id'])) {?>
            <input type="hidden" id="id" name="group_id" value="<?php echo $_GET['id']; ?>" title="group_id">
            <?php } ?>
        </form>
        <div style="width: 500px; margin: auto;">
            <?php
                include"includes/tour_categories.inc.php";

                echo "<h4 style='text-align: center'> არსებული ოფციები: </h4>";

                if(!empty($tour_categories[0])) {
                    foreach ($tour_categories as $tg) { ?>
                <p style="text-align: center"> <?php echo $tg['tour_category']; ?> ----
                    <a href="admin.php?tab=combinations&option=categories&id=<?php echo $tg['group_id']; ?>"> შეცვლა <a/> -
                    <a href="includes/delete_category.inc.php?id=<?php echo $tg['group_id']; ?>"> წაშლა <a/></p><br>
                    <?php }
                } ?>
            </div>

    <?php }else if ($option == "types") { ?> <!-- ===============================  TYPES   ================================== -->
        <form id="type_form" action="includes/add_type.inc.php" method="post" accept-charset="UTF-8">
            <?php
                $type = null;
                if (isset($_GET['id'])) { ?>
                    <input type="hidden" value="<?php echo $_GET['id']; ?>" name="group_id">
            <?php }
            ?>
            <div style="width: 500px; margin: auto;">
                <p> ახალი მნიშვნელობა (აუცილებელია ყველას შევსება): </p>
                <?php
                require_once "includes/categories.inc.php";
                for ($i = 0; $i<sizeof($languages); $i++){
                    if (isset($_GET['id'])) {
                        $type = getTypeById($_GET['id'], $languages[$i]['id']);
                    } ?>
                    <p> ცვლადის მნიშვნელობა - <?php echo $languages[$i]['name']; ?> </p>
                    <input name="value_<?php echo $languages[$i]['id'] ?>" class = "textInput" placeholder="" id = "value"
                           value="<?php if (isset($type[0])) { echo $type[0]['tour_type']; } ?>" /> </br>
                <?php } ?>
                <p>ინდექსი: </p>
                <input name="index" type="textInput" style="margin-left: 100px" value="<?php if (isset($type[0])) { echo $type[0]['index']; } else { echo '1'; } ?>">
                <button onclick="document.getElementById('type_form').submit();" style="margin-left: 100px" type="submit" class="button sub" name="submit" value="client"> დამატება </button>
            </div>
        </form>
    <div name="existing-options" style="width: 500px; margin: auto;">
        <?php
            echo "<h4 style='text-align: center'> არსებული ოფციები: </h4>";
            $tour_types = getTypes(1);
            if(!empty($tour_types[0])) {
                foreach ($tour_types as $tp) { ?>
                    <p style="text-align: center">
                        <?php echo $tp['tour_type']; ?> ----
                        <a href="admin.php?tab=combinations&option=types&id=<?php echo $tp['group_id']; ?>"> შეცვლა <a/> -
                        <a href="includes/delete_type.inc.php?id=<?php echo $tp['group_id']; ?>"> წაშლა <a/></p><br>
                    <?php }
                }
            }
         ?>
    </div>
    <?php if (isset($_GET["message"])) {
        $message = $_GET["message"];
        switch ($message) {
            case "error1": //not all mandatory inputs filled
                ?>  <p style="margin: auto; text-align: center; color:red"> ცვლადი ასეთი სახელით უკვე არსებობს/ცვლადის სახელი შეყვანილი არაა </p>  <?php
                break;
            case "success":
                ?>  <p style="margin: auto; text-align: center; color:red"> ოპერაცია წარმატებით შესრულდა </p>  <?php
                break;
        }
    } ?>
</div>
<div class="mainArea">

    <script>
        function changeLanguage(selectObject) {
            var value = selectObject.value;
            window.location.href = 'admin2.php?tab=combinations&option=' + value;
        }
    </script>

    <h2> კომბინაციების რედაქტირება </h2>
    </br>
    <a href="index.php"> <p> უკან დაბრუნება </p> </a>
    </br>
    <select id="optionsSelect" onchange="changeLanguage(this)">
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
            <div>
                <p> ახალი ვალუტა (მაქს. 4 სიმბოლო): </p>
                <input name="currency" class = "textInput" placeholder="*" id = "currency_input" value="" /> </br>
                <button onclick="document.getElementById('currency-form').submit();" type="submit" class="button sub" name="submit" value="client"> დამატება </button>

                <?php
                include"includes/currencies.inc.php";

                echo "<h4> არსებული ვალუტები: </h4>";

                foreach ($currencies as $currency) { ?>
                    <p> <?php echo $currency["currency"]; ?> ------------------------------------ <a href="includes/delete_currency.inc.php?id=<?php echo $currency['currency_id']; ?>""> წაშლა </a> </p>
                <?php }
                ?>
            </div>
        </form>
    <?php } else if ($option == "food_options") { ?>
        <form id="food_options-form" action="includes/add_food_option.inc.php" method="post" accept-charset="UTF-8">
            <div>
                <p> ახალი მნიშვნელობა (აუცილებელია ყველას შევსება): </p>
                <?php
                include "includes/languages.inc.php";
                for ($i = 0; $i<sizeof($languages); $i++){ ?>
                    <p> ცვლადის მნიშვნელობა - <?php echo $languages[$i]['name']; ?> </p>
                    <input name="value_<?php echo $languages[$i]['id'] ?>" class = "textInput" placeholder="" id = "value"
                           value="<?php if (isset($tr[$i+1])) { echo $tr[$i+1]; } ?>" /> </br>

                <?php } ?>
                <button onclick="document.getElementById('food_options-form').submit();" type="submit" class="button sub" name="submit" value="client"> დამატება </button>
                <?php

                echo "<h4> არსებული ოფციები: </h4> <hr>";
                include"includes/food_options.inc.php";

                $cur_id = -1;
                $i = 0;
                while (true) {
                    if(empty($food_options[$i])) break;
                    if ($cur_id == -1 || $food_options[$i]['group_id'] != $cur_id) {
                        $cur_id = $food_options[$i]['group_id'];
                        for($j = 0; $j < sizeof($languages); $j++) { ?>
                            <p> <?php echo $food_options[$i+$j]["food_option"]; ?> </p> <?php
                        } ?>
                        <p> <a href="includes/delete_food_option.inc.php?id=<?php echo $food_options[$i]['food_option_id']; ?>""> წაშლა </a> </p> <hr>
                        <?php
                        $i += sizeof($languages);
                    } else {
                        break;
                    }
                }
                ?>
            </div>
        </form>
    <?php } else if ($option == "categories") { ?>
        <form id="food_options_form" action="includes/add_category.inc.php" method="post" accept-charset="UTF-8">
            <div>
                <p> ახალი მნიშვნელობა (აუცილებელია ყველას შევსება): </p>
                <?php
                require_once 'includes/categories.inc.php';
                include "includes/languages.inc.php";
                $category = null;
                for ($i = 0; $i<sizeof($languages); $i++){
                    if (isset($_GET['id'])) {
                        $category = getCategory($_GET['id'], $languages[$i]['id']);
                    } ?>
                    <p> ცვლადის მნიშვნელობა - <?php echo $languages[$i]['name']; ?> </p>
                    <input name="value_<?php echo $languages[$i]['id'] ?>" class = "textInput" id = "value"
                           value="<?php if ( isset($category[0]) ) { echo $category[0]['tour_category']; } ?>" /> </br>
                <?php } ?>

                <p> ტიპი </p>
                <select name="type">
                    <?php
                    $tour_types = getTypes(1);
                    foreach ($tour_types as $type) { ?>
                        <option value="<?php echo $type['id']; ?>"> <?php echo $type['tour_type']; ?> </option>
                    <?php } ?>
                </select>
                <p>ინდექსი: </p>
                <input name="index" type="textInput" value="<?php if (isset($category[0])) { echo $category[0]['index']; } else { echo '1'; } ?>"> <br>
                <button onclick="document.getElementById('category_form').submit();" type="submit" class="button sub" name="submit" value="client"> დამატება </button>
            </div>
            <?php if (isset($_GET['id'])) {?>
                <input type="hidden" id="id" name="group_id" value="<?php echo $_GET['id']; ?>" title="group_id">
            <?php } ?>
        </form>
        <div>
            <?php
            include"includes/tour_categories.inc.php";

            echo "<h4> არსებული ოფციები: </h4>";

            if(!empty($tour_categories[0])) {
                foreach ($tour_categories as $tg) { ?>
                    <p> <?php echo $tg['tour_category']; ?> ----
                        <a href="admin.php?tab=combinations&option=categories&id=<?php echo $tg['group_id']; ?>"> შეცვლა <a/> -
                            <a href="includes/delete_category.inc.php?id=<?php echo $tg['group_id']; ?>"> წაშლა <a/></p>
                <?php }
            } ?>
        </div>
    <?php } else if ($option == "types") { ?> <!-- ===============================  TYPES   ================================== -->
    <form id="type_form" action="includes/add_type.inc.php" method="post" accept-charset="UTF-8">
        <?php
        include "includes/languages.inc.php";

        $type = null;
        if (isset($_GET['id'])) { ?>
            <input type="hidden" value="<?php echo $_GET['id']; ?>" name="group_id">
        <?php }
        ?>
        <div>
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
            <input name="index" type="textInput" value="<?php if (isset($type[0])) { echo $type[0]['index']; } else { echo '1'; } ?>"> <br>
            <button onclick="document.getElementById('type_form').submit();" type="submit" class="button sub" name="submit" value="client"> დამატება </button>
        </div>
    </form>
    <div name="existing-options" >
        <?php
        echo "<h4 > არსებული ოფციები: </h4>";
        $tour_types = getTypes(1);
        if(!empty($tour_types[0])) {
            foreach ($tour_types as $tp) { ?>
                <p>
                    <?php echo $tp['tour_type']; ?> ----
                    <a href="admin.php?tab=combinations&option=types&id=<?php echo $tp['group_id']; ?>"> შეცვლა <a/> -
                        <a href="includes/delete_type.inc.php?id=<?php echo $tp['group_id']; ?>"> წაშლა <a/></p>
            <?php }
        } ?>
    </div>
    <?php } else if ($option == "countries") { ?>
        <form id="food_options_form" action="includes/add_country.inc.php" method="post" accept-charset="UTF-8">
            <div>
                <p> ახალი ქვეყანა (აუცილებელია ყველას შევსება): </p>
                <?php
                require_once 'includes/categories.inc.php';
                include "includes/languages.inc.php";
                $category = null;
                for ($i = 0; $i<sizeof($languages); $i++){
                    if (isset($_GET['id'])) {
                        $category = getCategory($_GET['id'], $languages[$i]['id']);
                    } ?>
                    <p> ქვეყნის სახელი - <?php echo $languages[$i]['name']; ?> </p>
                    <input name="value_<?php echo $languages[$i]['id'] ?>" class = "textInput" id = "value"
                           value="<?php if ( isset($category[0]) ) { echo $category[0]['tour_category']; } ?>" /> </br>
                <?php } ?>

               <button onclick="document.getElementById('category_form').submit();" type="submit" class="button sub" name="submit" value="client"> დამატება </button>
            </div>
            <?php if (isset($_GET['id'])) {?>
                <input type="hidden" id="id" name="group_id" value="<?php echo $_GET['id']; ?>" title="group_id">
            <?php } ?>
        </form>
        <div>
            <?php
            include"includes/countries.inc.php";

            if (isset($_GET["message"])) {
                $message = $_GET["message"];
                switch ($message) {
                    case "error1": //not all mandatory inputs filled
                        ?>  <p> ცვლადი ასეთი სახელით უკვე არსებობს/ცვლადის სახელი შეყვანილი არაა </p>  <?php
                        break;
                    case "success":
                        ?>  <p> ოპერაცია წარმატებით შესრულდა </p>  <?php
                        break;
                }
            }

            echo "<h4> არსებული ოფციები: </h4>";

            if (sizeof($countries) > 0) {
                $group_id = -1;
                foreach ($countries as $country) {
                    if ($country['group_id'] != $group_id) {
                        $group_id = $country['group_id'];
                        $group = getCountriesByGroup($group_id);
                        foreach ($group as $ct){
                            ?> <p> <?php echo $ct['country_name']; ?> </p> <?php
                        }
                        ?> <a href="includes/delete_country.inc.php?id=<?php echo $country['country_id']; ?>"> წაშლა <a/> <hr><?php
                    }
                }
            }

            ?>
        </div>
    <?php } ?>
</div>
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
    <select id="langChange" style="padding:3px;
    width: 300px; height:40px;
    -webkit-border-radius:4px;
    -moz-border-radius:4px;
    border-radius:4px;
    -webkit-box-shadow: 0 3px 0 #ccc, 0 -1px #fff inset;
    -moz-box-shadow: 0 3px 0 #ccc, 0 -1px #fff inset;
    box-shadow: 0 3px 0 #ccc, 0 -1px #fff inset;
    background: #f8f8f8;
    color:#888;
    border:none;
    outline:none;
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
        }
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
                           value="<?php if (isset($tr[$i+1])) { echo $tr[$i+1]; }
                           ?>" /> </br>

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
    <?php } ?>

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
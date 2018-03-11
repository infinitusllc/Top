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
    <?php } else { ?>
        <form id="combinations-form" action="includes/add_tr.inc.php" method="post" accept-charset="UTF-8">
            <div style="width: 500px; margin: auto;">
                <?php
                include "includes/languages.inc.php";
                include "includes/get_tr.inc.php";
                include "includes/countries.inc.php";

                $title = "";
                if ( isset($_GET['title']) ){
                    $title = $_GET['title'];
                    ?> <p> ცვლადის შეცვლა ქივორდით <?php echo $title; ?></p> <?php
                }

                $tr = null;
                foreach ($translations as $translation) {
                    if ($translation['title'] == $title){
                        $tr = $translation;
                        break;
                    }
                }
                ?>

                <p> ცვლადის სახელი/ქივორდი (უნდა იყოს უნიკალური): </p>
                <input name="title" class = "textInput" placeholder="*" id = "first_name_client" value="<?php echo $title; ?>" /> </br>

                <input type="hidden" name="old_title" value="<?php echo $title; ?>">
                <input type="hidden" name="is_change" value="<?php if($_GET['title']) { echo 'true'; } else { echo 'false'; } ?>">
                <?php

                for ($i = 0; $i<sizeof($languages); $i++){ ?>

                    <p> ცვლადის მნიშვნელობა - <?php echo $languages[$i]['name']; ?> </p>
                    <input name="value_<?php echo $languages[$i]['id'] ?>" class = "textInput" placeholder="" id = "value"
                           value="<?php if (isset($tr[$i+1])) { echo $tr[$i+1]; }
                           ?>" /> </br>

                <?php } ?>

                <button onclick="document.getElementById('user-form').submit();" style="margin-left: 100px" type="submit" class="button sub" name="submit" value="client"> დამატება </button>
            </div>
            <div name="existing-translations" style="width: 500px; margin: auto">
                <?php
                include "includes/get_tr.inc.php";
                foreach ($translations as $translation) { ?>
                    <form name="line_<?php echo $i; ?>">
                        <hr>
                        <p style="text-align: center">
                            <?php
                            echo "სახელი: ".$translation['title']."</br></br>";
                            for ($j = 0; $j < sizeof($languages)+1; $j++) {
                                if (isset($translation[$j])) {
                                    echo $languages[$j-1]['name'].":</br>";
                                    echo $translation[$j]."</br></br>";

                                }
                            }
                            ?>
                            </br>
                            <a href="includes/delete_tr.inc.php?title=<?php echo $translation['title']; ?>"> წაშლა </a>
                            </br>
                            <a href="admin.php?tab=translations&title=<?php echo $translation['title']; ?>"> შეცვლა </a>

                        </p>
                    </form>
                <?php } ?>
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
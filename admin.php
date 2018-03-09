<html>

<head>
    <?php session_start(); ?>
    <title> ადმინის გვერდი </title>
    <script src="//cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans|Candal|Alegreya+Sans">
    <style>
        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
        }

        li {
            float: left;
        }

        li a {
            display: inline-block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        li a:hover {
            background-color: #111;
        }

        .tabcontent1 {
            display: none;
            border: 1px solid #ccc;
            border-top: none;
        }

        .tabcontent2 {
            display: none;
        }

        input {
            display: inline;
            float: none;
            text-align: center;
            background-color: #ECF0F1;
            border: 2px solid transparent;
            border-radius: 3px;
            font-size: 16px;
            font-weight: 200;
            padding: 10px 0;
            width: 250px;
            transition: border .5s;
            margin-bottom:5px;

        }

        p {
            width: 300px;
            margin-left:100px;
            margin-top: 10px;
        }

        .textInput {
            width: 300px;
            margin-left:100px;
            margin-bottom: 10px;
        }


        .button {
            background-color: #0a662a; /* Green */
            border: none;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
            width: 300px;
            margin: auto;
            border-radius: 3px;
            font-weight: 600;
        }

        .sub{
            font-size: 125%;
            margin-top:20px;
            margin-bottom:20px;
        }

        .column {
            float: left;
            padding-left: 30px;
        }

        #tour-form {
            max-width: 1200px;
            margin: auto;
        }

        .sideBar {
            width: 13%;
            margin-top: 100px;
            margin-left: 1%;
            margin-right: 1%;
            float: left;
            background-color: #2D2D2D;
        }

        .mainArea {
            width: 85%;
            float: left;
        }

    </style>
</head>

<script type="text/javascript">
    function openNews(evt, newsName) {
        // Declare all variables
        var i, tabcontent, tablinks;

        // Get all elements with class="tabcontent" and hide them
        tabcontent = document.getElementsByClassName("tabcontent1");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        // Get all elements with class="tablinks" and remove the class "active"
        tablinks = document.getElementsByClassName("tablinks1");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }

        // Show the current tab, and add an "active" class to the button that opened the tab
        document.getElementById(newsName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    function displayClient() {
        openNews(event, 'main_tr_geo');
    }

    function openTab(evt, newsName) {
        // Declare all variables
        var i, tabcontent, tablinks;

        // Get all elements with class="tabcontent" and hide them
        tabcontent = document.getElementsByClassName("tabcontent2");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        // Get all elements with class="tablinks" and remove the class "active"
        tablinks = document.getElementsByClassName("tablinks2");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }

        // Show the current tab, and add an "active" class to the button that opened the tab
        document.getElementById(newsName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    function displayItem(tab) {
        openTab(event, tab);
    }

</script>

<body onload="displayClient()">

<?php

include "includes/countries.inc.php";
$user = $_SESSION['user'];

$lang = "geo";
if (isset($_GET['lang'])){
    $lang = $_GET['lang'];
}

$tab = "tour_form";
if (isset($_GET['tab'])){
    $tab = $_GET['tab'];
}

switch ($tab) {
    case "tour_form":
        ?> <style> #tour_form { display: block; } </style> <?php
        break;
    case "translations":
        ?> <style> #translations { display: block; } </style> <?php
        break;
    default:
        ?> <style> #tour_form { display: block; } </style> <?php
        break;
}

?>

<div class="sideBar">
    <ul>
        <li class="tablinks2" style="float: left; width: 100%; text-align: center"><a class="tablinks2" onclick="openTab(event, 'tour_form')"> ტურის დამატება </a></li>
        <li class="tablinks2" style="float: left; width: 100%; text-align: center"><a class="tablinks2" onclick="openTab(event, 'translations')"> თარგმნა </a></li>
    </ul>
</div>

<div class="mainArea">
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

        <form id="tour-form" action="includes/add_tour.inc.php" method="post" accept-charset="UTF-8">

        <ul>
            <?php
            include "includes/languages.inc.php";
            foreach ($languages as $language) { ?>
                <li class="tablinks1" style="margin-left: 20px; float: left;"><a class="tablinks1" onclick="openNews(event, 'main_tr_<?php echo $language['keyword']; ?>')"> <?php echo $language['name']; ?> </a></li>
            <?php } ?>
        </ul>

        <?php
        include "includes/languages.inc.php";
        foreach ($languages as $language) { ?>
            <div id="main_tr_<?php echo $language['keyword']; ?>" class="tabcontent1">
                <h3 style="text-align: center"> ენა: <?php echo $language['name'] ?> </h3>
                <h5 style="text-align: center"> აუცილებელია მინიმუმ ერთი ენაზე ტურის სახელისა და ინტროს შევსება </h5>
                <div style="width: 600px; margin: auto;">
                    <p> ტურის სახელი: </p>
                    <input name="tour_name_<?php echo $language['keyword']; ?>" class="textInput" placeholder="*" id="tour_name"/> </br>
                    <p> ქალაქ(ებ)ი: </p>
                    <input name="cities_<?php echo $language['keyword']; ?>" class="textInput" placeholder="" id="cities"/> </br>
                    <p> სასტუმროს სახელი: </p>
                    <input name="hotel_name_<?php echo $language['keyword']; ?>" class="textInput" placeholder="" id="hotel_name"/> </br>
                </div>

                <div style="width: 800px; margin: auto; padding-top: 50px; text-align: center">
                    <p style="text-align: center"> ტურის ინტრო: </p>
                    <textarea name="tour_intro_<?php echo $language['keyword']; ?>" form="tour-form" class="textInput htmlClass" placeholder="ინტრო">  </textarea> </br>
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
                <input name="price" class="textInput" placeholder="" id="price"/> </br>
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
                <input name="q_adult" class="textInput" placeholder="" id="q_adult"/> </br>
                <p> რაოდენობა - ბავშვი: </p>
                <input name="q_kid" class="textInput" placeholder=""  id="q_kid"/> </br>
                <p> რაოდენობა - ჩვილი: </p>
                <input name="q_small" class="textInput" placeholder="" id="q_small"/> </br>
                <p> კვება: </p>
                <select name="food_option" id="food_option"
                        style="margin-left: 100px; margin-bottom:30px; width: 200px; height: 25px">
                    <option value='0'> სამჯერადი </option>;
                    <option value='1'> საუზმე </option>;
                    <option value='2'> კვების გარეშე </option>;
                </select>
                <p> სასტუმროს ვარსკვლავები: </p>
                <input name="hotel_stars" type="text" class="textInput" placeholder=""
                       id="hotel_stars"/> </br>
            </div>
        </div>
            <div style="width: 500px; margin: 50px auto auto;">
            <button onclick="document.getElementById('tour-form').submit();" type="submit" class="sub button"
                    name="submit" value="company"> შექმნა </button>
            </div>
    </form>
    </div>
    <div id="translations" class="tabcontent2">
        <h2 style="text-align: center"> ცვლადის დამატება </h2>
        </br>
        <a href="index.php"> <p style="max-width: 150px; margin: auto"> უკან დაბრუნება </p></a>
        </br>
        <form id="user-form" action="includes/add_tr.inc.php" method="post" accept-charset="UTF-8">

            <div style=" width: 500px; margin: auto;">
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
</div>

</body>

</html>

<html>

<head>
    <?php
    if (session_id() == '' || !isset($_SESSION)) // session isn't started
        session_start(); ?>
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

        #generic-form {
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

<body onload="displayDefault()">

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
    case "combinations":
        ?> <style> #combinations { display: block; } </style> <?php
        break;
    case "generic":
        ?> <style> #generic_page_form { display: block; } </style> <?php
        break;
    case "slide":
        ?> <style> #slide_form { display: block; } </style> <?php
        break;
    default:
        ?> <style> #tour_form { display: block; } </style> <?php
        break;
}

?>

<div class="sideBar">
    <ul>
        <li class="tablinks2" style="float: left; width: 100%; text-align: center"><a class="tablinks2" onclick="openTab(event, 'tour_form',  'tabcontent2', 'tablinks2')"> ტურის დამატება </a></li>
        <li class="tablinks2" style="float: left; width: 100%; text-align: center"><a class="tablinks2" onclick="openTab(event, 'translations', 'tabcontent2', 'tablinks2')"> თარგმნა </a></li>
        <li class="tablinks2" style="float: left; width: 100%; text-align: center"><a class="tablinks2" onclick="openTab(event, 'combinations', 'tabcontent2', 'tablinks2')"> კომბინაციები </a></li>
        <li class="tablinks2" style="float: left; width: 100%; text-align: center"><a class="tablinks2" onclick="openTab(event, 'generic_page_form', 'tabcontent2', 'tablinks2')"> generic გვერდი </a></li>
        <li class="tablinks2" style="float: left; width: 100%; text-align: center"><a class="tablinks2" onclick="openTab(event, 'slide_form', 'tabcontent2', 'tablinks2')"> სლაიდის შექმნა </a></li>
    </ul>
</div>

<div class="mainArea">

    <?php
        include "mods/tour_form.mod.php";
        include "mods/translations_form.mod.php";
        include "mods/combinations_form.inc.php";
        include "mods/generic_page_form.mod.php";
        include "mods/slide_form.mod.php";
    ?>

</div>

</body>

</html>

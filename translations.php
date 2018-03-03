<html>

<head>
    <title> ცვლადის დამატება </title>
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
            margin-left: 100px;
            border-radius: 3px;
            font-weight: 600;
        }

        .sub{
            font-size: 125%;
            margin-top:20px;
            margin-bottom:20px;
        }

        .column {
            width: 500px;
            margin: auto;
        }

        #user-form {
            max-width: 1000px;
            margin: auto;
        }

    </style>
</head>

<body>

<?php
session_start();


include "includes/countries.inc.php";
?>
<h2 style="text-align: center"> ცვლადის დამატება </h2>
</br>
<a href="index.php"> <p style="max-width: 150px; margin: auto"> უკან დაბრუნება </p></a>
</br>
<form id="user-form" action="includes/add_tr.inc.php" method="post" accept-charset="UTF-8">

    <div class="column">
        <p> ცვლადის სახელი/ქივორდი: </p>
        <input name="title" class = "textInput" placeholder="*" id = "first_name_client" /> </br>

        <?php
            include "includes/languages.inc.php";
            for ($i = 0; $i<sizeof($languages); $i++){ ?>

                <p> ცვლადის მნიშვნელობა - <?php echo $languages[$i]['name']; ?> </p>
                <input name="value_<?php echo $languages[$i]['id'] ?>" class = "textInput" placeholder="" id = "value" /> </br>

         <?php } ?>

        <button onclick="document.getElementById('user-form').submit();" type="submit" class="button sub" name="submit" value="client"> დამატება </button>

    </div>

</form>

<?php
if (isset($_GET["message"])) {
    $message = $_GET["message"];
}
?>

</body>

</html>

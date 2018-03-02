<html>

<head>
    <title>ტურის შექმნა</title>
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
            margin-left: 330px;
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

        #user-form {
            max-width: 1000px;
            margin: auto;
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
        openNews(event, 'main');
    }
</script>

<body onload="displayClient()">

<?php
session_start();


include "includes/countries.inc.php";
$user = $_SESSION['user'];


?>

</br>
<h2 style="max-width: 250px; margin: auto"> ახალი ტურის შექმნა </h2>
</br>
<a href="index.php"> <p style="max-width: 150px; margin: auto"> უკან დაბრუნება </p></a>
</br>

<form id="user-form" action="includes/registration.inc.php" method="post" accept-charset="UTF-8">

    <ul>
        <li style="margin-left: 500px"><a class="tablinks1" onclick="openNews(event, 'main')"> ტურის შექმნა </a></li>
    </ul>

    <div id="main" class="tabcontent1">
        <?php if ($user['is_company']) { ?>

            <div class="column">
                <p> ტურის სახელი: </p>
                <input name="first_name_company" class="textInput" placeholder="*" value= <?php echo "'".$user['first_name']."'"; ?> id="first_name"/> </br>
                <p> ქალაქ(ებ)ი: </p>
                <input name="company_name" class="textInput" placeholder="*" value= <?php echo "'".$user['company_name']."'"; ?> id="company_name"/> </br>
                <p> ქვეყანა: </p>
                <select name="country_company" id="country"
                        style="margin-left: 100px; margin-bottom:30px; width: 200px; height: 25px">
                    <?php
                    for ($i = 0; $i < sizeof($countries); $i++) {
                        $v = $countries[$i]['country_id'];
                        $n = $countries[$i]['country_name_geo'];
                        echo "<option value='$v'> $n </option>";
                    }
                    ?>
                </select>
                <p> ფასი: </p>
                <input name="address_company" class="textInput" placeholder="" value= <?php echo "'".$user['address']."'"; ?> id="address_actual"/> </br>
                <p> ვალუტა: </p>
                <select name="country_company" id="country"
                        style="margin-left: 100px; margin-bottom:30px; width: 200px; height: 25px">
                        <option value='0'> GEL </option>;
                        <option value='1'> USD </option>;
                        <option value='2'> EUR </option>;
                </select>
            </div>

            <div class="column">
                <p> რაოდენობა - სრულწლოვანი: </p>
                <input name="last_name_company" class="textInput" placeholder="*" value= <?php echo "'".$user['last_name']."'"; ?> id="last_name"/> </br>
                <p> რაოდენობა - ბავშვი: </p>
                <input name="company_id" class="textInput" placeholder="*" value= <?php echo "'".$user['company_id']."'"; ?> id="company_identification"/> </br>
                <p> რაოდენობა - ჩვილი: </p>
                <input name="legal_address_company" class="textInput" value= <?php echo "'".$user['address_legal']."'"; ?> placeholder="*" id="address"/> </br>
                <p> კვება: </p>
                <select name="country_company" id="country"
                        style="margin-left: 100px; margin-bottom:30px; width: 200px; height: 25px">
                    <option value='0'> სამჯერადი </option>;
                    <option value='1'> საუზმე </option>;
                    <option value='2'> კვების გარეშე </option>;
                </select>
                <p> სასტუმროს სახელი: </p>
                <input name="phone_number_company" class="textInput" placeholder="" value= <?php echo "'".$user['company_number']."'"; ?>
                id="company_phone_number"/> </br>
                <p> სასტუმროს ვარსკვლავები: </p>
                <input name="password2_company" type="ტეხტ" class="textInput" placeholder="*"
                       id="password2"/> </br>
            </div>

            <div style="width: 500px; margin: auto">
                <p style="text-align: center"> ტურის აღწერა: </p>
                <textarea rows="4" cols="50">
                </textarea>
            </div>
            <button onclick="document.getElementById('user-form').submit();" type="submit" class="button sub"
                    name="submit" value="company"> შეცვლა
            </button>
        <?php } else { ?>
            <div class="column">
                <p> სახელი: </p>
                <input name="first_name_client" class = "textInput" placeholder="*" value= <?php echo "'".$user['first_name']."'"; ?> id = "first_name_client" /> </br>
                <p> სქესი: </p>
                <select name="gender_client" id="gender" style="margin-left: 100px; margin-bottom:30px; width: 200px; height: 25px">
                    <option value="0"> მამრ. </option>
                    <option value="1"> მდედრ. </option>
                </select>
                <p> მობილურის ნომერი: </p>
                <input name="mobile_number_client" class = "textInput" placeholder="" value= <?php echo "'".$user['mobile_number']."'"; ?> id ="mobile_number_client" /> </br>
                <p> ქვეყანა: </p>
                <select name="country_client" id="country_client" style="margin-left: 100px; margin-bottom:30px; width: 200px; height: 25px">
                    <?php
                    for ($i=0; $i<sizeof($countries); $i++){
                        $v = $countries[$i]['country_id'];
                        $n = $countries[$i]['country_name_geo'];
                        echo "<option value='$v'> $n </option>";
                    }
                    ?>
                </select>
                <p> პაროლი: </p>
                <input name="password_client" type="password" class = "textInput" placeholder="*" id = "password" /> </br>
            </div>
            <div class="column">
                <p> გვარი: </p>
                <input name="last_name_client" class = "textInput" placeholder="*" value= <?php echo "'".$user['last_name']."'"; ?> id = "last_name_client" /> </br>
                <p> დაბადების თარიღი: </p>
                <input name="date_of_birth_client" type="date" class = "textInput" placeholder="*" value= <?php echo "'".$user['birth_date']."'"; ?> id = "date_of_birth_client" /> </br>
                <p> ი-მეილი: </p>
                <input name="e_mail_client" class = "textInput" placeholder="*" value= <?php echo "'".$user['e_mail']."'"; ?> id = "e_mail" /> </br>
                <p> მისამართი: </p>
                <input name="address_client" class = "textInput" placeholder="" value= <?php echo "'".$user['address']."'"; ?> id = "address" /> </br>
                <p> პაროლი განმეორებით: </p>
                <input name="password2_client" type="password" class = "textInput" placeholder="*" id = "password2" /> </br>
            </div>
            <button onclick="document.getElementById('user-form').submit();" type="submit" class="button sub" name="submit" value="client"> რეგისტრაცია </button>

        <?php } ?>
    </div>


</form>

<?php
if (isset($_GET["message"])) {
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
        case "error5": //unknown error
            ?>  <p style="margin: auto; text-align: center; color:red"> რეგისტრაციისას დაფიქსირდა შეცდომა </p>  <?php
            break;

    }
}
?>

</body>

</html>

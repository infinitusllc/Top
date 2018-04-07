<html>

<head>
    <title>რეგისტრაცია</title>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans|Candal|Alegreya+Sans">
    <?php include "mods/style.mod.php"; ?>
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
        openNews(event, 'client');
    }
</script>

<body onload="displayClient()">

<?php
if (session_id() == '' || !isset($_SESSION)) // session isn't started
    session_start();

include "includes/countries.inc.php";
?>
<h2> რეგისტრაცია </h2>
<h4><a href="index.php"> მთავარ გვერდზე </a></h4>
    <form id="user-form" action="includes/registration.inc.php" method="post" accept-charset="UTF-8">

        <ul>
            <li><a class="tablinks1" onclick="openNews(event, 'client')"> კერძო პირი </a></li>
            <li><a class="tablinks1" onclick="openNews(event, 'company')"> კომპანია </a></li>
        </ul>

<!--        კლიენტის ფორმა-->
        <div id="client" class="tabcontent1">
            <div class="column">
                <p> სახელი: </p>
                <input name="first_name_client" class = "textInput" placeholder="*" id = "first_name_client" />
                <p> სქესი: </p>
                <select name="gender_client" id="gender">
                    <option value="0"> მამრ. </option>
                    <option value="1"> მდედრ. </option>
                </select>
                <p> მობილურის ნომერი: </p>
                <input name="mobile_number_client" class = "textInput" placeholder="" id ="mobile_number_client" />
                <p> ქვეყანა: </p>
                <select name="country_client" id="country_client">
                    <?php
                        for ($i=0; $i<sizeof($countries); $i++){
                            $v = $countries[$i]['country_id'];
                            $n = $countries[$i]['country_name'];
                            echo "<option value='$v'> $n </option>";
                        }
                    ?>
                </select>
                <p> პაროლი: </p>
                <input name="password_client" type="password" class = "textInput" placeholder="*" id = "password" />
            </div>
            <div class="column">
                <p> გვარი: </p>
                <input name="last_name_client" class = "textInput" placeholder="*" id = "last_name_client" />
                <p> დაბადების თარიღი: </p>
                <input name="date_of_birth_client" type="date" class = "textInput" placeholder="*" id = "date_of_birth_client" />
                <p> ი-მეილი: </p>
                <input name="e_mail_client" class = "textInput" placeholder="*" id = "e_mail" />
                <p> მისამართი: </p>
                <input name="address_client" class = "textInput" placeholder="" id = "address" />
                <p> პაროლი განმეორებით: </p>
                <input name="password2_client" type="password" class = "textInput" placeholder="*" id = "password2" />
            </div>
            <button onclick="document.getElementById('user-form').submit();" type="submit" class="button sub" name="submit" value="client"> რეგისტრაცია </button>
        </div>

<!--        კომპანიის ფორმა-->
        <div id="company" class="tabcontent1">
            <div class="column">
                <p> სახელი: </p>
                <input name="first_name_company" class = "textInput" placeholder="*" id = "first_name" />
                <p> კომპანიის სახელი: </p>
                <input name="company_name" class = "textInput" placeholder="*" id = "company_name" />
                <p> ქვეყანა: </p>
                <select name="country_company" id="country">
                    <?php
                    for ($i=0; $i<sizeof($countries); $i++){
                        $v = $countries[$i]['country_id'];
                        $n = $countries[$i]['country_name_geo'];
                        echo "<option value='$v'> $n </option>";
                    }
                    ?>
                </select>
                <p> რეალური მისამართი: </p>
                <input name="address_company" class = "textInput" placeholder="" id = "address_actual" />
                <p> მობილურის ნომერი: </p>
                <input name="mobile_number_company" class = "textInput" placeholder="" id = "phone_number" />
                <p> პაროლი: </p>
                <input name="password_company" type="password" class = "textInput" placeholder="*" id = "password" />
            </div>
            <div class="column">
                <p> გვარი: </p>
                <input name="last_name_company" class = "textInput" placeholder="*" id = "last_name" />
                <p> კომპანიის ID: </p>
                <input name="company_id" class = "textInput" placeholder="*" id = "company_identification" />
                <p> იურიდიული მისამართი: </p>
                <input name="legal_address_company" class = "textInput" placeholder="*" id = "address" />
                <p> ი-მეილი: </p>
                <input name="e_mail_company" class = "textInput" placeholder="*" id = "e_mail" />
                <p> კომპანიის ტელეფონის ნომერი: </p>
                <input name="phone_number_company" class = "textInput" placeholder="" id = "company_phone_number" />
                <p> პაროლი განმეორებით: </p>
                <input name="password2_company" type="password" class = "textInput" placeholder="*" id = "password2" />
            </div>
            <button onclick="document.getElementById('user-form').submit();" type="submit" class="button sub" name="submit" value="company"> რეგისტრაცია </button>
        </div>
    </form>

<!--    პასუხი, თუ როგორ ჩაიარა რეგისტრაციამ-->
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

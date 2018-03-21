<?php
$_SESSION['user'];
if(isset($_COOKIE['e_mail']) and isset($_COOKIE['password'])
    and !empty($_COOKIE['e_mail']) and !empty($_COOKIE['password'])
    and (!isset($_SESSION["logged"]) || $_SESSION["logged"] == false)
    and (!isset($_SESSION['unlogged']) || $_SESSION['unlogged']) == false) {
    header("Location: includes/login.inc.php");
    exit();
}
?>

<div id="login-form" class="overlay">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div class="overlay-content" style="background-color: gray; width: fit-content; padding: 50px; margin: auto">
        <h4 style="margin-bottom: 15px"> შესვლა </h4>
        <form id="login_form" action="includes/login.inc.php" method="post">
            <input type="text" name="e_mail" placeholder="e-mail" style="border: solid darkgray; background-color: floralwhite"/> <br> <br>
            <input type="password" name="password" placeholder="password" style="border: solid darkgray; background-color: floralwhite"/> <br> <br>
            <button type="submit" class="button sub" name="submit" style="border: solid darkgray; padding: 10px"> შესვლა</button> <br> <br>
            <input type="checkbox" name="remember" value="true"  title="remember" style="-webkit-appearance: checkbox"/> იუზერის დამახსოვრება <br> <br>
        </form>
        <form action="registration.php" style="display: inline-block; margin: 5px">
            <input type="submit" value="რეგისტრაცია" style="border: solid darkgray; padding: 10px"/>
        </form>
    </div>
</div>
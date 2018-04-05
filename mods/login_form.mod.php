<?php
if  (isset($_COOKIE['e_mail']) and isset($_COOKIE['password'])
    and !empty($_COOKIE['e_mail']) and !empty($_COOKIE['password'])
    and (!isset($_SESSION["logged"]) || $_SESSION["logged"] == false)
    and (!isset($_SESSION['unlogged']) || $_SESSION['unlogged']) == false) {
        header("Location: includes/login.inc.php");
        exit();
}
?>

<div id="login-form" class="overlay" style="z-index: 110">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div class="overlay-content login-frm common-style">
        <h1>შესვლა</h1>
        <form id="login_form" action="includes/login.inc.php" method="post">
            <input type="text" style="width:255px" name="e_mail" placeholder="e-mail"/><br>
            <input type="password" style="width:255px" name="password" placeholder="password"/><br>
			<!--
				<label>
				  <input type='checkbox'>
				  <span></span>
				  მომხმარებლის დამახსოვრება
				</label>
				<input type="checkbox" name="remember" value="true"  title="remember"/> იუზერის დამახსოვრება<br>
			-->
			<button type="submit" class="button sub" name="submit"> შესვლა</button><br>
			<a href="registration.php">მომხმარებლის რეგისტრაცია..</a>
        </form>
    </div>
</div>
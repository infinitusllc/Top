<?php
if  (isset($_COOKIE['e_mail']) and isset($_COOKIE['password'])
    and !empty($_COOKIE['e_mail']) and !empty($_COOKIE['password'])
    and (!isset($_SESSION["logged"]) || $_SESSION["logged"] == false)
    and (!isset($_SESSION['unlogged']) || $_SESSION['unlogged']) == false) {
        header("Location: includes/login.inc.php");
        exit();
}
?>

<?php if(isset($_GET['message'])) { ?>
    <div id="login-form" class="overlay" style="z-index: 110; display: block">
<?php } else { ?>
    <div id="login-form" class="overlay" style="z-index: 110">
<?php } ?>
    <div class="overlay-content login-frm common-style">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
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
            <?php
                if (isset($_GET['message'])) {
                    switch ($_GET['message']) {
                        case "error1":
                            echo "<p> გთხოვთ, შეავსოთ ყველა ველი </p>";
                            break;
                        case "error2":
                            echo "<p> შეყვანილი მონაცემები არასწორია </p>";
                            break;
                        default:
                            echo "<p> დაფიქსირდა შეცდომა </p>";
                            break;
                    }
                }
            ?>
			<button type="submit" class="button sub" name="submit" style="margin-top: 10px"> შესვლა</button><br>
			<a href="registration.php">მომხმარებლის რეგისტრაცია..</a>
        </form>
    </div>
</div>
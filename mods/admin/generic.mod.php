<div id="generic_form" class="mainArea">

    <script type="text/javascript">

        function displayDefault() {
            document.getElementById('generic_tr_geo').style.display = "block";
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
    </script>

    <h2> ახალი გვერდის შექმნა </h2>

    <!-- after the user submits the form, he's returned back to the same page, with the corresponding message -->
    <?php if (isset($_GET["message"])) {
        $message = $_GET["message"];
        switch ($message) {
            case "error1": //not all mandatory inputs filled
                ?>  <p> გთხოვთ, შეავსოთ ყველა აუცილებელი ველი (მონიშნულია სიმბოლოთი *) </p>  <?php
                break;
            case "error2": //passwords don't match
                ?>  <p> შეყვანილი პაროლები არ ემთხვევა ერთმანეთს </p>  <?php
                break;
            case "error3": //password too short
                ?>  <p> შეყვანილი პაროლი ძალიან მოკლეა (მინ. 6 სიმბოლო) </p>  <?php
                break;
            case "error4": //e-mail already exists
                ?>  <p> შეყვანილი პაროლები არ ემთხვევა ერთმანეთს </p>  <?php
                break;
            case "success":
                ?>  <p> ოპერაცია წარმატებით შესრულდა </p>  <?php
                break;
        }
    } ?>

    <form id="generic-form" action="includes/add_generic.inc.php" method="post" accept-charset="UTF-8" enctype="multipart/form-data" onload="displayDefault()">
        <?php
        $keyword = "";
        if (isset($_GET['keyword'])) {
            $keyword = $_GET['keyword']; ?>
            <input type="hidden" name="change" value="true">
            <input type="hidden" name="key" value="<?php echo $keyword; ?>">
        <?php } else { ?>
            <input type="hidden" name="change" value="false">
        <?php } ?>
        <ul class="tablinks">
            <?php
            include "includes/languages.inc.php";
            foreach ($languages as $language) { ?>
                <li class="tablinks1"><a class="tablinks1" onclick="openTab(event, 'generic_tr_<?php echo $language['keyword']; ?>',  'tabcontent', 'tablinks1')"> <?php echo $language['name']; ?> </a></li>
            <?php } ?>
        </ul>

        <?php
        include "includes/languages.inc.php";
        include "includes/get_generics.inc.php";
        foreach ($languages as $language) {
            if ($language['keyword'] == 'geo') {?>
                <div id="generic_tr_<?php echo $language['keyword']; ?>" class="tabcontent" style="display: block">
            <?php } else { ?>
                <div id="generic_tr_<?php echo $language['keyword']; ?>" class="tabcontent">
            <?php } ?>
                <h3> ენა: <?php echo $language['name'] ?> </h3>
                <div>
                    <?php if ($keyword != "") {?>
                        <p> იცვლება გვერდი ქივორდით: <?php echo $keyword; ?> </p>

                    <?php } if ($language['id'] == 1) { ?>
                        <p> გვერდის ქივორდი (უნდა იყოს უნიკალური): * </p>
                        <input name="genpage_keyword" class="textInput" placeholder="*" id="genpage_keyword" value="<?php if ($keyword != "") echo $keyword; ?>"/> </br>
                    <?php } ?>
                    <p> გვერდის სახელი/სათაური: * </p>
                    <input name="genpage_name_<?php echo $language['keyword']; ?>" oninput="checkName('genpage_name_<?php echo $language['keyword']; ?>')" class="textInput" placeholder="*" value="<?php if ($keyword != "") echo $generics[$keyword][$language['id']]['title']; ?>" id="genpage_name_<?php echo $language['keyword']; ?>"/> </br>
                    <div id="post_genpage_name_<?php echo $language['keyword']; ?>"> </div>
                    <p> გვერდის ტიპი: </p>
                    <input name="genpage_type_<?php echo $language['keyword']; ?>" oninput="checkName('genpage_name_<?php echo $language['keyword']; ?>')" class="textInput" placeholder=""  value="<?php if ($keyword != "") echo $generics[$keyword][$language['id']]['type']; ?>" id="genpage_name_<?php echo $language['keyword']; ?>"/> </br>
                </div>

                <div>
                    <p> ინტრო: * </p>
                    <textarea name="genpage_intro_<?php echo $language['keyword']; ?>" form="generic-form" class="textInput htmlClass" id="genpage_intro_<?php echo $language['keyword']; ?>" placeholder="ინტრო" >  <?php if ($keyword != "") echo $generics[$keyword][$language['id']]['intro']; ?> </textarea> </br>
                    <script>
                        CKEDITOR.replace( "genpage_intro_<?php echo $language['keyword']; ?>" );
                    </script>
                </div>

                <div>
                    <p> აღწერა: *</p>
                    <textarea name="genpage_description_<?php echo $language['keyword']; ?>" form="generic-form" class="textInput htmlClass" placeholder="*"> <?php if ($keyword != "") echo $generics[$keyword][$language['id']]['content']; ?>  </textarea> </br>
                    <script>
                        CKEDITOR.replace( "genpage_description_<?php echo $language['keyword']; ?>" );
                    </script>
                </div>
            </div>
        <?php } ?>

        <div>
            <p> სურათი: </p>
            <input type="file" name="fileToUpload" id="fileToUpload"> </br>

            <button onclick="document.getElementById('generic-form').submit();" type="submit" class="sub button"
                    name="submit" value="company"> შექმნა </button>
        </div>
    </form>

    <h4> არსებული გვერდები: </h4>
    <?php
    include "includes/get_generics_for_form.inc.php";

    foreach ($gens as $gen) {
        echo "<hr> <p> ქივორდი: ".$gen['keyword']."</p>";
        if (isset($gen['image_url'])) { ?>
            <img src="<?php echo $gen['image_url']; ?>" width="50%">
        <?php } ?>
        <a href="admin.php?tab=generic&keyword=<?php echo $gen['keyword'] ?>"> <p> შეცვლა </p> </a>
        <a href="includes/delete_generic.inc.php?tab=generic&keyword=<?php echo $gen['keyword'] ?>"> <p> წაშლა </p> </a>
        <?php
    }

    ?>

</div>
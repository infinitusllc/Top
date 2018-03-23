<div id="generic_page_form" class="tabcontent2">
    </br>
    <h2 style="max-width: 350px; margin: auto"> ახალი გვერდის შექმნა </h2>
    </br>
    <a href="index.php" > <p style="max-width: 180px; margin: auto"> უკან დაბრუნება </p></a>
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
            case "success":
                ?>  <p style="margin: auto; text-align: center; color:red"> ოპერაცია წარმატებით შესრულდა </p>  <?php
                break;
        }
    }


    ?>

    <form id="generic-form" action="includes/add_generic.inc.php" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
        <?php
            $keyword = "";
            if (isset($_GET['keyword'])) {
                $keyword = $_GET['keyword']; ?>
                <input type="hidden" name="change" value="true">
                <input type="hidden" name="key" value="<?php echo $keyword; ?>">
            <?php } else { ?>
                <input type="hidden" name="change" value="false">
            <?php } ?>
        <ul>
            <?php
            include "includes/languages.inc.php";
            foreach ($languages as $language) { ?>
                <li class="tablinks1" style="margin-left: 20px; float: left;"><a class="tablinks1" onclick="openTab(event, 'generic_tr_<?php echo $language['keyword']; ?>',  'tabcontent1', 'tablinks1')"> <?php echo $language['name']; ?> </a></li>
            <?php } ?>
        </ul>

        <?php
        include "includes/languages.inc.php";
        include "includes/get_generics.inc.php";
        foreach ($languages as $language) { ?>
            <div id="generic_tr_<?php echo $language['keyword']; ?>" class="tabcontent1">
                <h3 style="text-align: center"> ენა: <?php echo $language['name'] ?> </h3>
                <div style="width: 600px; margin: auto;">
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

                <div style="width: 800px; margin: auto; padding-top: 50px; text-align: center">
                    <p style="text-align: center"> ინტრო: * </p>
                    <textarea name="genpage_intro_<?php echo $language['keyword']; ?>" form="generic-form" class="textInput htmlClass" id="genpage_intro_<?php echo $language['keyword']; ?>" placeholder="ინტრო" >  <?php if ($keyword != "") echo $generics[$keyword][$language['id']]['intro']; ?> </textarea> </br>
                    <script>
                        CKEDITOR.replace( "genpage_intro_<?php echo $language['keyword']; ?>" );
                    </script>
                </div>

                <div style="width: 800px; margin: auto; margin-bottom: 100px; padding-top: 50px">
                    <p style="text-align: center"> აღწერა: *</p>
                    <textarea name="genpage_description_<?php echo $language['keyword']; ?>" form="generic-form" class="textInput htmlClass" placeholder="*"> <?php if ($keyword != "") echo $generics[$keyword][$language['id']]['content']; ?>  </textarea> </br>
                    <script>
                        CKEDITOR.replace( "genpage_description_<?php echo $language['keyword']; ?>" );
                    </script>
                </div>

                <input type="hidden" name="user_id" value=<?php echo "'" . $user['id'] . "''"; ?>>
                <input type="hidden" name="lang" value=<?php echo "'" . $lang . "''"; ?>>
            </div>
        <?php } ?>

        <div style="width: 500px; margin: 50px auto 100px;">
            <p> სურათი: </p>
            <input type="file" name="fileToUpload" id="fileToUpload"> </br>

            <button onclick="document.getElementById('generic-form').submit();" type="submit" class="sub button"
                    name="submit" value="company"> შექმნა </button>
        </div>
    </form>

    <h4 style="max-width: 300px; margin:auto"> არსებული გვერდები: </h4>
    <?php
        include "includes/get_generics_for_form.inc.php";

        foreach ($gens as $gen) {
            echo "<hr> <p style='max-width: 300px; margin:auto'> ქივორდი: ".$gen['keyword']."</p>";
            ?> <a href="admin.php?tab=generic&keyword=<?php echo $gen['keyword'] ?>"> <p style='max-width: 300px; margin: auto auto;'> შეცვლა </p> </a>
            <a href="includes/delete_generic.inc.php?tab=generic&keyword=<?php echo $gen['keyword'] ?>"> <p style='max-width: 300px; margin: auto auto 100px;'> წაშლა </p> </a>
            <?php
        }

    ?>

</div>
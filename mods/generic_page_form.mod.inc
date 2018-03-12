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
            case "success": //unknown error
                ?>  <p style="margin: auto; text-align: center; color:red"> ტური წარმატებით დამატებულია </p>  <?php
                break;
        }
    }  ?>

    <form id="generic-form" action="includes/add_generic.inc.php" method="post" accept-charset="UTF-8">

        <ul>
            <?php
            include "includes/languages.inc.php";
            foreach ($languages as $language) { ?>
                <li class="tablinks1" style="margin-left: 20px; float: left;"><a class="tablinks1" onclick="openTab(event, 'generic_tr_<?php echo $language['keyword']; ?>',  'tabcontent1', 'tablinks1')"> <?php echo $language['name']; ?> </a></li>
            <?php } ?>
        </ul>

        <?php
        include "includes/languages.inc.php";
        foreach ($languages as $language) { ?>
            <div id="generic_tr_<?php echo $language['keyword']; ?>" class="tabcontent1">
                <h3 style="text-align: center"> ენა: <?php echo $language['name'] ?> </h3>
                <h5 style="text-align: center"> აუცილებელია მინიმუმ ერთი ენაზე ყველა ველის შევსება </h5>
                <div style="width: 600px; margin: auto;">
                    <p> გვერდის სახელი/სათაური: * </p>
                    <input name="genpage_name_<?php echo $language['keyword']; ?>" oninput="checkName('genpage_name_<?php echo $language['keyword']; ?>')" class="textInput" placeholder="*" id="genpage_name_<?php echo $language['keyword']; ?>"/> </br>
                    <div id="post_genpage_name_<?php echo $language['keyword']; ?>"> </div>
                    <p> გვერდის ტიპი: </p>
                    <input name="genpage_type_<?php echo $language['keyword']; ?>" oninput="checkName('genpage_name_<?php echo $language['keyword']; ?>')" class="textInput" placeholder="" id="genpage_name_<?php echo $language['keyword']; ?>"/> </br>
                </div>

                <div style="width: 800px; margin: auto; padding-top: 50px; text-align: center">
                    <p style="text-align: center"> ინტრო: * </p>
                    <textarea name="genpage_intro_<?php echo $language['keyword']; ?>" form="generic-form" class="textInput htmlClass" id="genpage_intro_<?php echo $language['keyword']; ?>" placeholder="ინტრო">  </textarea> </br>
                    <script>
                        CKEDITOR.replace( "genpage_intro_<?php echo $language['keyword']; ?>" );
                    </script>
                </div>

                <div style="width: 800px; margin: auto; margin-bottom: 100px; padding-top: 50px">
                    <p style="text-align: center"> აღწერა: </p>
                    <textarea name="genpage_description_<?php echo $language['keyword']; ?>" form="generic-form" class="textInput htmlClass" placeholder="*">  </textarea> </br>
                    <script>
                        CKEDITOR.replace( "genpage_description_<?php echo $language['keyword']; ?>" );
                    </script>
                </div>

                <input type="hidden" name="user_id" value=<?php echo "'" . $user['id'] . "''"; ?>>
                <input type="hidden" name="lang" value=<?php echo "'" . $lang . "''"; ?>>
            </div>
        <?php } ?>

        <div style="width: 500px; margin: 50px auto auto;">
            <button onclick="document.getElementById('generic-form').submit();" type="submit" class="sub button"
                    name="submit" value="company"> შექმნა </button>
        </div>
    </form>
</div>
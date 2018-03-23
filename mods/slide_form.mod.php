<div id="slide_form" class="tabcontent2">
    </br>
    <h2 style="max-width: 270px; margin: auto"> ახალი სლაიდის შექმნა (ჯერ არ მუშაობს) </h2>
    </br>
    <a href="index.php"> <p style="max-width: 150px; margin: auto"> უკან დაბრუნება </p></a>
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

    <form id="slide-form" action="includes/add_slide.inc.php" method="post" accept-charset="UTF-8" enctype="multipart/form-data">

        <ul>
            <?php
            include "includes/languages.inc.php";
            foreach ($languages as $language) { ?>
                <li class="tablinks1" style="margin-left: 20px; float: left;"><a class="tablinks1" onclick="openTab(event, 'slide_tr_<?php echo $language['keyword']; ?>',  'tabcontent1', 'tablinks1')"> <?php echo $language['name']; ?> </a></li>
            <?php } ?>
        </ul>

        <?php
        include "includes/languages.inc.php";
        foreach ($languages as $language) { ?>
            <div id="slide_tr_<?php echo $language['keyword']; ?>" class="tabcontent1">
                <h3 style="text-align: center"> ენა: <?php echo $language['name'] ?> </h3>

                <div style="width: 800px; margin: auto; padding-top: 50px; text-align: center">
                    <p style="margin:auto"> სათაური </p>
                    <input type="text" name="slide_title_<?php echo $language['keyword']; ?>" title="title">
                    <p style="text-align: center"> სლაიდის ინტრო: * </p>
                    <textarea name="slide_intro_<?php echo $language['keyword']; ?>" form="slide-form" class="textInput htmlClass" id="slide_intro_<?php echo $language['keyword']; ?>" placeholder="ინტრო">  </textarea> </br>
                    <script>
                        CKEDITOR.replace( "slide_intro_<?php echo $language['keyword']; ?>" );
                    </script>
                </div>

                <div style="width: 800px; margin: auto; margin-bottom: 100px; padding-top: 50px">
                    <p style="text-align: center"> სლაიდის აღწერა: </p>
                    <textarea name="slide_description_<?php echo $language['keyword']; ?>" form="slide-form" class="textInput htmlClass" placeholder="*">  </textarea> </br>
                    <script>
                        CKEDITOR.replace( "slide_description_<?php echo $language['keyword']; ?>" );
                    </script>
                </div>


                <input type="hidden" name="user_id" value=<?php echo "'" . $user['id'] . "''"; ?>>
                <input type="hidden" name="lang" value=<?php echo "'" . $lang . "''"; ?>>
            </div>
        <?php } ?>

        <div id="slide_non_tr" style="display: inline-block; border: 1px solid #ccc; width: 100%;">
           <div style="width: 200px; margin:auto">
               <div style="width: 600px; margin: auto;">
                   <p> ქივორდი (იუზერი ვერ ხედავს): * </p>
                   <input name="slide_keyword" class="textInput" placeholder="*" id="slide_name_<?php echo $language['keyword']; ?>"/> </br>
                    <p> შესაბამისი ტურის url </p>
                   <input name="slide_tour_url" class="textInput" placeholder="*" id="slide_name_<?php echo $language['keyword']; ?>"/> </br>
               </div>
               <p> სურათი: </p>
               <input type="file" name="fileToUpload" id="fileToUpload" style="margin-left: 100px;"> </br>
           </div>
        </div>

        <div style="width: 500px; margin: 50px auto auto;">
            <button onclick="document.getElementById('slide-form').submit();" type="submit" class="sub button"
                    name="submit" value="company"> შექმნა </button>
        </div>
    </form>
</div>
<div id="translations" class="tabcontent2">
    <h2 style="text-align: center"> ცვლადის დამატება </h2>
    </br>
    <a href="index.php"> <p style="max-width: 150px; margin: auto"> უკან დაბრუნება </p></a>
    </br>
    <form id="translation-form" action="includes/add_tr.inc.php" method="post" accept-charset="UTF-8">

        <div style="width: 500px; margin: auto;">
            <?php
            include "includes/languages.inc.php";
            include "includes/get_tr.inc.php";
            include "includes/countries.inc.php";

            $title = "";
            if ( isset($_GET['title']) ){
                $title = $_GET['title'];
                ?> <p> ცვლადის შეცვლა ქივორდით <?php echo $title; ?></p> <?php
            }

            $tr = null;
            foreach ($translations as $translation) {
                if ($translation['title'] == $title){
                    $tr = $translation;
                    break;
                }
            }
            ?>
            <p> ცვლადის სახელი/ქივორდი (უნდა იყოს უნიკალური): </p>
            <input name="title" class = "textInput" placeholder="*" id = "first_name_client" value="<?php echo $title; ?>" /> </br>

            <input type="hidden" name="old_title" value="<?php echo $title; ?>">
            <input type="hidden" name="is_change" value="<?php if($_GET['title']) { echo 'true'; } else { echo 'false'; } ?>">
            <?php
            for ($i = 0; $i<sizeof($languages); $i++){ ?>
                <p> ცვლადის მნიშვნელობა - <?php echo $languages[$i]['name']; ?> </p>
                <input name="value_<?php echo $languages[$i]['id'] ?>" class = "textInput" placeholder="" id = "value"
                       value="<?php if (isset($tr[$i+1])) { echo $tr[$i+1]; }
                       ?>" /> </br>

            <?php } ?>
            <button onclick="document.getElementById('user-form').submit();" style="margin-left: 100px" type="submit" class="button sub" name="submit" value="client"> დამატება </button>
        </div>
        <div name="existing-translations" style="width: 500px; margin: auto">
            <?php
            include "includes/get_tr.inc.php";
            foreach ($translations as $translation) { ?>
                <form name="line_<?php echo $i; ?>">
                    <hr>
                    <p style="text-align: center">
                        <?php
                        echo "სახელი: ".$translation['title']."</br></br>";
                        for ($j = 0; $j < sizeof($languages)+1; $j++) {
                            if (isset($translation[$j])) {
                                echo $languages[$j-1]['name'].":</br>";
                                echo $translation[$j]."</br></br>";

                            }
                        }
                        ?>
                        </br>
                        <a href="includes/delete_tr.inc.php?title=<?php echo $translation['title']; ?>"> წაშლა </a>
                        </br>
                        <a href="admin.php?tab=translations&title=<?php echo $translation['title']; ?>"> შეცვლა </a>
                    </p>
                </form>
            <?php } ?>
        </div>
    </form>
    <?php if (isset($_GET["message"])) {
        $message = $_GET["message"];
        switch ($message) {
            case "error1": //not all mandatory inputs filled
                ?>  <p style="margin: auto; text-align: center; color:red"> ცვლადი ასეთი სახელით უკვე არსებობს/ცვლადის სახელი შეყვანილი არაა </p>  <?php
                break;
            case "success":
                ?>  <p style="margin: auto; text-align: center; color:red"> ოპერაცია წარმატებით შესრულდა </p>  <?php
                break;

        }
    } ?>
</div>
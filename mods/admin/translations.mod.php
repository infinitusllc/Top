<div id="translations" class="mainArea">
    <h2> ახლის დამატება </h2>
    <form id="translation-form" action="includes/add_tr.inc.php" method="post" accept-charset="UTF-8">

        <div style="width: 100%; margin: auto;">
            <?php
            include "includes/languages.inc.php";
            include "includes/get_tr.inc.php";

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
            <?php if (isset($_GET["message"])) {
                $message = $_GET["message"];
                switch ($message) {
                    case "error1": //not all mandatory inputs filled
                        ?>  <span style="text-align: left; color:red"> ცვლადი ასეთი სახელით უკვე არსებობს/ცვლადის სახელი შეყვანილი არაა </span>  <?php
                        break;
                    case "success":
                        ?>  <span style="text-align: left; color:red"> ოპერაცია წარმატებით შესრულდა </span>  <?php
                        break;

                }
            } ?> <br>
            ცვლადის ქივორდი (უნდა იყოს უნიკალური):
            <input name="title" placeholder="*" id = "first_name_client" value="<?php echo $title; ?>" />

            <input type="hidden" name="old_title" value="<?php echo $title; ?>">
            <input type="hidden" name="is_change" value="<?php if($_GET['title']) { echo 'true'; } else { echo 'false'; } ?>">
            <?php
            for ($i = 0; $i<sizeof($languages); $i++){ ?>
                &nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $languages[$i]['name']; ?>
                <input name="value_<?php echo $languages[$i]['id'] ?>" placeholder="" id = "value"
                       value="<?php if (isset($tr[$i+1])) { echo $tr[$i+1]; }
                       ?>" />

            <?php } ?>
            <button onclick="document.getElementById('user-form').submit();" style="margin-left: 21px" type="submit" class="button sub" name="submit" value="client"> შენახვა </button>
        </div>
        <div name="existing-translations" style="width: 100%; margin: auto">
            <hr> <h2> არსებულები </h2>
            <?php
            include "includes/get_tr.inc.php";
            foreach ($translations as $translation) { ?>
                <form name="line_<?php echo $i; ?>">
                    <hr>
                    <?php
                    echo "ქივორდი: ".$translation['title']." <br><br>";
                    for ($j = 0; $j < sizeof($languages)+1; $j++) {
                        if (isset($translation[$j])) {
                            echo $languages[$j-1]['name'].": ";
                            echo $translation[$j]." <br><br> ";
                        }
                    }
                    ?>
                    </br>
                    <a href="includes/delete_tr.inc.php?title=<?php echo $translation['title']; ?>">წაშლა</a>&nbsp
                    <a href="admin2.php?tab=translations&title=<?php echo $translation['title']; ?>">შეცვლა</a>
                </form>
            <?php } ?>
        </div>
    </form>
</div>
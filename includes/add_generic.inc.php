<?php
session_start();

if(isset($_POST['submit'])) {
    include 'dbc.inc.php';

    include "languages.inc.php";

    $empty = 1;
    foreach ($languages as $language) {
        $suffix = $language['keyword'];
        $genpage_name = mysqli_real_escape_string($conn, $_POST["genpage_name_$suffix"]);
        $genpage_intro = mysqli_real_escape_string($conn, $_POST["genpage_intro_$suffix"]);

        echo $genpage_name;
        echo "</br>";
        echo $genpage_intro;
        echo "</br>";
        if (!empty($genpage_name) && !empty($genpage_intro))
            $empty = 0;
    }

    if ($empty == 1) {
        header("Location: ../admin.php?tab=generic&message=error1");
        exit();
    }

    if ($conn) {
        //insert for one language
        //go over, insert all other used languages
        $first = 1;
        $id = -1;
        $genpage_keyword = mysqli_real_escape_string($conn, $_POST["genpage_keyword"]);
        foreach ($languages as $language) {
            $suffix = $language['keyword'];
            $genpage_name = mysqli_real_escape_string($conn, $_POST["genpage_name_$suffix"]);
            $genpage_intro = mysqli_real_escape_string($conn, $_POST["genpage_intro_$suffix"]);
            $genpage_description = mysqli_real_escape_string($conn, $_POST["genpage_description_$suffix"]);
            $type = mysqli_real_escape_string($conn, $_POST["genpage_type_$suffix"]);

            if (!empty($genpage_name) && !empty($genpage_description)) {
                $lang_key = $language['id'];
                if ($first == 1) {
                    $sql = "INSERT INTO generic_page_content (title, intro, content, language_key, type, keyword) VALUES 
                                                    ('$genpage_name', '$genpage_intro', '$genpage_description', '$lang_key', '$type', '$genpage_keyword')";
                    $result = mysqli_query($conn, $sql);
                    $sql = "SELECT id FROM generic_page_content WHERE content = '$genpage_description' ORDER BY id DESC";
                    $result = mysqli_query($conn, $sql);
                    $id = mysqli_fetch_assoc($result)['id'];
                    $sql = "UPDATE generic_page_content SET group_id = $id WHERE id = $id";
                    $result = mysqli_query($conn, $sql);
                    $first = 0;
                } else {
                    $sql = "INSERT INTO generic_page_content (title, intro, content, language_key, type, group_id, keyword) VALUES 
                                                    ('$genpage_name', '$genpage_intro', '$genpage_description', '$lang_key', '$type', $id, '$genpage_keyword')";
                    $result = mysqli_query($conn, $sql);
                }
            }
        }
        header("Location: ../admin.php?tab=generic&message=success");
        exit();
    }
}
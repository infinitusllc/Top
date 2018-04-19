<?php

if (isset($_POST['submit'])) {
    include "dbc.inc.php";

    $keyword = mysqli_real_escape_string($conn, $_POST["keyword"]);
    $url = mysqli_real_escape_string($conn, $_POST["url"]);
    $parent_id = mysqli_real_escape_string($conn, $_POST["parent_id"]);

    //check if keyword is not empty
    if (empty($keyword)) {
        header("Location: ../admin.php?tab=header&msg=1");
        exit();
    }

    //check if parent id is int
    if (!empty($parent_id) and !is_int($parent_id)) {
        header("Location: ../admin.php?tab=header&msg=2");
        exit();
    }

    //check if keyword is unique
    $sql = "SELECT * FROM header_links WHERE keyword = '$keyword'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        header("Location: ../admin.php?tab=header&msg=3");
        exit();
    }

    $sql = "INSERT INTO header_links (url, keyword, `level`) VALUES ('$url', '$keyword', 0)";
    if (!empty($parent_id))
        $sql = "INSERT INTO header_links (parent_id, url, keyword, `level`) VALUES ($parent_id, '$url', '$keyword', 0)";

    if (mysqli_query($conn, $sql)) {
        //get the id of the link
        $sql = "SELECT id FROM header_links WHERE keyword = '$keyword'";
        $result = mysqli_query($conn, $sql);
        $id = mysqli_fetch_assoc($result)['id'];

        include "languages.inc.php";
        foreach ($languages as $language) { //insert into header_content corresponding name and description
            $lang = $language['keyword'];
            $lang_key = $language['id'];
            $name = mysqli_real_escape_string($conn, $_POST['name_'.$lang]);
            $desc = mysqli_real_escape_string($conn, $_POST['description_'.$lang]);

            echo $name." ".$desc;
            $sql = "INSERT INTO header_content (group_id, `name`, description, lang_key) VALUES ($id, '$name', '$desc', $lang_key)";
            echo $sql;
            mysqli_query($conn, $sql);
        }

        if (!empty($parent_id)) {
            $sql = "UPDATE header_links SET is_parent = 1 WHERE id = $parent_id";
            mysqli_query($conn, $sql);

            $sql = "SELECT `level` FROM header_links WHERE id = $parent_id";
            $result = mysqli_query($conn, $sql);
            $level = mysqli_fetch_assoc($result)['level']++;

            $sql = "UPDATE header_links SET `level` = $level WHERE id = $id";
            mysqli_query($conn, $sql);
        }

        header("Location: ../admin.php?tab=header&msg=s");
        exit();
    }

    header("Location: ../admin.php?tab=header&msg=4");
    exit();

} else {
    header("Location: ../admin.php?tab=header");
    exit();
}
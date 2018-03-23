<?php
session_start();

if(isset($_POST['submit'])) {
    include 'dbc.inc.php';

    include "languages.inc.php";
    $isChange = mysqli_real_escape_string($conn, $_POST["change"]);

    $empty = 1;
    foreach ($languages as $language) {
        $suffix = $language['keyword'];
        $genpage_name = mysqli_real_escape_string($conn, $_POST["genpage_name_$suffix"]);
        $genpage_intro = mysqli_real_escape_string($conn, $_POST["genpage_intro_$suffix"]);

        if (!empty($genpage_name) && !empty($genpage_intro))
            $empty = 0;
    }

    if ($empty == 1) {
        header("Location: ../admin.php?tab=generic&message=error1");
        exit();
    }

    if ($isChange == "true") {
        $keyword = mysqli_real_escape_string($conn, $_POST["key"]);
        $sql = "DELETE FROM generic_page_content WHERE keyword = $keyword";
        $result = mysqli_query($conn, $sql);
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
                    mysqli_query($conn, $sql);
                }
            }
        }

        // adding images
        $target_dir = "../images/generic_images/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            echo "only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            $temp = explode(".", $_FILES["fileToUpload"]["name"]);
            $newfilename = $id . '.' . end($temp);
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "../images/tour_images/" . $newfilename)) {
                echo "The file " . $newfilename . " has been uploaded."."</br>";
                $url = 'images/generic_images/' . $newfilename;
                $sql = "UPDATE generic_page_content SET image_url = '$url' WHERE group_id = $id";
                mysqli_query($conn, $sql);
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

        //  /adding an image
//
//        header("Location: ../admin.php?tab=generic&message=success");
//        exit();
    }
}
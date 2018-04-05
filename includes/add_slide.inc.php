<?php
session_start();

if(isset($_POST['submit'])) {
    include 'dbc.inc.php';

    include "languages.inc.php";

    foreach ($languages as $language) {
        $suffix = $language['keyword'];
        $slide_intro = mysqli_real_escape_string($conn, $_POST["slide_intro_$suffix"]);
        $slide_description = mysqli_real_escape_string($conn, $_POST["slide_description_$suffix"]);
    }

    if ($conn) {
        $change = mysqli_real_escape_string($conn, $_POST['is_change']);
        if ($change == "false") {
            $keyword = mysqli_real_escape_string($conn, $_POST['slide_keyword']);
            $tour_url = mysqli_real_escape_string($conn, $_POST['slide_tour_url']);

            $sql = "INSERT INTO slide (image_url, tour_url, keyword) VALUES ('', '$tour_url', '$keyword')";
            mysqli_query($conn, $sql);
            $sql = "SELECT id FROM slide ORDER BY id DESC";
            $result = mysqli_query($conn, $sql);
            $id = mysqli_fetch_assoc($result)['id'];
            //insert for one language
            //go over, insert all other used languages

            foreach ($languages as $language) {
                $suffix = $language['keyword'];
                $slide_intro = mysqli_real_escape_string($conn, $_POST["slide_intro_$suffix"]);
                $slide_description = mysqli_real_escape_string($conn, $_POST["slide_description_$suffix"]);

                $sql = "INSERT INTO slide_content (slide_id, intro, description, lang_key) 
                                           VALUES ($id, '$slide_intro', '$slide_description', '$suffix')";
                mysqli_query($conn, $sql);
            }

            // adding images
            $target_dir = "../images/slide_images/";
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
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "../images/slide_images/" . $newfilename)) {
                    echo "The file " . $newfilename . " has been uploaded." . "</br>";
                    $url = 'images/slide_images/' . $newfilename;
                    $sql = "UPDATE slide SET image_url = '$url' WHERE id = $id";
                    mysqli_query($conn, $sql);
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }

            //  /adding an image

            header("Location: ../admin.php?tab=slide&message=success");
            exit();

        } else { //is change
            $og_keyword = mysqli_real_escape_string($conn, $_POST['original']);
            $keyword = mysqli_real_escape_string($conn, $_POST['slide_keyword']);
            $tour_url = mysqli_real_escape_string($conn, $_POST['slide_tour_url']);

            $sql = "UPDATE slide SET keyword = $keyword, tour_url = '$tour_url' WHERE keyword = '$og_keyword'";
            mysqli_query($conn, $sql);
            $sql = "SELECT id FROM slide WHERE keyword = '$keyword'";
            $result = mysqli_query($conn, $sql);
            $id = mysqli_fetch_assoc($result)['id'];
            //insert for one language
            //go over, insert all other used languages

            foreach ($languages as $language) {
                $suffix = $language['keyword'];
                $slide_title = mysqli_real_escape_string($conn, $_POST["slide_title_$suffix"]);
                $slide_intro = mysqli_real_escape_string($conn, $_POST["slide_intro_$suffix"]);
                $slide_description = mysqli_real_escape_string($conn, $_POST["slide_description_$suffix"]);

                $sql = "UPDATE slide_content SET intro = '$slide_intro', description = '$slide_description'
                                    WHERE lang_key = '$suffix' AND slide_id = $id";
                mysqli_query($conn, $sql);
            }


            // adding images
            $target_dir = "../images/slide_images/";
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
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "../images/slide_images/" . $newfilename)) {
                    echo "The file " . $newfilename . " has been uploaded." . "</br>";
                    $url = 'images/slide_images/' . $newfilename;
                    $sql = "UPDATE slide SET image_url = '$url' WHERE id = $id";
                    mysqli_query($conn, $sql);
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }

            //  /adding an image
//
            header("Location: ../admin.php?tab=slide&message=success");
            exit();
        }
    }
}
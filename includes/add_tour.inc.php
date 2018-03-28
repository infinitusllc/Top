<?php
session_start();

if(isset($_POST['submit'])) {
    include 'dbc.inc.php';

    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $currency = mysqli_real_escape_string($conn, $_POST['currency']);
    $q_adult = mysqli_real_escape_string($conn, $_POST['q_adult']);
    $q_kid = mysqli_real_escape_string($conn, $_POST['q_kid']);
    $q_small = mysqli_real_escape_string($conn, $_POST['q_small']);
    $food_option = mysqli_real_escape_string($conn, $_POST['food_option']);
    $hotel_stars = mysqli_real_escape_string($conn, $_POST['hotel_stars']);
    $type = mysqli_real_escape_string($conn, $_POST['type']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);

    if(empty($price)) $price = 0;
    if(empty($q_adult)) $q_adult = 0;
    if(empty($q_kid)) $q_kid = 0;
    if(empty($q_small)) $q_small = 0;
    if(empty($hotel_stars)) $hotel_stars = 0;

    include "languages.inc.php";

    $empty = 1;
    foreach ($languages as $language) {
        $suffix = $language['keyword'];
        $tour_name = mysqli_real_escape_string($conn, $_POST["tour_name_$suffix"]);
        $tour_description = mysqli_real_escape_string($conn, $_POST["tour_intro_$suffix"]);

        if (!empty($tour_name) && !empty($tour_description))
            $empty = 0;
    }

    if ($empty == 1) {
        header("Location: ../admin.php?message=error1");
        exit();
    }

    //error handlers
    if ($conn) {
        date_default_timezone_set('Europe/Samara');

        $time = date('c');
        $sql1 = "INSERT INTO tours (country, category, type, price, currency, quantity_adult, quantity_child, quantity_small, food_options,
                                      hotel_stars, created_time)
                            VALUES ($country, $category, $type, $price, $currency, $q_adult, $q_kid, $q_small, $food_option, $hotel_stars, '$time')";

        if(isset($_POST['rec']) && $_POST['rec'] == 'true') {
            $sql1 = "INSERT INTO tours (country, category, type, price, currency, quantity_adult, quantity_child, quantity_small, food_options,
                                      hotel_stars, created_time, is_recommended)
                            VALUES ($country, $category, $type, $price, $currency, $q_adult, $q_kid, $q_small, $food_option, $hotel_stars, '$time', 1)";
        }

        if (mysqli_query($conn, $sql1)) {

            $sql2 = "SELECT tour_id FROM tours WHERE created_time = '$time'";
            echo $sql2."</br>";
            $result2 = mysqli_query($conn, $sql2);
            $resultCheck = mysqli_num_rows($result2);
            $id = 0;
            if ($resultCheck == 1) {
                $id = mysqli_fetch_assoc($result2)['tour_id'];
                foreach ($languages as $language) {
                    $suffix = $language['keyword'];
                    $tour_name = mysqli_real_escape_string($conn, $_POST["tour_name_$suffix"]);
                    $tour_description = mysqli_real_escape_string($conn, $_POST["tour_description_$suffix"]);
                    $hotel_name = mysqli_real_escape_string($conn, $_POST["hotel_name_$suffix"]);
                    $tour_intro = mysqli_real_escape_string($conn, $_POST["tour_intro_$suffix"]);
                    $cities = mysqli_real_escape_string($conn, $_POST["cities_$suffix"]);

                    if (!empty($tour_name) || !empty($tour_description)) {
                        $sql3 = "INSERT INTO tour_content (tour_id, tour_name, tour_description, tour_cities, hotel_name, language_key, tour_intro) VALUES 
                                                  ($id, '$tour_name', '$tour_description', '$cities', '$hotel_name', '$suffix', '$tour_intro')";
                        $result3 = mysqli_query($conn, $sql3);
                    }
                }
            }

            // adding images
            for ($j=0; $j<5; $j++) {
                $target_dir = "../images/tour_images/";
                $target_file = $target_dir . basename($_FILES["fileToUpload".$j]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                // Check if image file is a actual image or fake image
                if (isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["fileToUpload".$j]["tmp_name"]);
                    if ($check !== false) {
                        echo "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else {
                        echo "File is not an image.";
                        $uploadOk = 0;
                    }
                }
                // Check file size
                if ($_FILES["fileToUpload".$j]["size"] > 500000) {
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
                    $temp = explode(".", $_FILES["fileToUpload"."$j"]["name"]);
                    $newfilename = $id . $j . '.' . end($temp);
                    if (move_uploaded_file($_FILES["fileToUpload"."$j"]["tmp_name"], "../images/tour_images/" . $newfilename)) {
                        echo "The file " . $newfilename . " has been uploaded."."</br>";
                        $url = 'images/tour_images/' . $newfilename;
                        $sql = "INSERT INTO tour_images (tour_id, image_url) VALUES ($id, '$url')";
                        echo $sql."</br>";
                        $result = mysqli_query($conn, $sql);
                        if ($j == 0) {
                            $sql = "UPDATE tour_images SET is_main = 1";
                            $result = mysqli_query($conn, $sql);
                        }
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
            }
            //  /adding an image

            header("Location: ../admin.php?message=success");
            exit();
        }
    }

    header("Location: ../admin.php?message=შეცდომა");
    exit();

}
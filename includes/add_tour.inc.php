<?php
session_start();

if(isset($_POST['submit'])) {
    include 'dbc.inc.php';

    $tour_name = mysqli_real_escape_string($conn, $_POST['tour_name']);
    $cities = mysqli_real_escape_string($conn, $_POST['cities']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $currency = mysqli_real_escape_string($conn, $_POST['currency']);
    $q_adult = mysqli_real_escape_string($conn, $_POST['q_adult']);
    $q_kid = mysqli_real_escape_string($conn, $_POST['q_kid']);
    $q_small = mysqli_real_escape_string($conn, $_POST['q_small']);
    $food_option = mysqli_real_escape_string($conn, $_POST['food_option']);
    $hotel_name = mysqli_real_escape_string($conn, $_POST['hotel_name']);
    $hotel_stars = mysqli_real_escape_string($conn, $_POST['hotel_stars']);
    $tour_description = mysqli_real_escape_string($conn, $_POST['tour_description']);
    $type = mysqli_real_escape_string($conn, $_POST['type']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $lang = mysqli_real_escape_string($conn, $_POST['lang']);

    //error handlers
    if (empty($tour_name) || empty($price)) {
        header("Location: ../addTour.php?message=error1");
        exit();
    }  else if ($conn) {
        $time = date('c');
        $sql1 = "INSERT INTO tours (country, category, type, price, currency, quantity_adult, quantity_child, quantity_small, food_options,
                                      hotel_stars, created_time)
                            VALUES ($country, $category, $type, $price, $currency, $q_adult, $q_kid, $q_small, $food_option, $hotel_stars, '$time')";
        echo $sql1;
        echo "</br>";

        if (mysqli_query($conn, $sql1)) {
            $sql2 = "SELECT tour_id FROM tours WHERE created_time = '$time'";
            $result2 = mysqli_query($conn, $sql2);
            $resultCheck = mysqli_num_rows($result2);

            if ($resultCheck == 1) {
                $id = mysqli_fetch_assoc($result2)['tour_id'];
                echo $id;
                $sql3 = "INSERT INTO tour_content (tour_id, tour_name, tour_description, tour_cities, hotel_name, language_key) VALUES 
                                                  ($id, '$tour_name', '$tour_description', '$cities', '$hotel_name', '$lang')";
               if (mysqli_query($conn, $sql3)) {
                   header("Location: ../addTour.php?message=success");
                   exit();
               }
            }

            exit();
        }
    }

}
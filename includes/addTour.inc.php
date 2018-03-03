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

    echo $tour_name."\n";
    echo $cities."\n";
    echo $country."\n";
    echo $price."\n";
    echo $currency."\n";
    echo $q_adult."\n";
    echo $q_kid."\n";
    echo $q_small."\n";
    echo $food_option."\n";
    echo $hotel_name."\n";
    echo $hotel_stars."\n";
    echo $tour_description."\n";

    //error handlers
    if (empty($tour_name) || empty($price)) {
        header("Location: ../addTour.php?message=error1");
        exit();
    }  else if ($conn) {
        $sql = "INSERT INTO tours (country, category) VALUES ()";
    }

}
<?php

    include "dbc.inc.php";

    echo 2;

    $user_id = mysqli_real_escape_string($conn, $_POST['user-id']);
    $tour_id = mysqli_real_escape_string($conn, $_POST['tour-id']);

    echo $user_id." ".$tour_id;

    if (!empty($user_id) and !empty($tour_id)) {
        $sql = "SELECT * FROM favorites WHERE tour_id = $tour_id AND user_id = $user_id";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $sql = "DELETE FROM favorites WHERE tour_id = $tour_id AND user_id = $user_id";
            if( mysqli_query($conn, $sql)) {
                header("Location: ../tour_page.php?id=$tour_id&m=unfavorited");
                exit();
            }
        } else {
            $sql = "INSERT INTO favorites (user_id, tour_id) VALUES ($user_id, $tour_id)";
            if( mysqli_query($conn, $sql)) {
                header("Location: ../tour_page.php?id=$tour_id&m=favorited");
                exit();
            }
        }

    } else {
        header("Location: ../tour_page.php?id=$tour_id&m=error");
        exit();
    }
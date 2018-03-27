<?php

/**
 * @param $tour_id
 * @return array [id, tour_id, user_id, subject, comment, time, is_deleted_by_mod, deleted_time, is_admin, first_name, last_name]
 */
function getCommentsByTour($tour_id) {
    include "dbc.inc.php";

    $sql = "SELECT * FROM comments INNER JOIN users on users.user_id = comments.user_id WHERE tour_id = $tour_id AND is_deleted_by_mod = 0";
    $result = mysqli_query($conn, $sql);

    $comments = [];
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($comments, $row);
    }
    return $comments;
}

function getReviews() {
    include "dbc.inc.php";

    $sql = "SELECT * FROM reviews WHERE is_deleted = 0";
    $result = mysqli_query($conn, $sql);

    $reviews = [];
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($reviews, $row);
    }

    return $reviews;
}
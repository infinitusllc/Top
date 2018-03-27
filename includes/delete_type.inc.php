<?php
session_start();

if (isset($_SESSION['user']) and $_SESSION['logged'] == true and $_SESSION['user']['is_admin'] == 1) {
    if (isset($_GET['id'])) {
        include 'dbc.inc.php';

        $group_id = $_GET['id'];
        $sql = "DELETE FROM tour_types WHERE group_id = $group_id";

        if (mysqli_query($conn, $sql)) {
            mysqli_query($conn, "DELETE FROM category_to_type WHERE group_id = $group_id");
            header("Location: ../admin.php?tab=combinations&option=types&message=success");
            exit();
        } else {
            header("Location: ../admin.php?tab=combinations&option=types&message=error");
            exit();
        }
    }
} else {
    header("Location: ../admin.php?tab=combinations&option=types&message=notLogged");
    exit();
}
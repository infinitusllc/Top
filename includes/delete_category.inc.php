<?php
session_start();

if (isset($_SESSION['user']) and $_SESSION['logged'] == true and $_SESSION['user']['is_admin'] == 1) {
    if (isset($_GET['id'])) {
        include 'dbc.inc.php';

        $group_id = $_GET['id'];
        $sql = "DELETE FROM tour_categories WHERE group_id = $group_id";

        if (mysqli_query($conn, $sql)) {
            header("Location: ../admin.php?tab=combinations&option=categories&message=success");
            exit();
        } else {
            header("Location: ../admin.php?tab=combinations&option=categories&message=error");
            exit();
        }
    }
} else {
    header("Location: ../admin.php?tab=combinations&option=categories&message=notLogged");
    exit();
}
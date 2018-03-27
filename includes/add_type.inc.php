<?php
session_start();

if(isset($_POST['submit'])) {
    include 'dbc.inc.php';

    include "languages.inc.php";

    $group_id = mysqli_real_escape_string($conn, $_POST['group_id']);

    if (isset($group_id) and !empty($group_id)) {
        for ($i = 1; $i <= sizeof($languages); $i++) {
            $value = mysqli_real_escape_string($conn, $_POST["value_$i"]);
            $sql = "UPDATE tour_types SET tour_type = '$value' WHERE language_key = $i AND group_id = $group_id";
            if (!mysqli_query($conn, $sql)) {
                header("Location: ../admin.php?tab=combinations&option=types&message=error");
                exit();
            }
        }
        header("Location: ../admin.php?tab=combinations&option=types&message=success");
        exit();
    } else {
        $group_id = -1;
        for ($i = 1; $i <= sizeof($languages); $i++) {
            $value = mysqli_real_escape_string($conn, $_POST["value_$i"]);
            $sql = "INSERT INTO tour_types (tour_type, language_key, group_id) VALUES ('$value', $i, $group_id)";

            if (!mysqli_query($conn, $sql)) {
                header("Location: ../admin.php?tab=combinations&option=types&message=error");
                exit();
            }

            if ($i == 1) {
                $sql = "SELECT id FROM tour_types ORDER BY id DESC";
                $result = mysqli_query($conn, $sql);
                $group_id = mysqli_fetch_assoc($result)['id'];
                $sql = "UPDATE tour_types SET group_id = $group_id WHERE id = $group_id";
                if (!mysqli_query($conn, $sql)) {
                    header("Location: ../admin.php?tab=combinations&option=types&message=error");
                    exit();
                }
            }
        }

        header("Location: ../admin.php?tab=combinations&option=types&message=success");
        exit();
    }
}
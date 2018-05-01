<?php

session_start();

if(isset($_POST['submit'])){

    include 'dbc.inc.php';

    if ($conn) {
        echo "conn";
    } else {
        echo "no conn";
    }

    echo "<br>";

    $uname = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);

    //Error handlers
    //check if empty
    if (!(empty($uname) || empty($pass))){
        $sql = "SELECT * FROM admins WHERE username ='$uname'";
        echo $sql;
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);

        if ($resultCheck < 1){
            header("Location: ../ind.php?message=error3");
            exit();
        } else {
            if ($row = mysqli_fetch_assoc($result)){
                //dehashing the password
                $hashedPassCheck = password_verify($pass, $row['password']);
                if($hashedPassCheck == false){
                    echo "bla";
                    exit();
                } else if ($hashedPassCheck == true) {
                    //Log in the admin here
                    $_SESSION['admin'] = true;
                    header("Location: ../index.php");
                    exit();
                }
            } else {
                echo "error 4";
//                header("Location: ../ind.php?message=error4");
//                exit();
            }
        }
    } else {
        echo "error 2";
//        header("Location: ../ind.php?message=error2");
//        exit();
    }
} else {
    echo "error 1";
//    header("Location: ../ind.php?message=error1");
//    exit();
}

?>
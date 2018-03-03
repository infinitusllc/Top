<?php

session_start();

if(isset($_POST['submit'])){

    include 'dbc.inc.php';

    $e_mail = mysqli_real_escape_string($conn, $_POST['e_mail']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);

    if (!(empty($e_mail) || empty($pass))){
        $sql = "SELECT * FROM users WHERE e_mail ='$e_mail'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);

        if ($resultCheck < 1){
            header("Location: ../index.php?message=error3");
            exit();
        } else {
            if ($row = mysqli_fetch_assoc($result)){
                //dehashing the password
                $hashedPassCheck = password_verify($pass, $row['password']);
                if($hashedPassCheck == false){
                    header("Location: ../index.php");
                    exit();
                } else if ($hashedPassCheck == true) {
                    //Log in the admin here
                    $_SESSION['logged'] = true;

                    $user = [];

                    $user['name'] = $row['first_name']." ".$row['last_name'];
                    $user['first_name'] = $row['first_name'];
                    $user['last_name'] = $row['last_name'];
                    $user['e_mail'] = $e_mail;
                    $user['is_company'] = $row['is_company'];
                    $user['is_admin'] = $row['is_admin'];
                    $user['gender'] = $row['gender'];
                    $user['bird_date'] = $row['birth_date'];
                    $user['mobile_number'] = $row['mobile_number'];
                    $user['company_number'] = $row['company_number'];
                    $user['country'] = $row['country'];
                    $user['address'] = $row['address'];
                    $user['address_legal'] = $row['address_legal'];
                    $user['company_name'] = $row['company_name'];
                    $user['company_id'] = $row['company_id'];
                    $user['id'] = $row['user_id'];

                    $_SESSION['user'] = $user;
                    header("Location: ../index.php");
                    exit();
                }
            }
        }
    }
} else {
    header("Location: ../index.php?message=error1");
    exit();
}

?>
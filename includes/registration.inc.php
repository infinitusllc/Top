<?php
session_start();

if(isset($_POST['submit'])) {
    include 'dbc.inc.php';

    $type = $_POST['submit'];

    if ($type == "client") {
        $first_name = mysqli_real_escape_string($conn, $_POST['first_name_client']);
        $last_name = mysqli_real_escape_string($conn, $_POST['last_name_client']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender_client']);
        $birth_date = mysqli_real_escape_string($conn, $_POST['date_of_birth_client']);
        $phone_number = mysqli_real_escape_string($conn, $_POST['mobile_number_client']);
        $e_mail = mysqli_real_escape_string($conn, $_POST['e_mail_client']);
        $country = mysqli_real_escape_string($conn, $_POST['country_client']);
        $address = mysqli_real_escape_string($conn, $_POST['address_client']);
        $password = mysqli_real_escape_string($conn, $_POST['password_client']);
        $password2 = mysqli_real_escape_string($conn, $_POST['password2_client']);

        if (empty($first_name) || empty($last_name) || empty($e_mail) || empty($password) || empty($password2)) {
            //redirect back with error message - fill all mandatory fields
            header("Location: ../registration.php?message=error1");
            exit();
        } else if ($password != $password2) {
            //redirect back, passwords don't match
            header("Location: ../registration.php?message=error2");
            exit();
        } else if (strlen($password) < 3) {
            //redirect back, password must be at least 6 chars long
            header("Location: ../registration.php?message=error3");
            exit();
        } else 	if ($conn) {

            $sql_users = "SELECT * FROM users WHERE e_mail = '$e_mail'";
            $result_admin = mysqli_query($conn, $sql_users);
            $resultCheck = mysqli_num_rows($result_admin);

            if ($resultCheck > 0) {
                //send back, user with such e-mail already exists
                header("Location: ../registration.php?message=error4");
                exit();
            } else {
                //register user
                $password_hash = password_hash($password, PASSWORD_DEFAULT);

                $sql = "INSERT INTO users (is_company, is_admin, first_name, last_name, gender, birth_date, mobile_number, e_mail, country, address, password)
                                       values (0, 0, '$first_name', '$last_name', $gender, '$birth_date', '$phone_number', '$e_mail', '$country', '$address', '$password_hash')";
                if (mysqli_query($conn, $sql)) {
                    header("Location: ../index.php");
                    exit();
                } else {
                    //unforseen error
                    header("Location: ../registration.php?message=error5");
                    exit();
                }
            }
        }
    } else {  // if it's a company
        $first_name = mysqli_real_escape_string($conn, $_POST['first_name_company']);
        $last_name = mysqli_real_escape_string($conn, $_POST['last_name_company']);
        $company_name = mysqli_real_escape_string($conn, $_POST['company_name']);
        $company_id = mysqli_real_escape_string($conn, $_POST['company_id']);
        $legal_address = mysqli_real_escape_string($conn, $_POST['legal_address_company']);
        $mobile_number = mysqli_real_escape_string($conn, $_POST['mobile_number_company']);
        $company_number = mysqli_real_escape_string($conn, $_POST['phone_number_company']);
        $e_mail = mysqli_real_escape_string($conn, $_POST['e_mail_company']);
        $country = mysqli_real_escape_string($conn, $_POST['country_company']);
        $address = mysqli_real_escape_string($conn, $_POST['address_company']);
        $password = mysqli_real_escape_string($conn, $_POST['password_company']);
        $password2 = mysqli_real_escape_string($conn, $_POST['password2_company']);

        if (empty($first_name) || empty($last_name) || empty($e_mail) || empty($password) || empty($password2) || empty($legal_address)
            || empty($company_name) || empty($company_id)) {
            //redirect back with error message - fill all mandatory fields
            header("Location: ../registration.php?message=error1");
            exit();
        } else if ($password != $password2) {
            //redirect back, passwords don't match
            header("Location: ../registration.php?message=error2");
            exit();
        } else if (strlen($password) < 3) {
            //redirect back, password must be at least 6 chars long
            header("Location: ../registration.php?message=error3");
            exit();
        } else 	if ($conn) {

            $sql_users = "SELECT * FROM users WHERE e_mail = '$e_mail'";
            $result_admin = mysqli_query($conn, $sql_users);
            $resultCheck = mysqli_num_rows($result_admin);

            if ($resultCheck > 0) {
                //send back, user with such e-mail already exists
                header("Location: ../registration.php?message=error4");
                exit();
            } else {
                //register user
                $password_hash = password_hash($password, PASSWORD_DEFAULT);

                $sql = "INSERT INTO users (is_company, is_admin, first_name, last_name, mobile_number, e_mail, country, address, password, address_legal, company_name, company_id, company_number)
                                       values (1, 0, '$first_name', '$last_name', '$mobile_number', '$e_mail', '$country', '$address', '$password_hash', '$legal_address', '$company_name', '$company_id', '$company_number')";
                if (mysqli_query($conn, $sql)) {
                    header("Location: ../index.php");
                    exit();
                } else {
                    //unforseen error
                    header("Location: ../registration.php?message=error5");
                    exit();
                }
            }
        }
    }
} else {
    header("Location: ../registration.php?message=error0");
    exit();
}
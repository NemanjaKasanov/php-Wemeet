<?php
session_start();

if(isset($_POST['submit_login'])){
    include "../../config/connection.php";

    $_SESSION['errors'] = [];
    $errors = [];

    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $regexEmail = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
    $regexPass = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/";

    if(!preg_match($regexEmail, $email)) array_push($errors, "Invalid email format.");
    if(!preg_match($regexPass, $pass)) array_push($errors, "Password must include at least one lower case letter, one capital letter and at least one number.");

    $pass = md5($pass);
    $user = executeQuery("SELECT * FROM users WHERE email='$email' AND password='$pass'");

    if(count($user) != 1) array_push($errors, "USER WITH THIS EMAIL NOT FOUND. PASSWORD MAY BE WRONG.");

    if(count($errors) == 0){
        if(count($user) == 1){
            $id = $user[0]->id;
            $role = $user[0]->role;
            $sessionEmail = $user[0]->email;
            $sessionName = $user[0]->name;
            $sessionLName = $user[0]->last_name;

            $_SESSION['userId'] = $id;
            $_SESSION['userRole'] = $role;
            $_SESSION['userEmail'] = $sessionEmail;
            $_SESSION['userName'] = $sessionName;
            $_SESSION['userLName'] = $sessionLName;

            header("Location: ../../index.php");
        }
    }
    else{
        $_SESSION['errors'] = $errors;
        header("Location: ../../index.php?page=login");
    }
}
<?php 
session_start();

if(isset($_POST['submit_register'])){
    require_once '../../config/connection.php';

    $_SESSION['errors'] = [];
    $errors = [];

    $name = $_POST['name'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $rpass = $_POST['rpass'];
    $country = $_POST['country'];
    $city = $_POST['city'];

    $regexName = "/^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/";
    $regexEmail = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
    $regexPass = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/";
    $email_exists = count(executeQuery("SELECT * FROM users WHERE email='$email'"));

    if(!preg_match($regexName, $name)) array_push($errors, "Invalid name format.");
    if(!preg_match($regexName, $lname)) array_push($errors, "Invalid last name format.");
    if(!preg_match($regexEmail, $email)) array_push($errors, "Invalid email format.");
    if($email_exists >= 1) array_push($errors, "There already is an account registered using this email address.");
    if(!preg_match($regexPass, $pass)) array_push($errors, "Password must include at least one lower case letter, one capital letter and at least one number.");
    if($pass != $rpass) array_push($errors, "Passwords do not match.");
    if($country == 0) array_push($errors, "A country must be selected.");
    if(!preg_match($regexName, $city)) array_push($errors, "City name not in a valid format.");

    if(count($errors) == 0){
        $pass = md5($pass);

        $insert = $connection->prepare("INSERT INTO users (name, last_name, email, password, role, country, city) VALUES (:name, :lname, :email, :pass, 0, :country, :city)");
        $insert->bindParam(':name', $name, PDO::PARAM_STR, 30);
        $insert->bindParam(':lname', $lname, PDO::PARAM_STR, 30);
        $insert->bindParam(':email', $email, PDO::PARAM_STR, 50);
        $insert->bindParam(':pass', $pass, PDO::PARAM_STR, 300);
        $insert->bindParam(':country', $country, PDO::PARAM_INT);
        $insert->bindParam(':city', $city, PDO::PARAM_STR, 50);
        $insert->execute();
        
        header("Location: ../../index.php?page=login");
    }
    else{
        $_SESSION['errors'] = $errors;
        header("Location: ../../index.php?page=register");
    }
}
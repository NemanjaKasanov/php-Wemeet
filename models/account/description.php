<?php
session_start();

if(isset($_POST['submit_desc'])){
    require_once '../../config/connection.php';

    $id = $_SESSION['userId'];
    $desc = $_POST['desc'];

    $_SESSION['errors'] = [];
    $errors = [];

    $regex = "/^[a-zA-Z0-9.,'-_:;?! ]{1,150}$/";

    if(!preg_match($regex, $desc)) array_push($errors, "Entered content is in an invalid format or using forbidden characters.");

    var_dump($errors, $desc);

    if(count($errors) == 0){
        $insert = $connection->prepare("UPDATE users SET description=:desc WHERE id=$id");
        $insert->bindParam(':desc', $desc, PDO::PARAM_STR, 150);
        $insert->execute();

        header("Location: ../../index.php?page=account");
    }
    else{
        $_SESSION['errors'] = $errors;
        header("Location: ../../index.php?page=account");
    }
}
<?php

if(isset($_POST['submit_post'])){
    session_start();
    require_once '../../config/connection.php';

    $title = $_POST['title'];
    $category = $_POST['category'];
    $content = $_POST['content'];
    $timestamp = time();
    $user_id = $_SESSION['userId'];

    $_SESSION['errors'] = [];
    $errors = [];

    $regexTitle = "/^[a-zA-Z0-9.,'-_:;?! ]{1,70}$/";
    $regexContent = "/^[a-zA-Z0-9.,'-_:;?! ]{1,500}$/";

    if(!preg_match($regexTitle, $title)) array_push($errors, "Invalid title format, you may be using forbidden characters or your title is longer than 70 characters.");
    if(!preg_match($regexContent, $content)) array_push($errors, "Invalid content format, you may be using forbidden characters or your title is longer than 500 characters.");
    if($category == 0) array_push($errors, "A category must be selected.");

    if(count($errors) == 0){
        $insert = $connection->prepare("INSERT INTO discussion (user_id, category, name, content, timestamp) VALUES (:user_id, :category, :title, :content, :timestamp)");
        $insert->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $insert->bindParam(':title', $title, PDO::PARAM_STR, 70);
        $insert->bindParam(':category', $category, PDO::PARAM_INT);
        $insert->bindParam(':content', $content, PDO::PARAM_STR, 500);
        $insert->bindParam(':timestamp', $timestamp, PDO::PARAM_STR, 12);
        $insert->execute();

        header("Location: ../../index.php");
    }
    else{
        $_SESSION['errors'] = $errors;
        header("Location: ../../index.php");
    }
}
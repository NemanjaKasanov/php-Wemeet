<?php

session_start();
require_once "../../config/connection.php";

$user = $_POST['user'];
$discussion = $_POST['discussion'];

//$is_liked = executeQuery("SELECT * FROM users AS u INNER JOIN likes AS l WHERE u.id=".$_SESSION['userId']." AND discussion=".$discussion);
$is_liked = executeQuery("SELECT * FROM likes WHERE user=".$_SESSION['userId']." AND discussion=".$discussion);
if(count($is_liked) == 0){
    $insert = $connection->prepare("INSERT INTO likes (discussion, user) VALUES (:discussion, :user)");
    $insert->bindParam(':discussion', $discussion, PDO::PARAM_INT);
    $insert->bindParam(':user', $user, PDO::PARAM_INT);
    $insert->execute();
}

$json = json_encode([
    "data" => 1
]);
echo $json;

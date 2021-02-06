<?php

session_start();
require_once "../../config/connection.php";

$sender = $_POST['sender'];
$receiver = $_POST['receiver'];
$timestamp = time();
$return = 0;

if(is_numeric($sender) && is_numeric($receiver)){
    $check1 = executeQuery("SELECT * FROM friend_requests WHERE sender=$sender AND receiver=$receiver");
    $check2 = executeQuery("SELECT * FROM friend_requests WHERE sender=$receiver AND receiver=$sender");

    if(count($check1) == 0 && count($check2) == 0) {
        $query = $connection->prepare("INSERT INTO friend_requests (sender, receiver, timestamp) VALUES (:sender, :receiver, $timestamp)");
        $query->bindParam(':sender', $sender, PDO::PARAM_INT);
        $query->bindParam(':receiver', $receiver, PDO::PARAM_INT);
        $query->execute();

        $return = 0;
    }
    else{
        $return = 1;
    }
}

echo $json = json_encode($return);

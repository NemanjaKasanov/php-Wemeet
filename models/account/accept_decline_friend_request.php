<?php

include_once '../../models/functions.php';
include_once '../../config/connection.php';

$sender = $_POST['sender_id'];
$receiver = $_POST['receiver_id'];

if(isset($_POST['accept']) || isset($_POST['decline'])){
    $check = executeQuery("SELECT * FROM friend_requests WHERE sender=$sender AND receiver=$receiver");
    if(count($check)){
        if(isset($_POST['accept'])){
            $query = "INSERT INTO friendships (first, second) VALUES ($sender, $receiver)";
            $connection->query($query);

            remove_request($sender, $receiver);
            header("Location: ../../index.php?page=user&id=$sender");
        }
        if(isset($_POST['decline'])){
            remove_request($sender, $receiver);
            header("Location: ../../index.php");
        }
    }
}
else{
    header("Location: ../../index.php");
}

function remove_request($sender, $receiver){
    global $connection;
    $query = "DELETE FROM friend_requests WHERE sender=$sender AND receiver=$receiver";
    $connection->query($query);
}
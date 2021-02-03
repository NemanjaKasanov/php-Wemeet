<?php

require_once "../../config/connection.php";
require_once "functions.php";

if(isset($_POST['value'])){
    $value = strtolower($_POST['value']);

    if($value == "") $discussions = executeQuery("SELECT * FROM discussion");
    else{
        $discussions = executeQuery("SELECT * FROM discussion WHERE LOWER(name) LIKE '%$value%' ORDER BY timestamp DESC");
    }

    $categories = executeQuery("SELECT * FROM category");
    $users = executeQuery("SELECT id, name, last_name FROM users");

    $json = json_encode([
        "discussions" => $discussions,
        "categories" => $categories,
        "users" => $users
    ]);
    echo $json;
}
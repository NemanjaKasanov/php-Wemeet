<?php

require_once "../../config/connection.php";

$id = $_POST['discussion'];

$count = executeQuery("SELECT count(id) AS cnt FROM likes WHERE discussion=".$id)[0]->cnt;

$json = json_encode([
    "count" => $count
]);
echo $json;

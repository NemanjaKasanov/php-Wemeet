<?php

require_once "config.php";

pageEntryDataIn();

try {
    $connection = new PDO("mysql:host=".SERVER.";dbname=".DATABASE.";charset=utf8", USERNAME, PASSWORD);
    $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $ex){
    echo $ex->getMessage();
}

function executeQuery($query){
    global $connection;
    return $connection->query($query)->fetchAll();
}

function pageEntryDataIn(){
    $open = fopen(LOG_FILE, "a");
    if($open){
        fwrite($open, "{$_SERVER['PHP_SELF']}\t".date('d.m.Y H:i:s')."\t{$_SERVER['REMOTE_ADDR']}\n");
        fclose($open);
    }
}
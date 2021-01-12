<?php

//INITIAL
define("BASE_URL", "http://localhost:8080/wemeet/");
define("ABSOLUTE_PATH", $_SERVER["DOCUMENT_ROOT"]."/wemeet");
define("ENV_FILE", ABSOLUTE_PATH."/config/.env");
define("LOG_FILE", ABSOLUTE_PATH."/data/log.txt");
define("SEPARTOR", "&");

//DATABASE
define("SERVER", env("SERVER"));
define("DATABASE", env("DBNAME"));
define("USERNAME", env("USERNAME"));
define("PASSWORD", env("PASSWORD"));

function env($name){
    $open = fopen(ENV_FILE, "r");
    $data = file(ENV_FILE);
    $send = "";

    foreach($data as $key=>$value){
        $config = explode("=", $value);
        if($config[0]==$name){
            $send = trim($config[1]);
        }
    }

    return $send;
}
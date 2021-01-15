<?php

session_start();
require_once "config/connection.php";

include "views/fixed/head.php";
include "views/fixed/nav.php";

if(!isset($_GET['page'])){
    include 'views/home/home_no_log_in.php';
}
else{
    include 'views/fixed/header.php';
    switch($_GET['page']){
        case 'register':
            include 'views/logging/register.php';
        break;
        case 'login':
            include 'views/logging/login.php';
        break;
    }
}

include "views/fixed/footer.php";
<?php

require_once "config/connection.php";

include "views/fixed/head.php";
include "views/fixed/nav.php";

if(!isset($_GET['page'])){
    include 'views/home/home_no_log_in.php';
}
else{
    switch($_GET['page']){
        case 'something':
            // include ...
        break;
    }
}

include "views/fixed/footer.php";
<?php

session_start();
require_once "config/connection.php";

include "views/fixed/head.php";
include "views/fixed/nav.php";

if(!isset($_GET['page'])){
    if(isset($_SESSION['userId'])) include 'views/home/home_logged_in.php';
    else include 'views/home/home_no_log_in.php';
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
        case 'post':
            include 'views/discussions/post.php';
            break;
        case 'discussion':
            include 'views/discussions/discussion.php';
            break;
        case 'account':
            include 'views/logging/account.php';
            break;
        case 'category':
            include 'views/discussions/category.php';
            break;
        case 'user':
            include 'views/other/user.php';
            break;

        case 'survey':
            include 'views/other/survey.php';
            break;
        case 'aboutAuthor':
            include 'views/other/aboutAuthor.php';
            break;
    }
}

include "views/fixed/footer.php";
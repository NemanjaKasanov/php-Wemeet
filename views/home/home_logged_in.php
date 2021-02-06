<?php
require_once 'config/connection.php';
require_once 'models/functions.php';
require_once 'models/discussions/functions.php';

$userData = getUserData($_SESSION['userId'])[0];
$userId = $userData->id;
$userName = $userData->name;
$userLname = $userData->last_name;
$userCountry = getUserCountry($userId);
$userCity = $userData->city;
?>

<!-- HEADER SECTION -->
<div class="slider_area slider_bg_1">
    <div class="slider_text">
        <div class="container">
            <div class="position_relv">
                <div class="row">
                    <div class="col-xl-8">
                        <div class="title_text title_text2 ">
                            <h3>Hello,<br/><?= $userName ?> <?= $userLname ?></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="countDOwn_area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-4 col-md-6 col-lg-4">
                    <div class="single_date">
                        <i class="ti-location-pin"></i>
                        <span><?= $userCity ?>, <?= $userCountry ?></span>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-lg-3">
                    <div class="single_date">
                        <i class="ti-alarm-clock"></i>
                        <span><?= date('d.m.Y') ?></span>
                    </div>
                </div>
                <div class="col-xl-5 col-md-12 col-lg-5">
                    <span id="clock"></span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- HEADER SECTION END -->

<section class="blog_area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mb-5 mb-lg-0">
                <div class="blog_left_sidebar" id="discussions_display_box">

                    <!-- POSTS -->
                    <?php
                    create_discussions();
                    ?>

                </div>
            </div>

            <!-- SIDE BAR -->
            <div class="col-lg-4">
                <div class="blog_right_sidebar">

                    <!-- FRIEND REQUESTS -->
                    <?php
                    include 'views/other/friend_requests_section.php';
                    ?>
                    <!-- FRIEND REQUESTS END -->

                    <!-- SEARCH -->
                    <?php
                    include 'views/discussions/search_section.php';
                    ?>
                    <!-- SEARCH END -->

                    <!-- CATEGORIES -->
                    <?php
                    include 'views/discussions/list_categories.php';
                    ?>
                    <!-- CATEGORIES END -->

                    <!-- TOP CATEGORIES -->
                    <?php
                    include 'views/discussions/top_categories.php';
                    ?>
                    <!-- TOP CATEGORIES END -->

                </div>
            </div>
            <!-- SIDE BAR END -->

        </div>
    </div>
</section>
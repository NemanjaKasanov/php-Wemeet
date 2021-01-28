<?php
require_once 'config/connection.php';
require_once 'models/functions.php';
require_once 'models/discussions/functions.php';

$userData = getuserData($_SESSION['userId'])[0];
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
                <div class="blog_left_sidebar">

                    <!-- POSTS -->
                    <?php

                    $per_page = 5;
                    $count = executeQuery("SELECT COUNT(id) AS cnt FROM discussion")[0]->cnt;
                    $pages = $count / $per_page;

                    $page = 1;
                    if(!isset($_GET['page_num'])) $page = 1;
                    else $page = $_GET['page_num'];

                    if(isset($_GET['page_num'])) {
                        if ($_GET['page_num'] < 1) $page = $pages;
                        if ($_GET['page_num'] > $pages) $page = 1;
                    }

                    $limit = ($page - 1) * $per_page;

                    $discussions = executeQuery("SELECT * FROM discussion ORDER BY timestamp DESC LIMIT ".$limit.", ".$per_page);

                    foreach($discussions as $el):
                        $timestamp = $el->timestamp;
                        $day = date("d", $timestamp);
                        $month = date("M", $timestamp);

                        $cat_id = $el->category;
                        $category = executeQuery("SELECT c.name FROM category AS c INNER JOIN discussion AS d ON c.id = d.category WHERE c.id =".$cat_id);
                        $category = $category[0]->name;

                        $user = executeQuery("SELECT * FROM users WHERE id = ".$el->user_id)[0];
                        $user_name = $user->name." ".$user->last_name;

//                        ADD COMMENTS COUNT FOR EACH DISCUSSION

                    ?>
                        <article class="blog_item">
                            <div class="blog_item_img">
                                <img class="card-img rounded-0" src="assets/img/blog/single_blog_1.png" alt="">
                                <a href="index.php?page=discussion&id=<?= $el->id ?>" class="blog_item_date">
                                    <h3><?= $day ?></h3>
                                    <p><?= $month ?></p>
                                </a>
                            </div>
                            <div class="blog_details">
                                <a class="d-inline-block" href="index.php?page=discussion&id=<?= $el->id ?>">
                                    <h2><?= $el->name ?></h2>
                                </a>
                                <p><?= $el->content ?></p>
                                <ul class="blog-info-link">
                                    <li><a href="index.php?page=discussion&id=<?= $el->id ?>"><i class="fa fa-user"> <?= $user_name ?></i></a></li>
                                    <li><a href="index.php?page=discussion&id=<?= $el->id ?>"><i class="fa fa-globe"> <?= $category ?></i></a></li>
                                    <li><a href="index.php?page=discussion&id=<?= $el->id ?>"><i class="fa fa-comments"> </i> 03 Comments</a></li>
                                </ul>
                            </div>
                        </article>
                    <?php endforeach; ?>
                    <!-- POSTS END -->

                    <?php
                    $next_page = $page + 1;
                    $last_page = $page - 1;
                    ?>
                    <!-- PAGINATION -->
                    <div class="blog-pagination justify-content-center d-flex">
                        <ul class="pagination">
                            <li class="page-item">
                                <a href="index.php?page_num=<?= $last_page ?>" class="page-link" aria-label="Previous">
                                    <i class="ti-angle-left"></i>
                                </a>
                            </li>
                            <li class="page-item">
                                <a href="index.php?page_num=<?= $page ?>" class="page-link active"><?= $page ?></a>
                            </li>
                            <li class="page-item">
                                <a href="index.php?page_num=<?= $next_page ?>" class="page-link" aria-label="Next">
                                    <i class="ti-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- PAGINATION END -->

                </div>
            </div>

            <!-- SIDE BAR -->
            <div class="col-lg-4">
                <div class="blog_right_sidebar">
                    <aside class="single_sidebar_widget search_widget">
                        <form action="#">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder='Search Keyword'
                                           onfocus="this.placeholder = ''"
                                           onblur="this.placeholder = 'Search Keyword'">
                                    <div class="input-group-append">
                                        <button class="btn" type="button"><i class="ti-search"></i></button>
                                    </div>
                                </div>
                            </div>
                            <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn" type="submit">Search</button>
                        </form>
                    </aside>

                    <!-- CATEGORIES -->
                    <aside class="single_sidebar_widget post_category_widget">
                        <h4 class="widget_title">Discussion Categories</h4>
                        <ul class="list cat-list">
                            <?php
                            $categories = executeQuery("SELECT * FROM category ORDER BY name ASC");
                            foreach($categories as $ctg):
                                $number_of_discussions = executeQuery("SELECT COUNT(category) AS num FROM discussion WHERE category=$ctg->id")[0]->num;
                            ?>
                                <li>
                                    <a href="#" class="d-flex">
                                        <p><?= $ctg->name ?></p>
                                        <p>(<?= $number_of_discussions ?>)</p>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </aside>
                    <!-- CATEGORIES END -->

                    <aside class="single_sidebar_widget tag_cloud_widget">
                        <h4 class="widget_title">Tag Clouds</h4>
                        <ul class="list">
                            <li>
                                <a href="#">project</a>
                            </li>
                            <li>
                                <a href="#">love</a>
                            </li>
                            <li>
                                <a href="#">technology</a>
                            </li>
                            <li>
                                <a href="#">travel</a>
                            </li>
                            <li>
                                <a href="#">restaurant</a>
                            </li>
                            <li>
                                <a href="#">life style</a>
                            </li>
                            <li>
                                <a href="#">design</a>
                            </li>
                            <li>
                                <a href="#">illustration</a>
                            </li>
                        </ul>
                    </aside>

                </div>
            </div>
            <!-- SIDE BAR END -->

        </div>
    </div>
</section>
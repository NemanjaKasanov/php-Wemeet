<?php
include 'models/functions.php';

$id = $_GET['id'];
$query = executeQuery("SELECT * FROM discussion WHERE id=$id")[0];

$title = $query->name;
$content = $query->content;
$category = getDiscussionCategory($id);

$user_id = $query->user_id;
$user_data = getUserData($user_id)[0];
$user_name = $user_data->name;
$user_last_name = $user_data->last_name;
$user_city = $user_data->city;
$user_country = getUserCountry($user_id);
$user_description = $user_data->description;


?>

<section class="blog_area single-post-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 posts-list">

                <div class="single-post">
                    <div class="feature-img">
                        <img class="img-fluid" src="assets/img/blog/single_blog_1.png" alt="<?= $title ?>">
                    </div>
                    <div class="blog_details">
                        <h2><?= $title ?></h2>
                        <ul class="blog-info-link mt-3 mb-4">
                            <li><a href="index.php?page=category"><i class="fa fa-globe"></i> <?= $category ?></a></li>
                            <li><a href="#"><i class="fa fa-comments"></i> 03 Comments</a></li>
                        </ul>
                        <p class="excert"><?= $content ?></p>
                    </div>
                </div>
                <div class="navigation-top">
                    <div class="d-sm-flex justify-content-between text-center">
                        <p class="like-info"><span class="align-middle"><i class="fa fa-heart"></i></span>4 people like this</p>
                    </div>
                </div>

                <!-- AUTHOR DATA -->
                <div class="blog-author">
                    <div class="media align-items-center">
                        <img src="assets/img/profile-pic.png" class="rounded" alt="<?= $user_name ?> <?= $user_last_name ?>">
                        <div class="media-body">
                            <a href="#">
                                <h4>Author: <?= $user_name ?> <?= $user_last_name ?></h4>
                            </a>
                            <p><?= $user_city ?>, <?= $user_country ?></p>
                            <p><?= $user_description ?></p>
                        </div>
                    </div>
                </div>
                <!-- AUTHOR DATA END -->

                <!-- COMMENT FORM -->
                <div class="comment-form">
                    <h4>Leave a Comment</h4>
                    <form class="form-contact comment_form" action="#" method="POST" id="comment_form">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9" placeholder="Leave a Comment on This Discussion"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="button button-contactForm btn_1 boxed-btn">Post a Comment</button>
                        </div>
                    </form>
                </div>
                <!-- END COMMENT FORM -->

                <!-- COMMENTS -->
                <div class="comments-area">
                    <h4>05 Comments</h4>

                    <div class="comment-list">
                        <div class="single-comment justify-content-between d-flex">
                            <div class="user justify-content-between d-flex">
                                <div class="thumb">
                                    <img src="assets/img/profile-pic.png" class="rounded" alt="">
                                </div>
                                <div class="desc">
                                    <p class="comment">
                                        Multiply sea night grass fourth day sea lesser rule open subdue female fill which them
                                        Blessed, give fill lesser bearing multiply sea night grass fourth day sea lesser
                                    </p>
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <h5>
                                                <a href="#">Emilly Blunt</a>
                                            </h5>
                                            <p class="date">December 4, 2017 at 3:12 pm </p>
                                        </div>
                                        <div class="reply-btn">
                                            <a href="#" class="btn-reply text-uppercase">reply</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="comment-list">
                        <div class="single-comment justify-content-between d-flex">
                            <div class="user justify-content-between d-flex">
                                <div class="thumb">
                                    <img src="assets/img/profile-pic.png" class="rounded" alt="">
                                </div>
                                <div class="desc">
                                    <p class="comment">
                                        Multiply sea night grass fourth day sea lesser rule open subdue female fill which them
                                        Blessed, give fill lesser bearing multiply sea night grass fourth day sea lesser
                                    </p>
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <h5>
                                                <a href="#">Emilly Blunt</a>
                                            </h5>
                                            <p class="date">December 4, 2017 at 3:12 pm </p>
                                        </div>
                                        <div class="reply-btn">
                                            <a href="#" class="btn-reply text-uppercase">reply</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="comment-list">
                        <div class="single-comment justify-content-between d-flex">
                            <div class="user justify-content-between d-flex">
                                <div class="thumb">
                                    <img src="assets/img/profile-pic.png" class="rounded" alt="">
                                </div>
                                <div class="desc">
                                    <p class="comment">
                                        Multiply sea night grass fourth day sea lesser rule open subdue female fill which them
                                        Blessed, give fill lesser bearing multiply sea night grass fourth day sea lesser
                                    </p>
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <h5>
                                                <a href="#">Emilly Blunt</a>
                                            </h5>
                                            <p class="date">December 4, 2017 at 3:12 pm </p>
                                        </div>
                                        <div class="reply-btn">
                                            <a href="#" class="btn-reply text-uppercase">reply</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END COMMENTS -->
            </div>

            <!-- SIDE BAR -->
            <div class="col-lg-4">
                <div class="blog_right_sidebar">
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
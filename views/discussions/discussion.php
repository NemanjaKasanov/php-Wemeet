<?php
include_once 'models/functions.php';

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

$likes = getLikesForDiscussion($id);
?>

<section class="blog_area single-post-area section-padding" xmlns="http://www.w3.org/1999/html">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 posts-list" id="discussions_display_box">

                <div class="single-post">
                    <div class="feature-img">
                        <img class="img-fluid" src="assets/img/blog/single_blog_1.png" alt="<?= $title ?>">
                    </div>
                    <div class="blog_details">
                        <h2><?= $title ?></h2>
                        <ul class="blog-info-link mt-3 mb-4">
                            <li><a href="index.php?page=category"><i class="fa fa-globe"></i> <?= $category ?></a></li>
                            <li><i class="fa fa-comments"></i> 03 Comments</li>
                        </ul>
                        <p class="excert"><?= $content ?></p>
                    </div>
                </div>
                <div class="navigation-top">
                    <div class="d-sm-flex justify-content-between text-center">
                        <form action="#" method="POST" name="likeForm" id="likeForm" class=""/>
                            <div class="col-12 d-flex justify-content-left">
                                <?php
                                    if(isset($_SESSION['userId'])):
                                ?>
                                <input type="submit" class="preventDefault btn btn-primary" id="likeButton" name="likeButton" value="Like"/>
                                <input type="hidden" name="userL" id="userL" value="<?= $_SESSION['userId'] ?>"/>
                                <input type="hidden" name="discussionL" id="discussionL" value="<?= $id ?>"/>
                                <?php
                                    endif;
                                ?>
                                <p class="like-info"><span class="align-middle">
                                    &nbsp;&nbsp;&nbsp;
                                        <i class="fa fa-heart"></i></a></span><span class="red likeConfirmation">   Liked! </span><span id="numberOfLikes"><?= $likes ?></span> people like this
                                </p>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- AUTHOR DATA -->
                <div class="blog-author">
                    <div class="media align-items-center">
                        <img src="assets/img/profile-pic.png" class="rounded" alt="<?= $user_name ?> <?= $user_last_name ?>">
                        <div class="media-body">
                            <a href="index.php?page=user&id=<?= $user_id ?>">
                                <h4>Author: <?= $user_name ?> <?= $user_last_name ?></h4>
                            </a>
                            <p><?= $user_city ?>, <?= $user_country ?></p>
                            <p><?= $user_description ?></p>
                        </div>
                    </div>
                </div>
                <!-- AUTHOR DATA END -->

                <!-- COMMENT FORM -->
                <?php
                if(isset($_SESSION['userId'])):
                ?>
                <div class="comment-form">
                    <h4>Leave a Comment</h4>
                    <form class="form-contact comment_form" action="models/discussions/comment.php" method="POST" id="comment_form" name="comment_form">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="hidden" value="<?= $_SESSION['userId'] ?>" id="comment_user_id" name="comment_user_id"/>
                                    <input type="hidden" value="<?= $_GET['id'] ?>" id="discussion_id" name="discussion_id"/>
                                    <textarea class="form-control w-100" name="content" id="comment_content" cols="30" rows="9" maxlength="200" placeholder="Leave a Comment on This Discussion"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="button button-contactForm btn_1 boxed-btn preventDefault" id="comment_btn" name="comment_btn" value="Post a Comment"/>
                        </div>
                    </form>
                </div>
                <?php
                endif;
                ?>
                <!-- END COMMENT FORM -->

                <!-- COMMENTS -->
                <div class="comments-area">
                    <?php
                    $count_comments = executeQuery("SELECT COUNT(id) AS cnt FROM comments WHERE discussion=".$_GET['id'])[0]->cnt;
                    ?>
                    <h4><span id="comments_count"><?= $count_comments ?></span> Comments </h4>
                    <div class="comment-list" id="comment_section">
                        <?php
                        $comments = executeQuery("SELECT * FROM comments WHERE discussion=".$_GET['id']);
                        foreach($comments as $comment):
                            $user_data = getUserData($comment->user)[0];
                            $user_name = $user_data->name." ".$user_data->last_name;
                        ?>

                        <div class="single-comment justify-content-between d-flex mb-4">
                            <div class="user justify-content-between d-flex">
                                <div class="thumb">
                                    <img src="assets/img/profile-pic.png" class="rounded" alt="Comment">
                                </div>
                                <div class="desc">
                                    <p class="comment">
                                        <?= $comment->content ?>
                                    </p>
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <h5>
                                                <a href="index.php?page=user&id=<?= $user_data->id ?>"><?= $user_name ?></a>
                                            </h5>
                                            <p class="date"><?= date('d.m.Y H:i:s', $comment->timestamp) ?> </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                        endforeach;
                        ?>

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
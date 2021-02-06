<?php

include_once 'models/functions.php';
include_once 'models/functions.php';

$user_id = $_GET['id'];
$user_data = getUserData($user_id)[0];
$user_name = $user_data->name;
$user_last_name = $user_data->last_name;
$user_city = $user_data->city;
$user_country = getUserCountry($user_id);
$user_email = $user_data->email;
$user_description = $user_data->description;
if($user_data->description == '') $desc = 'No Description';
else $desc = $user_data->description;
$user_role = $user_data->role;
?>

<div class="col-12 d-flex justify-content-center mt-5 mb-5 pt-5 pb-5">
    <div class="col-lg-6 col-sm-12 d-flex justify-content-center mb-5">
        <div class="media-body col-lg-6 col-sm-12">
            <h4 class="h1"><?= $user_name ?> <?= $user_last_name ?></h4>
            <p class="h4"><?= $user_city ?>, <?= $user_country ?></p>
            <p class="h4"><?= $user_email ?></p>
            <p class="h4">Role: <?php
                if($user_role == 1) echo 'Admin';
                else echo 'User'; ?>
            </p>
            <p class="h4 mb-5"><?= $desc ?></p>
            <?php
            if(isset($_SESSION['userId']) && $_SESSION['userId'] != $user_id):
                $check1 = executeQuery("SELECT * FROM friendships WHERE first=$user_id AND second=".$_SESSION['userId']);
                $check2 = executeQuery("SELECT * FROM friendships WHERE second=$user_id AND first=".$_SESSION['userId']);
                if(count($check1) == 0 && count($check2) == 0):
            ?>
                <form action="models/account/friend_request.php" method="POST" id="request_form" name="request_form">
                    <input type="hidden" name="sender" id="sender" value="<?= $_SESSION['userId'] ?>"/>
                    <input type="hidden" name="receiver" id="receiver" value="<?= $user_id ?>"/>
                    <input type="submit" class="btn btn-primary preventDefault" id="friend_request" name="friend_request" value="Send a Friend Request"/>
                </form>
                <p class="h6 mt-3" id="friendRequestNotificationText">Send a friend request to enable chat with this user.</p>
            <?php
                else:
                echo '<p class="h6 mt-3" id="friendRequestNotificationText">This user is your friend.</p>';
                endif;
            endif;
            ?>
        </div>
    </div>

    <div class="col-lg-6 col-sm-12">
        <div class="col-12">
            <p class="h1">This User's Discussions:</p>

            <div class="col-12">
                <?php
                $discussions = executeQuery("SELECT * FROM discussion WHERE user_id=".$user_id." ORDER BY timestamp DESC");
//                var_dump($discussions);
                foreach($discussions as $el):
                    $category = getDiscussionCategory($el->id);
                    $category_id = executeQuery("SELECT id FROM category WHERE name='".$category."'")[0]->id;

                    $timestamp = $el->timestamp;
                    $day = date("d", $timestamp);
                    $month = date("M", $timestamp);
                    $year = date("Y", $timestamp);

                    $likes = getLikesForDiscussion($el->id);
                ?>

                <article class="blog_item">
                    <div class="blog_details">
                        <a class="d-inline-block" href="index.php?page=discussion&id=<?= $el->id ?>">
                            <h2><?= $el->name ?></h2>
                        </a>
                        <p><?= $el->content ?></p>
                        <ul class="blog-info-link">
                            <li><a href="index.php?page=discussion&id=<?= $el->id ?>"><i class="fa fa-heart"> <?= $likes ?> Likes</i></a></li>
                            <li><a href="index.php?page=discussion&id=<?= $el->id ?>"><i class="fa fa-comment"> 111 Comments</i></a></li>
                            <li><a href="index.php?page=category&id=<?= $category_id ?>"><i class="fa fa-globe"> <?= $category ?></i></a></li>
                            <li><a href="index.php?page=discussion&id=<?= $el->id ?>"><?= $day.". ".$month." ".$year."." ?></a></li>
                        </ul>
                    </div>
                </article>

                <?php endforeach; ?>

            </div>
        </div>
    </div>
</div>
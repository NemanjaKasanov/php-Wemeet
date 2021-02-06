<?php
$user_id = $_SESSION['userId'];
$requests = executeQuery("SELECT * FROM friend_requests WHERE receiver=".$user_id." ORDER BY timestamp DESC");

if(count($requests) > 0):
?>

<aside class="single_sidebar_widget post_category_widget">
    <h4 class="widget_title">Friend Requests</h4>
    <ul class="list cat-list">
        <?php
        foreach($requests as $el):
            $sender_data = getUserData($el->sender)[0];
//        var_dump($sender_data);
            ?>
            <li class="mb-3">
                <form action="models/account/accept_decline_friend_request.php" method="POST" class="requestForm" id="request<?= $sender_data->id ?>">
                    <p class="h6">
                        <a href="index.php?page=user&id=<?= $sender_data->id ?>" alt="<?= $sender_data->name." ".$sender_data->last_name ?>">
                            <?= $sender_data->name." ".$sender_data->last_name ?>
                        </a> wants to be your friend.
                    </p>

                    <input type="hidden" name="receiver_id" value="<?= $user_id ?>"/>
                    <input type="hidden" name="sender_id" value="<?= $sender_data->id ?>"/>

                    <input type="submit" name="accept" value="Accept" class="btn btn-primary"/>
                    <input type="submit" name="decline" value="Decline" class="btn btn-danger"/>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
</aside>

<?php
endif;
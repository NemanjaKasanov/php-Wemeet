<?php
    $user_data = getUserData($_SESSION['userId'])[0];
    $user_name = $user_data->name.' '.$user_data->last_name;
    $user_address = $user_data->city.', '.getUserCountry($user_data->id);
    $user_role = $user_data->role;
    if($user_data->description == '') $desc = 'No Description';
    else $desc = $user_data->description;
?>

<div class="col-12 d-flex justify-content-center mt-5 mb-5 pt-5 pb-5">
    <div class="col-lg-6 col-sm-12">
        <div class="col-12">
            <p class="h4"><?= $user_name ?></p>
            <p class="h5"><?= $user_address ?></p>
            <p class="h5"><?= $user_data->email ?></p>
            <p class="h5">Role: <?php
                if($user_role == 1) echo 'Admin';
                else echo 'User'; ?>
            </p>
            <p class="h5">Description: <?= $desc ?></p>
        </div>
        <div class="comment-form">
            <h4>Change your description here:</h4>
            <form class="form-contact comment_form" action="models/account/description.php" method="POST" id="description_form">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <textarea class="form-control w-100" name="desc" id="desc" maxlength="500" cols="30" rows="9" placeholder="Description..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit_desc" class="button button-contactForm btn_1 boxed-btn" name="submit_desc">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
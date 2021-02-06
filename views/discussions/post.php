<div class="col-12 d-flex justify-content-center">
    <div class="col-lg-6 col-sm-12 mt-5 mb-5 pt-5 pb-5">
        <?php
        if(isset($_SESSION['userId'])):
        ?>
        <h3 class="mb-30 text-center">Fill in the form to post a discussion:</h3>

        <form id="post_form" name="post_form" action="models/discussions/post.php" method="POST" onsubmit="return postFormCheck()">
            <div class="mt-10">
                <input type="text" name="title" id="title" maxlength="70" placeholder="Discussion Title" class="single-input">
                <p class="red text-center text-danger" id="_title">Title is in an invalid format.</p>
            </div>
            <div class="input-group-icon mt-10">
                <div class="icon"><i class="fa fa-globe" aria-hidden="true"></i></div>
                <div class="form-select" id="default-select"">
                    <select name="category" id="category">
                        <option value="0">Category</option>
                        <?php
                        $categories = executeQuery("SELECT id, name FROM category ORDER BY name ASC");
                        foreach($categories as $ctg):
                        ?>
                            <option value="<?= $ctg->id ?>"><?= $ctg->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <p class="red text-center text-danger" id="_category">A category must be selected.</p>
            </div>
            <div class="mt-10">
                <textarea class="single-textarea" name="content" id="content" maxlength="500" placeholder="Discussion Content"></textarea>
                <p class="red text-center text-danger" id="_content">Content is in an invalid format.</p>
            </div>
            <div class="col-12 text-center mt-5">
                <input type="submit" class="btn btn-primary" name="submit_post" id="submit" value="Start a Discussion..."/>
                <p class="red text-center text-danger" id="_post">All data entered into the form must be in a valid format.</p>
            </div>

            <div class="col-12 mt-3">
                <?php
                if(isset($_SESSION['errors'])){
                    include 'models/logging/functions.php';
                    show_errors_array($_SESSION['errors']);
                    $_SESSION['errors'] = [];
                }
                ?>
            </div>

        </form>
    <?php
    else:?>
        <h3>Not logged in to post.</h3>
    <?php
    endif;
    ?>
    </div>
</div>
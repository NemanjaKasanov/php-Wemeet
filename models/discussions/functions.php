<?php

function create_discussions($where = ""){
    $per_page = 3;
    $count = executeQuery("SELECT COUNT(id) AS cnt FROM discussion ".$where)[0]->cnt;
    $pages = $count / $per_page;

    $page = 1;
    if(!isset($_GET['page_num'])) $page = 1;
    else $page = $_GET['page_num'];

    if(isset($_GET['page_num'])) {
        if ($_GET['page_num'] < 1) $page = $pages;
        if ($_GET['page_num'] > $pages) $page = 1;
    }

    $limit = ($page - 1) * $per_page;

    $discussions = executeQuery("SELECT * FROM discussion ".$where." ORDER BY timestamp DESC LIMIT ".$limit.",".$per_page);

    if(count($discussions) < 1){
        ?>
        <p class="h2">No Discussions to show.</p>
        <?php
    }
    else{

    foreach($discussions as $el):
        $timestamp = $el->timestamp;
        $day = date("d", $timestamp);
        $month = date("M", $timestamp);

        $cat_id = $el->category;
        $category = executeQuery("SELECT c.name FROM category AS c INNER JOIN discussion AS d ON c.id = d.category WHERE c.id =".$cat_id);
        $category = $category[0]->name;

        $user = executeQuery("SELECT * FROM users WHERE id = ".$el->user_id)[0];
        $user_name = $user->name." ".$user->last_name;

        $image = rand(1, 5);
        $likes = getLikesForDiscussion($el->id);

//                        ADD COMMENTS COUNT FOR EACH DISCUSSION
        ?>
        <article class="blog_item">
            <div class="blog_item_img">
                <img class="card-img rounded-0" src="assets/img/blog/single_blog_<?= $image ?>.png" alt="<?= $el->name ?>">
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
                    <li><a href="index.php?page=user&id=<?= $el->user_id ?>"><i class="fa fa-user"> <?= $user_name ?></i></a></li>
                    <li><a href="index.php?page=category&id=<?= $el->category ?>"><i class="fa fa-globe"> <?= $category ?></i></a></li>
                    <li><a href="index.php?page=discussion&id=<?= $el->id ?>"><i class="fa fa-comments"> </i> <?= $likes ?> Likes</a></li>
                    <li><a href="index.php?page=discussion&id=<?= $el->id ?>"><i class="fa fa-comments"> </i> 03 Comments</a></li>
                </ul>
            </div>
        </article>
    <?php endforeach; ?>
    <!-- POSTS END -->

    <?php
    $next_page = $page + 1;
    $last_page = $page - 1;

    $url = $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
    if(isset($_GET['page_num'])) $url = str_replace("&page_num=".$_GET['page_num'], "", $url);

    ?>
    <!-- PAGINATION -->
    <div class="blog-pagination justify-content-center d-flex">
        <ul class="pagination">
            <li class="page-item">
                <a href="<?= $url ?>&page_num=<?= $last_page ?>" class="page-link" aria-label="Previous">
                    <i class="ti-angle-left"></i>
                </a>
            </li>
            <li class="page-item">
                <a href="<?= $url ?>&page_num=<?= $page ?>" class="page-link active preventDefault"><?= $page ?></a>
            </li>
            <li class="page-item">
                <a href="<?= $url ?>&page_num=<?= $next_page ?>" class="page-link" aria-label="Next">
                    <i class="ti-angle-right"></i>
                </a>
            </li>
        </ul>
    </div>
    <!-- PAGINATION END -->
<?php }} ?>
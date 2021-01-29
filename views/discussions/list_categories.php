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
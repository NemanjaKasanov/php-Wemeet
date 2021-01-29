<aside class="single_sidebar_widget tag_cloud_widget">
    <h4 class="widget_title">Top Discussion Categories</h4>
    <ul class="list">
        <?php
        $top_ctg = executeQuery("SELECT c.id AS id, c.name AS name, COUNT(d.id) AS cnt FROM category AS c INNER JOIN discussion AS d ON c.id=d.category GROUP BY c.id ORDER BY cnt DESC LIMIT 5");
        foreach($top_ctg as $ctg):

        ?>
            <li>
                <a href="index.php?discussion=<?= $ctg->id ?>"><?= $ctg->name ?></a>
            </li>
        <?php
        endforeach;
        ?>
    </ul>
</aside>
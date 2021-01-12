<?php

function check_for_children($parentId){
    $childrenQuery = "SELECT * FROM nav_elements WHERE parent=$parentId";
    $childrenArray = executeQuery($childrenQuery);

    if(count($childrenArray) > 0){
        return true;
    }
    else{
        return false;
    }
}

function show_nav_elements($parent){
    $childrenQuery = "SELECT * FROM nav_elements WHERE parent=$parent";
    $childrenArray = executeQuery($childrenQuery);
    foreach($childrenArray as $child):
        echo '<li>';
        ?>
        <a href="<?= $child->href ?>" class="nav-link"><?= $child->name ?></a>
        <?php 
        if(check_for_children($child->id_nav)){
            echo '<ul class="submenu">';
            show_nav_elements($child->id_nav); 
            echo '</ul>';
        }
        echo "</li>";
    endforeach;
}

function populate_links($query){
    $social = executeQuery($query);
    foreach($social as $el):

    ?>
    <li><a target="_blank" href="<?= $el->href ?>"><?= $el->name ?></a></li>
    <?php
    
    endforeach;
}
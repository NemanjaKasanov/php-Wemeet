<?php

function show_errors_array($array){
    foreach($array as $el):
    ?>
    <p class="text-danger"><?= $el ?></p>
    <?php
    endforeach;
}
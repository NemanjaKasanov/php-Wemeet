<?php

function getUserData($id){
    return executeQuery("SELECT id, name, last_name, email, role, country, city, description FROM users WHERE id=$id");
}

function getUserCountry($id){
    $countryId = getUserData($id)[0]->country;
    return executeQuery("SELECT name FROM country WHERE id=$countryId")[0]->name;
}

function getDiscussionCategory($discussion_id){
    $cat_id = executeQuery("SELECT category FROM discussion WHERE id=$discussion_id")[0]->category;
    return executeQuery("SELECT name FROM category WHERE id=$cat_id")[0]->name;
}

function getLikesForDiscussion($discussion_id){
    return executeQuery("SELECT count(id) AS cnt FROM likes WHERE discussion=".$discussion_id)[0]->cnt;
}
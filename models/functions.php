<?php

function getUserData($id){
    return executeQuery("SELECT id, name, last_name, email, role, country, city FROM users WHERE id=$id");
}

function getUserCountry($id){
    $countryId = getUserData($id)[0]->country;
    $country = executeQuery("SELECT name FROM country WHERE id=$countryId")[0]->name;
    return $country;
}
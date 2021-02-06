<?php
session_start();
include_once '../../config/connection.php';

if(isset($_POST['submit_survey_btn'])){
    $user = $_SESSION['userId'];
    $questions = [];
    $answers = [];
    $survey = null;

    $count = 1;
    foreach($_POST as $el){
        if(is_numeric($el)){
            if($count == 1) $survey = $el;
            else if($count % 2 == 0) array_push($answers, $el);
            else array_push($questions, $el);
            $count++;
        }
    }

//    var_dump($user, $survey, $questions, $answers);
//    var_dump($_POST, $count);
    var_dump($questions, $answers);
    for($i = 0; $i < count($questions); $i++){
        $question = $questions[$i];
        $answer = $answers[$i];

        $query = "INSERT INTO survey_submissions (user_id, survey, question, answer) VALUES ($user, $survey, $question, $answer)";
        $connection->query($query);
    }

    header("Location: ../../index.php?page=survey");
}
<?php
session_start();
include '../../config/connection.php';

$user = $_SESSION['userId'];
$discussion = $_POST['discussion_id'];
$content = $_POST['content'];
$timestamp = time();

global $connection;
$insert = $connection->prepare("INSERT INTO comments (discussion, user, content, timestamp) VALUES (:discussion, :user, :content, $timestamp)");
$insert->bindParam(':user', $user, PDO::PARAM_INT);
$insert->bindParam(':discussion', $discussion, PDO::PARAM_INT);
$insert->bindParam(':content', $content, PDO::PARAM_STR, 200);
$insert->execute();

$comments = executeQuery("SELECT * FROM comments WHERE discussion=".$discussion);
$users = executeQuery("SELECT id, name, last_name FROM users");
$count_comments = executeQuery("SELECT COUNT(id) AS cnt FROM comments WHERE discussion=".$discussion)[0]->cnt;

$json = json_encode([
    "comments" => $comments,
    "users" => $users,
    "count" => $count_comments
]);
echo $json;


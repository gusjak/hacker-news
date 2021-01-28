<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we store/insert new comments in the database.
if (loggedIn() && isset($_POST['reply'])) {
    $comment = trim(filter_var($_POST['reply'], FILTER_SANITIZE_STRING));
    $id = (int) $_SESSION['user']['id'];
    $commentId = $_GET['id'];
    $timestamp = date('Y-m-d H:i:s');
    $postId = (int) $_POST['postid'];

    $statement = $pdo->prepare('INSERT INTO replies(comment_id, user_id, content, date) VALUES(:comment_id, :user_id, :content, :date)');

    $statement->bindParam(':comment_id', $commentId, PDO::PARAM_INT);
    $statement->bindParam(':user_id', $id, PDO::PARAM_INT);
    $statement->bindParam(':content', $comment, PDO::PARAM_STR);
    $statement->bindParam(':date', $timestamp, PDO::PARAM_STR);
    $statement->execute();

    $_SESSION['message'] = 'Your reply has been submitted.';

    redirect("/post.php?id=$postId");
}

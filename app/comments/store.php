<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we store/insert new comments in the database.
if (loggedIn() && isset($_POST['comment'])) {
    $comment = trim(filter_var($_POST['comment'], FILTER_SANITIZE_STRING));
    $id = (int) $_SESSION['user']['id'];
    $postId = $_GET['id'];
    $timestamp = date('Y-m-d H:i:s');

    $statement = $pdo->prepare('INSERT INTO comments(post_id, user_id, content, date) VALUES(:post_id, :user_id, :content, :date)');

    $statement->bindParam(':post_id', $postId, PDO::PARAM_INT);
    $statement->bindParam(':user_id', $id, PDO::PARAM_INT);
    $statement->bindParam(':content', $comment, PDO::PARAM_STR);
    $statement->bindParam(':date', $timestamp, PDO::PARAM_STR);
    $statement->execute();

    $_SESSION['message'] = 'Your comment has been submitted.';

    redirect('/post.php?id=' . $postId);
}

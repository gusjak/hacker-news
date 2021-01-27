<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we store/insert upvotes in the database.

if (loggedIn() && isset($_POST['comment-id'])) {
    $commentId = $_POST['comment-id'];
    $userId = (int) $_SESSION['user']['id'];
    $postId = (int) $_POST['postid'];

    $statement = $pdo->prepare('SELECT * from comment_upvotes WHERE comment_id = :comment_id AND user_id = :user_id');

    $statement->bindParam(':comment_id', $commentId, PDO::PARAM_INT);
    $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $statement->execute();

    $alreadyUpvoted = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$alreadyUpvoted) {
        $statement = $pdo->prepare('INSERT INTO comment_upvotes (comment_id, user_id) VALUES (:comment_id, :user_id)');

        $statement->bindParam(':comment_id', $commentId, PDO::PARAM_INT);
        $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $statement->execute();
    } else {
        $statement = $pdo->prepare('DELETE FROM comment_upvotes WHERE comment_id = :comment_id AND user_id = :user_id');

        $statement->bindParam(':comment_id', $commentId, PDO::PARAM_INT);
        $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $statement->execute();
    }
    redirect("/post.php?id=$postId");
}

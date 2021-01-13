<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we delete comments in the database.
if (loggedIn()) {
    $userId = $_SESSION['user']['id'];
    $postId = $_GET['id'];
    $commentId = $_GET['comment-id'];

    $statement = $pdo->prepare('DELETE FROM comments WHERE id = :id AND user_id = :user_id');

    $statement->bindParam(':id', $commentId, PDO::PARAM_INT);
    $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $statement->execute();

    $_SESSION['message'] = 'Your comment has been deleted.';

    redirect('/post.php?id=' . $postId);
}

<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we store/insert upvotes in the database.

if (loggedIn() && isset($_POST['postid'])) {
    $postId = $_POST['postid'];
    $userId = (int) $_SESSION['user']['id'];

    $statement = $pdo->prepare('SELECT * from upvotes WHERE post_id = :post_id AND user_id = :user_id');

    if (!$statement) {
        die(var_dump($pdo->errorinfo()));
    }

    $statement->bindParam(':post_id', $postId, PDO::PARAM_INT);
    $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);

    $statement->execute();

    $alreadyUpvoted = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$alreadyUpvoted) {
        $statement = $pdo->prepare('INSERT INTO upvotes (post_id, user_id) VALUES (:post_id, :user_id)');

        if (!$statement) {
            die(var_dump($pdo->errorinfo()));
        }

        $statement->bindParam(':post_id', $postId, PDO::PARAM_INT);
        $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);

        $statement->execute();
    } else {
        $statement = $pdo->prepare('DELETE FROM upvotes WHERE post_id = :post_id AND user_id = :user_id');

        if (!$statement) {
            die(var_dump($pdo->errorinfo()));
        }

        $statement->bindParam(':post_id', $postId, PDO::PARAM_INT);
        $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);

        $statement->execute();
    }

    redirect('/new.php');
}

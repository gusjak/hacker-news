<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (loggedIn()) {
    $newTitle = trim(filter_var($_POST['edit-title']));
    $newUrl = trim(filter_var($_POST['edit-url'], FILTER_SANITIZE_STRING));
    $newText = trim(filter_var($_POST['edit-text-content'], FILTER_SANITIZE_STRING));

    $id = (int) $_SESSION['user']['id'];
    $username = $_SESSION['user']['username'];

    $statement = $pdo->prepare('UPDATE posts SET title = :title, url = :url, text = :text WHERE id = :id AND user_id = :user_id');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':title', $newTitle, PDO::PARAM_STR);
    $statement->bindParam(':url', $newUrl, PDO::PARAM_STR);
    $statement->bindParam(':text', $newText, PDO::PARAM_STR);
    $statement->bindParam(':user_id', $id, PDO::PARAM_INT);

    $statement->execute();

    $_SESSION['message'] = 'Your post has been updated.';
}

redirect('/posts.php');

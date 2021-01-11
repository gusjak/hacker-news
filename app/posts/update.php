<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we edit new posts in the database.
if (loggedIn() && isset($_POST)) {
    $id = $_SESSION['user']['id'];
    $postId = $_GET['id'];
    $newTitle = trim(filter_var($_POST['new-title'], FILTER_SANITIZE_STRING));
    $newUrl = trim(filter_var($_POST['new-url'], FILTER_SANITIZE_URL));
    $newText = trim(filter_var($_POST['new-text'], FILTER_SANITIZE_STRING));

    $statement = $pdo->prepare('UPDATE posts SET title = :title, url = :url, text = :text WHERE id = :post_id AND user_id = :user_id');
    $statement->bindParam(':title', $newTitle, PDO::PARAM_STR);
    $statement->bindParam(':url', $newUrl, PDO::PARAM_STR);
    $statement->bindParam(':text', $newText, PDO::PARAM_STR);
    $statement->bindParam(':post_id', $postId, PDO::PARAM_INT);
    $statement->bindParam(':user_id', $id, PDO::PARAM_INT);

    $statement->execute();

    $_SESSION['message'] = 'Your comment has been updated.';

    redirect('/userposts.php');
}

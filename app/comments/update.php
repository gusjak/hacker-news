<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we edit new posts in the database.
if (loggedIn() && isset($_POST['submit'])) {
    $id = $_POST['postid'];
    $editComment = trim(filter_var($_POST['edit-comment'], FILTER_SANITIZE_STRING));

    $statement = $pdo->prepare('UPDATE comments SET content = :content WHERE id = :id');
    $statement->bindParam(':content', $editComment, PDO::PARAM_STR);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);

    $statement->execute();

    $_SESSION['message'] = 'Your comment has been updated.';
}

redirect('/index.php');

<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we delete comments in the database.
if (loggedIn() && isset($_POST['submit'])) {
    $id = $_POST['postid'];

    $statement = $pdo->prepare('DELETE FROM comments WHERE id = :id');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();

    $_SESSION['message'] = 'Your comment has been deleted.';
}
redirect('/index.php');

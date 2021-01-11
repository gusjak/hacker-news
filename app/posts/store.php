<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we store/insert new posts in the database.
if (loggedIn() && isset($_POST['title'], $_POST['url'], $_POST['text-content'])) {
    $title = trim(filter_var($_POST['title']));
    $url = trim(filter_var($_POST['url'], FILTER_VALIDATE_URL));
    $text = trim(filter_var($_POST['text-content'], FILTER_SANITIZE_STRING));

    $id = (int) $_SESSION['user']['id'];
    $username = $_SESSION['user']['username'];

    $timestamp = date('Y-m-d H:i:s');

    $statement = $pdo->prepare('INSERT INTO posts(title, url, text, user_id, date) VALUES(:title, :url, :text, :user_id, :date)');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':title', $title, PDO::PARAM_STR);
    $statement->bindParam(':url', $url, PDO::PARAM_STR);
    $statement->bindParam(':text', $text, PDO::PARAM_STR);
    $statement->bindParam(':user_id', $id, PDO::PARAM_INT);
    $statement->bindParam(':date', $timestamp, PDO::PARAM_STR);

    $statement->execute();

    $_SESSION['message'] = 'Your post has been submitted.';

    redirect('/submit.php');
}

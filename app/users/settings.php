<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (loggedIn()) {
    $id = (int) $_SESSION['user']['id'];
    $firstName = trim(filter_var($_POST['edit-first-name'], FILTER_SANITIZE_STRING));
    $lastName = trim(filter_var($_POST['edit-last-name'], FILTER_SANITIZE_STRING));

    if ($_POST['edit-first-name'] == '') {
        $firstName = $_SESSION['user']['first_name'];
    } else {

        $statement = $pdo->prepare('UPDATE users SET first_name = :first_name WHERE id = :id');

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->bindParam(':first_name', $firstName, PDO::PARAM_STR);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $_SESSION['message'] = 'Your settings has been updated.';
    }

    if ($_POST['edit-last-name'] == '') {
        $lastName = $_SESSION['user']['last_name'];
    } else {

        $statement = $pdo->prepare('UPDATE users SET last_name = :last_name WHERE id = :id');

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->bindParam(':last_name', $lastName, PDO::PARAM_STR);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $_SESSION['message'] = 'Your settings has been updated.';
    }

    redirect('/settings.php');
}

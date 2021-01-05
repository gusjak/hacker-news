<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (loggedIn() && isset($_POST['current-email'], $_POST['new-email'], $_POST['comfirm-email'])) {
    $id = (int) $_SESSION['user']['id'];
    $currentEmail = trim(filter_var($_POST['current-email'], FILTER_SANITIZE_EMAIL));
    $newEmail = trim(filter_var($_POST['new-email'], FILTER_SANITIZE_EMAIL));
    $comfirmEmail = trim(filter_var($_POST['comfirm-email'], FILTER_SANITIZE_EMAIL));

    if (!filter_var($currentEmail, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = 'The email is not a valid email address.';
    }

    if (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = 'The email is not a valid email address.';
    }

    if (!filter_var($comfirmEmail, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = 'The email is not a valid email address.';
    }

    $statement = $pdo->prepare('SELECT email FROM users WHERE id = :id');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if ($currentEmail == $user['email']) {
        if ($newEmail == $comfirmEmail) {
            $statement = $pdo->prepare('UPDATE users SET email = :email WHERE id = :id');

            if (!$statement) {
                die(var_dump($pdo->errorInfo()));
            }

            $statement->bindParam(':email', $newEmail, PDO::PARAM_STR);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();

            $_SESSION['user']['email'] = $newEmail;
            $_SESSION['message'] = 'Your email has been updated.';
        } else {
            $_SESSION['message'] = 'Your new emails doesn\'t match. Please try again.';
        }
    } else {
        $_SESSION['message'] = 'You entered the wrong current email. Please try again.';
    }
} else {
    redirect('/');
}

redirect('/settings.php');

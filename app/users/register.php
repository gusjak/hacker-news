<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we register a new user.
if (isset($_POST['email'], $_POST['username'], $_POST['password'], $_POST['comfirm_password'])) {
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $confirmPassword = $_POST['confirm_password'];
    $errors = [];

    if (!$email) {
        $errors[] = 'The email address is not a valid email address.';
    }

    if ($password !== $comfirmPassword) {
        $errors[] = 'The passwords you have entered does not match.';
    }

    $query = 'INSERT INTO users (email, username, password) VALUES (:email, :username, :password)';
    $statement = $pdo->prepare($query);

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->bindParam(':password', $password, PDO::PARAM_STR);
    $statement->execute();
}
redirect('/login.php');

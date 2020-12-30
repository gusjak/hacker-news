<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we register a new user.
if (isset($_POST['email'], $_POST['username'], $_POST['password'])) {
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));

    if (existingEmail($email, $pdo)) {
        $_SESSION['message'] = 'This email is already in use.';
        redirect('/register.php');
    }

    if (existingUser($username, $pdo)) {
        $_SESSION['message'] = 'This username is already in use.';
        redirect('/register.php');
    }

    if ($_POST['password'] !== $_POST['comfirm_password']) {
        $_SESSION['message'] = 'Your passwords doesn\'t match, please try again.';
        redirect('/register.php');
    }

    $password = trim(password_hash($_POST['password'], PASSWORD_BCRYPT));

    $query = 'INSERT INTO users (email, username, password) VALUES (:email, :username, :password)';
    $statement = $pdo->prepare($query);

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->bindParam(':password', $password, PDO::PARAM_STR);
    $statement->execute();

    $_SESSION['message'] = 'Succesfully created account. You may now log in.';
}
redirect('/login.php');

<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we register a new user.
if (isset($_POST['email'], $_POST['username'], $_POST['password'])) {
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = 'The email is not a valid email address.';
    }

    if (existingEmail($email, $pdo)) {
        $_SESSION['message'] = 'This email is already in use.';
        redirect('/register.php');
    }

    if (existingUser($username, $pdo)) {
        $_SESSION['message'] = 'This username is already in use.';
        redirect('/register.php');
    }

    if (strlen($_POST['password']) < 6) {
        $_SESSION['message'] = 'The password must be at least 6 characters long.';
        redirect('/register.php');
    }

    if ($_POST['password'] !== $_POST['comfirm-password']) {
        $_SESSION['message'] = 'Your passwords doesn\'t match, please try again.';
        redirect('/register.php');
    }

    $password = trim(password_hash($_POST['password'], PASSWORD_BCRYPT));
    $firstName = '';
    $lastName = '';
    $userAvatar = 'placeholder.png';
    $biography = '';

    $statement = $pdo->prepare('INSERT INTO users (email, username, password, first_name, last_name, avatar, biography) 
                                VALUES (:email, :username, :password, :first_name, :last_name, :avatar, :biography)');


    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->bindParam(':password', $password, PDO::PARAM_STR);
    $statement->bindParam(':first_name', $firstName, PDO::PARAM_STR);
    $statement->bindParam(':last_name', $lastName, PDO::PARAM_STR);
    $statement->bindParam(':avatar', $userAvatar, PDO::PARAM_STR);
    $statement->bindParam(':biography', $biography, PDO::PARAM_STR);
    $statement->execute();

    $_SESSION['message'] = 'Succesfully created account. You may now log in. <br> You can update your profile information in \'Settings\'.';
}
redirect('/login.php');

<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we register a new user.
if (isset($_POST['email'], $_POST['username'], $_POST['password'], $_POST['comfirm_password'])) {
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    $errors = [];

    if (!$email) {
        $errors[] = 'The email address is not a valid email address.';
    }

    if ($password !== $comfirmPassword) {
        $errors[] = 'The passwords you have entered does not match.';
    } else {
        $password = password_hash($password, PASSWORD_BCRYPT);
    }
}
redirect('/login.php');

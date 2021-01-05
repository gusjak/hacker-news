<?php

declare(strict_types=1);

// Function to redirect the user.
function redirect(string $path)
{
    header("Location: ${path}");
    exit;
}

// Function to verify if the user is logged in.
function loggedIn(): bool
{
    return isset($_SESSION['user']);
}

// Function to pair the current user with an ID.
function getUserById(int $id, object $pdo): array
{
    $statement = $pdo->prepare('SELECT * FROM users WHERE id = :id');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([':id' => $id]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        return $user;
    }
}

// Function to verify the id of a user. (To edit profile/posts).
function isUser($user): bool
{
    if ($_SESSION['user']['id'] === $user['id']) {
        return true;
    } else {
        return false;
    }
}

// Function to check if the email already exists in the database.
function existingEmail(string $email, object $pdo): bool
{
    $statement = $pdo->prepare('SELECT * FROM users WHERE email = :email');
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();

    $email = $statement->fetch(PDO::FETCH_ASSOC);

    if ($email) {
        return true;
    }

    return false;
}

// Function to check if the username already exists in the database.
function existingUser(string $username, object $pdo): bool
{
    $statement = $pdo->prepare('SELECT * FROM users WHERE username = :username');
    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        return true;
    }

    return false;
}

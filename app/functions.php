<?php

declare(strict_types=1);

// Function to redirect the user.
function redirect(string $path)
{
    header("Location: ${path}");
    exit;
}

// USER RELATED FUNCTIONS

// Function to verify if the user is logged in.
function loggedIn(): bool
{
    return isset($_SESSION['user']);
}

// Function to pair the current user with an ID. (So users can edit only their own profile settings.)
function getUserById(int $id, object $pdo): array
{
    $statement = $pdo->prepare('SELECT * FROM users WHERE id = :id');
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if ($user) {
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


// POST RELATED FUNCTIONS

// Function to sort posts in descending order.
function sortByDate(array $a, array $b)
{
    return ($a['id'] < $b['id']);
}

// Function to return all posts from all users.
function displayAllPosts(object $pdo): array
{
    $statement = $pdo->prepare('SELECT posts.id, title, url, text, user_id, date, username, avatar
                                FROM posts
                                INNER JOIN users
                                ON posts.user_id = users.id
                                ORDER BY posts.date DESC');

    $statement->execute();

    $allPosts = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $allPosts;
}

// Function to return all posts from one user.
function displayUserPosts(int $id, object $pdo): array
{
    $statement = $pdo->prepare('SELECT *
                                FROM posts
                                WHERE user_id = :user_id');

    $statement->bindParam(':user_id', $id, PDO::PARAM_INT);
    $statement->execute();

    $userPosts = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $userPosts;
}

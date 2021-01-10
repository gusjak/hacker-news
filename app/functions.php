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

// Function to return all posts from all users in descending order.
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

// Function to return all posts from one user in descending order.
function displayUserPosts(int $id, object $pdo): array
{
    $statement = $pdo->prepare('SELECT *, users.username, users.avatar
                                FROM posts
                                INNER JOIN users
                                ON posts.user_id = users.id
                                WHERE user_id = :user_id
                                ORDER BY posts.date DESC');

    $statement->bindParam(':user_id', $id, PDO::PARAM_INT);
    $statement->execute();

    $userPosts = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $userPosts;
}

// Function to pair the current post with an ID. (So users can edit only their own posts.)
function getPostById(int $id, object $pdo): array
{
    $statement = $pdo->prepare('SELECT * FROM posts WHERE id = :id');
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        return $user;
    }
}

// Function to count upvotes
function countUpvotes(int $postId, object $pdo): string
{
    $statement = $pdo->prepare('SELECT COUNT(*) FROM upvotes WHERE post_id = :post_id');

    $statement->bindParam(':post_id', $postId, PDO::PARAM_INT);

    $statement->execute();

    $upvotes = $statement->fetch(PDO::FETCH_ASSOC);

    return $upvotes['COUNT(*)'];
}

// Function to determine if user already upvoted post.
function alreadyUpvoted(int $postId, int $userId, object $pdo): bool
{
    $statement = $pdo->prepare('SELECT * FROM upvotes WHERE post_id = :post_id AND user_id = :user_id');

    $statement->bindParam(':post_id', $postId, PDO::PARAM_INT);
    $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);

    $statement->execute();

    $alreadyUpvoted = $statement->fetch(PDO::FETCH_ASSOC);

    return $alreadyUpvoted ? true : false;
}

// Function to sort posts by most upvoted.
function sortByUpvotes(object $pdo): array
{
    $statement = $pdo->prepare('SELECT COUNT(upvotes.post_id) as upvotes, posts.id, posts.title, posts.url, posts.text, posts.user_id, posts.date, users.username, users.avatar
                                FROM upvotes
                                INNER JOIN posts
                                ON upvotes.post_id = posts.id
                                INNER JOIN users
                                ON posts.user_id = users.id
                                GROUP BY upvotes.post_id
                                ORDER BY upvotes DESC');
    $statement->execute();

    $posts = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $posts;
}


// COMMENT RELATED FUNCTIONS

// Function to display comments.
function getComments(int $postId, PDO $pdo): array
{
    $statement = $pdo->prepare('SELECT comments.id, comments.user_id, comments.post_id, comments.content, comments.date, users.username, users.avatar
                                FROM comments
                                INNER JOIN users
                                ON comments.user_id = users.id
                                WHERE comments.post_id = :id
                                ORDER BY comments.date DESC');

    $statement->bindParam(':id', $postId, PDO::PARAM_STR);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

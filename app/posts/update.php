<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we edit new posts in the database.
if (loggedIn() && isset($_POST['submit'])) {
    $id = $_POST['postid'];
    $newTitle = trim(filter_var($_POST['new-title'], FILTER_SANITIZE_STRING));
    $newUrl = trim(filter_var($_POST['new-url'], FILTER_SANITIZE_URL));
    $newText = trim(filter_var($_POST['new-text'], FILTER_SANITIZE_STRING));

    $statement = $pdo->prepare('UPDATE posts SET title = :title, url = :url, text = :text WHERE id = :id');
    $statement->bindParam(':title', $newTitle, PDO::PARAM_STR);
    $statement->bindParam(':url', $newUrl, PDO::PARAM_STR);
    $statement->bindParam(':text', $newText, PDO::PARAM_STR);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);

    $statement->execute();

    $_SESSION['message'] = 'Your post has been updated.';
}

redirect('/index.php');


// Will maybe fix this code later...

// if (loggedIn()) {
//     $id = (int) $_SESSION['user']['id'];
//     $postId = $_POST['postId'];
//     $newTitle = trim(filter_var($_POST['title'], FILTER_SANITIZE_STRING));
//     $newUrl = trim(filter_var($_POST['url'], FILTER_SANITIZE_URL));
//     $newTextContent = trim(filter_var($_POST['text-content'], FILTER_SANITIZE_STRING));

//     // Save new title changes to the database.
//     if ($_POST['title'] == '') {
//         $_SESSION['message'] = 'Something went horribly wrong.';
//     } else {
//         $statement = $pdo->prepare('UPDATE posts SET title = :title WHERE id = :id AND user_id = :user_id');

//         if (!$statement) {
//             die(var_dump($pdo->errorInfo()));
//         }

//         $statement->bindParam(':title', $newTitle, PDO::PARAM_STR);
//         $statement->bindParam(':id', $id, PDO::PARAM_INT);
//         $statement->execute();

//         $_SESSION['message'] = 'Your settings has been updated.';
//     }

//     // Save new url changes to the database.
//     if ($_POST['url'] == '') {
//         $_SESSION['message'] = 'Something went horribly wrong.';
//     } else {
//         $statement = $pdo->prepare('UPDATE posts SET url = :url WHERE id = :id AND user_id = :user_id');

//         if (!$statement) {
//             die(var_dump($pdo->errorInfo()));
//         }

//         $statement->bindParam(':url', $newUrl, PDO::PARAM_STR);
//         $statement->bindParam(':id', $id, PDO::PARAM_INT);
//         $statement->execute();

//         $_SESSION['message'] = 'Your settings has been updated.';
//     }

//     // Save text content changes to the database.
//     if ($_POST['text-content'] == '') {
//         $_SESSION['message'] = 'Something went horribly wrong.';
//     } else {
//         $statement = $pdo->prepare('UPDATE posts SET text = :text WHERE id = :id AND user_id = :user_id');

//         if (!$statement) {
//             die(var_dump($pdo->errorInfo()));
//         }

//         $statement->bindParam(':text', $newText, PDO::PARAM_STR);
//         $statement->bindParam(':id', $id, PDO::PARAM_INT);
//         $statement->execute();

//         $_SESSION['message'] = 'Your personal settings has been updated';
//     }

//     redirect('/updateuserpost.php');
// }

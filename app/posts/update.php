<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we edit new posts in the database.

// Will fix this code...

// if (loggedIn() && isset($_POST['edit-title'], $_POST['edit-url'], $_POST['edit-text-content'])) {
//     $id = (int) $_SESSION['user']['id'];
//     $newTitle = trim(filter_var($_POST['edit-title'], FILTER_SANITIZE_STRING));
//     $newUrl = trim(filter_var($_POST['edit-url'], FILTER_SANITIZE_URL));
//     $newTextContent = trim(filter_var($_POST['edit-text-content'], FILTER_SANITIZE_STRING));

//     // Save new title changes to the database.
//     if ($_POST['edit-title'] == '') {
//         $_SESSION['message'] = 'No changes made to title';
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
//     if ($_POST['edit-url'] == '') {
//         $_SESSION['message'] = 'No changes made to URL.';
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
//     if ($_POST['edit-text-content'] == '') {
//         $_SESSION['message'] = 'No changes made to text.';
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

//     redirect('/posts.php');
// }

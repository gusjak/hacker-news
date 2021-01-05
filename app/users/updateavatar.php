<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (LoggedIn() && isset($_FILES['avatar'])) {
    $avatar = $_FILES['avatar'];
    $username = $_SESSION['user']['username'];
    $id = (int) $_SESSION['user']['id'];
    $path = __DIR__ . '/images/';
    $fileType = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
    $time = date('ymd');

    $newAvatar = $time . '-' . $username . '.' . $fileType;

    if ($avatar['size'] >= 3e6) {
        $_SESSION['message'] = 'The uploaded file exceeded the size limit.';
        redirect('/settings.php');
    }

    if ($avatar['type'] !== 'image/jpg' && $avatar['type'] !== 'image/jpeg' && $avatar['type'] !== 'image/png') {
        $_SESSION['message'] = 'The uploaded file type is not allowed.';
    } else {
        filter_var($avatar['name'], FILTER_SANITIZE_STRING);

        $statement = $pdo->prepare('UPDATE users SET avatar = :avatar WHERE id = :id');

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->bindParam(':avatar', $newAvatar, PDO::PARAM_STR);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        move_uploaded_file($avatar['tmp_name'], $path . $newAvatar);
    }
    $_SESSION['message'] = 'Your avatar was successfully updated.';
    $_SESSION['user']['avatar'] = $newAvatar;
    redirect('/settings.php');
}
redirect('/');

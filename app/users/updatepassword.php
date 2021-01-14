<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (loggedIn() && isset($_POST['current-password'], $_POST['new-password'], $_POST['comfirm-password'])) {
    $id = (int) $_SESSION['user']['id'];
    $currentPassword = trim($_POST['current-password']);
    $newPassword = trim($_POST['new-password']);
    $comfirmPassword = trim($_POST['comfirm-password']);

    $statement = $pdo->prepare('SELECT password FROM users WHERE id = :id');

    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if (password_verify($currentPassword, $user['password'])) {
        if ($newPassword == $comfirmPassword) {
            $statement = $pdo->prepare('UPDATE users SET password = :password WHERE id = :id');

            $statement->bindParam(':password', password_hash($newPassword, PASSWORD_BCRYPT), PDO::PARAM_STR);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();

            $_SESSION['user']['password'] = $newPassword;
            $_SESSION['message'] = 'Your password has been updated. <br> Please log back in with your new password.';

            unset($_SESSION['user']);
            redirect('/login.php');
        } else {
            $_SESSION['message'] = 'Your new passwords doesn\'t match. Please try again.';
        }
    } else {
        $_SESSION['message'] = 'You entered the wrong current password. Please try again.';
    }
} else {
    redirect('/');
}

redirect('/settings.php');

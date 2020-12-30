<?php

declare(strict_types=1);

// Message to declare error or success to user.
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    echo $message;
    unset($_SESSION['message']);
}

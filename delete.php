<?php
include 'users.php';
if (isset($_GET['email'])) {
    $email = $_GET['email'];
    $newUser = new users();
    $newUser->deleteUser($email);
    header("Location: index.php");
    exit();
}

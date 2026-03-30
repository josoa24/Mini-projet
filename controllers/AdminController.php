<?php
require_once __DIR__ . '/../models/functions/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $user = verifyLogin($email, $password);
    if ($user) {
        session_start();
        $_SESSION['user'] = $user;
        header('Location: /admin/articles');
        exit;
    } else {
        header('Location: /admin/login?error=1');
        exit;
    }
}

header('Location: /admin/login');
exit;
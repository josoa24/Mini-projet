<?php

require_once __DIR__ . '/conn.php';
function findUserByEmail(string $email): ?array
{
    $pdo = connect();

    $sql = 'SELECT * FROM users WHERE email = :email LIMIT 1';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    return $user !== false ? $user : null;
}
function verifyLogin(string $email, string $password): ?array
{
    $user = findUserByEmail($email);

    if (!$user) {
        return null;
    }

    if ($user['password'] === $password) {
        return $user; 
    }

    return null; 
}

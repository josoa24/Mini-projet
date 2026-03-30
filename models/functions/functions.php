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

function getArticles(int $limit, int $offset, ?string $status = null, ?string $categorySlug = null, ?string $search = null): array
{
    $pdo = connect();

    $sql = 'SELECT a.*, c.title AS category_title, c.slug AS category_slug, u.name AS author_name
            FROM articles a
            LEFT JOIN categories c ON a.category_id = c.id
            LEFT JOIN users u ON a.user_id = u.id
            WHERE 1=1';
    $params = [];

    if ($status !== null && $status !== '') {
        $sql .= ' AND a.status = :status';
        $params['status'] = $status;
    }
    if ($categorySlug !== null && $categorySlug !== '') {
        $sql .= ' AND c.slug = :categorySlug';
        $params['categorySlug'] = $categorySlug;
    }
    if ($search !== null && $search !== '') {
        $sql .= ' AND (a.title ILIKE :search OR a.content ILIKE :search)';
        $params['search'] = '%' . $search . '%';
    }

    $sql .= ' ORDER BY a.created_at DESC LIMIT :limit OFFSET :offset';

    $stmt = $pdo->prepare($sql);
    foreach ($params as $key => $value) {
        $stmt->bindValue(':' . $key, $value, PDO::PARAM_STR);
    }
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function countArticles(?string $status = null, ?string $categorySlug = null, ?string $search = null): int
{
    $pdo = connect();

    $sql = 'SELECT COUNT(*) AS total
            FROM articles a
            LEFT JOIN categories c ON a.category_id = c.id
            WHERE 1=1';
    $params = [];

    if ($status !== null && $status !== '') {
        $sql .= ' AND a.status = :status';
        $params['status'] = $status;
    }
    if ($categorySlug !== null && $categorySlug !== '') {
        $sql .= ' AND c.slug = :categorySlug';
        $params['categorySlug'] = $categorySlug;
    }
    if ($search !== null && $search !== '') {
        $sql .= ' AND (a.title ILIKE :search OR a.content ILIKE :search)';
        $params['search'] = '%' . $search . '%';
    }

    $stmt = $pdo->prepare($sql);
    foreach ($params as $key => $value) {
        $stmt->bindValue(':' . $key, $value, PDO::PARAM_STR);
    }
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return (int) ($row['total'] ?? 0);
}
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

function getArticleById(int $id): ?array
{
    $pdo = connect();

    $sql = 'SELECT a.*, c.title AS category_title, c.slug AS category_slug, u.name AS author_name
            FROM articles a
            LEFT JOIN categories c ON a.category_id = c.id
            LEFT JOIN users u ON a.user_id = u.id
            WHERE a.id = :id
            LIMIT 1';

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    $article = $stmt->fetch(PDO::FETCH_ASSOC);

    return $article !== false ? $article : null;
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

function getCategories(): array
{
    $pdo = connect();

    $sql = 'SELECT * FROM categories ORDER BY title ASC';
    $stmt = $pdo->query($sql);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getCategoryById(int $id): ?array
{
    $pdo = connect();
    $stmt = $pdo->prepare('SELECT * FROM categories WHERE id = :id LIMIT 1');
    $stmt->execute(['id' => $id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row !== false ? $row : null;
}

function createArticle(string $title, string $slug, string $content, ?string $imagePath, string $status, int $userId, int $categoryId, ?string $metaDescription = null, ?string $altText = null): int
{
    $pdo = connect();

    $sql = 'INSERT INTO articles (title, slug, content, image_path, status, user_id, category_id, meta_description, alt_text, published_at)
            VALUES (:title, :slug, :content, :image_path, :status, :user_id, :category_id, :meta_description, :alt_text, :published_at)
            RETURNING id';

    $publishedAt = $status === 'published' ? date('Y-m-d H:i:s') : null;

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'title' => $title,
        'slug' => $slug,
        'content' => $content,
        'image_path' => $imagePath,
        'status' => $status,
        'user_id' => $userId,
        'category_id' => $categoryId,
        'meta_description' => $metaDescription,
        'alt_text' => $altText,
        'published_at' => $publishedAt,
    ]);

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return (int) ($row['id'] ?? 0);
}

function updateArticle(int $id, string $title, string $slug, string $content, ?string $imagePath, string $status, int $categoryId, ?string $metaDescription = null, ?string $altText = null): bool
{
    $pdo = connect();

    $sql = 'UPDATE articles
            SET title = :title,
                slug = :slug,
                content = :content,
                image_path = :image_path,
                status = :status,
                category_id = :category_id,
                meta_description = :meta_description,
                alt_text = :alt_text,
                updated_at = CURRENT_TIMESTAMP
            WHERE id = :id';

    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        'id' => $id,
        'title' => $title,
        'slug' => $slug,
        'content' => $content,
        'image_path' => $imagePath,
        'status' => $status,
        'category_id' => $categoryId,
        'meta_description' => $metaDescription,
        'alt_text' => $altText,
    ]);
}

function deleteArticle(int $id): bool
{
    $pdo = connect();

    $sql = 'DELETE FROM articles WHERE id = :id';
    $stmt = $pdo->prepare($sql);

    return $stmt->execute(['id' => $id]);
}

function updateCategory(int $id, string $title, string $slug): bool
{
    $pdo = connect();
    $sql = 'UPDATE categories SET title = :title, slug = :slug WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        'id' => $id,
        'title' => $title,
        'slug' => $slug,
    ]);
}

function createImageArticle(int $articleId, string $imagePath, ?string $altText = null): bool
{
    $pdo = connect();

    $sql = 'INSERT INTO imagearticle (article_id, image_path, alt_text)
            VALUES (:article_id, :image_path, :alt_text)';

    $stmt = $pdo->prepare($sql);
    
    return $stmt->execute([
        'article_id' => $articleId,
        'image_path' => $imagePath,
        'alt_text' => $altText,
    ]);
}

function getArticleImages(int $articleId): array
{
    $pdo = connect();
    $sql = 'SELECT * FROM imagearticle WHERE article_id = :article_id ORDER BY id ASC';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['article_id' => $articleId]);
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getUsers(): array
{
    $pdo = connect();
    $sql = 'SELECT * FROM users ORDER BY created_at DESC';
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getUserById(int $id): ?array
{
    $pdo = connect();
    $sql = 'SELECT * FROM users WHERE id = :id LIMIT 1';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user !== false ? $user : null;
}

function updateUser(int $id, string $name, string $email, string $role, ?string $password = null): bool
{
    $pdo = connect();
    if ($password !== null && $password !== '') {
        $sql = 'UPDATE users SET name = :name, email = :email, role = :role, password = :password, updated_at = CURRENT_TIMESTAMP WHERE id = :id';
        $params = [
            'id' => $id,
            'name' => $name,
            'email' => $email,
            'role' => $role,
            'password' => $password
        ];
    } else {
        $sql = 'UPDATE users SET name = :name, email = :email, role = :role, updated_at = CURRENT_TIMESTAMP WHERE id = :id';
        $params = [
            'id' => $id,
            'name' => $name,
            'email' => $email,
            'role' => $role
        ];
    }
    $stmt = $pdo->prepare($sql);
    return $stmt->execute($params);
}
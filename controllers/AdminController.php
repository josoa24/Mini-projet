<?php
require_once __DIR__ . '/../models/functions/functions.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($uri === '/admin/authentify' && $_SERVER['REQUEST_METHOD'] === 'POST') {
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

if ($uri === '/admin/articles/create-form' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    if (empty($_SESSION['user'])) {
        header('Location: /admin/login?error=2');
        exit;
    }

    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';
    $status = $_POST['status'] ?? 'draft';
    $categoryId = isset($_POST['category_id']) ? (int)$_POST['category_id'] : 0;
    $metaDescription = $_POST['meta_description'] ?? null;
    $altText = $_POST['alt_text'] ?? null;

    $slug = strtolower($title);
    $slug = iconv('UTF-8', 'ASCII//TRANSLIT', $slug);
    $slug = preg_replace('~[^a-z0-9\s-]~', '', $slug);
    $slug = preg_replace('~\s+~', '-', $slug);
    $slug = preg_replace('~-+~', '-', $slug);
    $slug = trim($slug, '-');

    $imagePath = null;

    $userId = (int)($_SESSION['user']['id'] ?? 0);

    if ($title && $content && $categoryId > 0 && $userId > 0) {
        createArticle($title, $slug, $content, $imagePath, $status, $userId, $categoryId, $metaDescription, $altText);
        header('Location: /admin/articles?created=1');
        exit;
    } else {
        header('Location: /admin/articles/create?error=1');
        exit;
    }
}

if ($uri === '/admin/articles/edit-form' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    if (empty($_SESSION['user'])) {
        header('Location: /admin/login?error=2');
        exit;
    }

    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';
    $status = $_POST['status'] ?? 'draft';
    $categoryId = isset($_POST['category_id']) ? (int)$_POST['category_id'] : 0;
    $metaDescription = $_POST['meta_description'] ?? null;
    $altText = $_POST['alt_text'] ?? null;

    $slug = strtolower($title);
    $slug = iconv('UTF-8', 'ASCII//TRANSLIT', $slug);
    $slug = preg_replace('~[^a-z0-9\s-]~', '', $slug);
    $slug = preg_replace('~\s+~', '-', $slug);
    $slug = preg_replace('~-+~', '-', $slug);
    $slug = trim($slug, '-');

    $imagePath = null;

    if ($id > 0 && $title && $content && $categoryId > 0) {
        updateArticle($id, $title, $slug, $content, $imagePath, $status, $categoryId, $metaDescription, $altText);
        header('Location: /admin/articles?updated=1');
        exit;
    } else {
        header('Location: /admin/articles/edit?id=' . urlencode((string)$id) . '&error=1');
        exit;
    }
}

if ($uri === '/admin/articles/delete' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    if (empty($_SESSION['user'])) {
        header('Location: /admin/login?error=2');
        exit;
    }

    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

    if ($id > 0) {
        deleteArticle($id);
        header('Location: /admin/articles?deleted=1');
        exit;
    } else {
        header('Location: /admin/articles?error=1');
        exit;
    }
}

header('Location: /admin/login');
exit;
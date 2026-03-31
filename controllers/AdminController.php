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

    if (!empty($_FILES['image']['name'])) {
        $uploadDir = __DIR__ . '/../assets/images/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileTmp  = $_FILES['image']['tmp_name'];
        $fileName = basename($_FILES['image']['name']);

        $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];
        $maxSize = 5 * 1024 * 1024;

        if (in_array($ext, $allowed, true) && $_FILES['image']['size'] <= $maxSize) {
            $safeName = preg_replace('/[^a-zA-Z0-9-_\.]/', '-', pathinfo($fileName, PATHINFO_FILENAME));
            $finalName = $safeName . '-' . time() . '.webp';
            $dest = $uploadDir . $finalName;

            $img = null;

            if ($ext === 'jpg' || $ext === 'jpeg') {
                $img = imagecreatefromjpeg($fileTmp);
            } elseif ($ext === 'png') {
                $img = imagecreatefrompng($fileTmp);
                imagepalettetotruecolor($img);
                imagealphablending($img, true);
                imagesavealpha($img, true);
            } elseif ($ext === 'webp' && function_exists('imagecreatefromwebp')) {
                $img = imagecreatefromwebp($fileTmp);
            }

            if ($img) {
                imagewebp($img, $dest, 75); 
                imagedestroy($img);
                $imagePath = '/assets/images/' . $finalName;
            } else {
                if (move_uploaded_file($fileTmp, $dest)) {
                    $imagePath = '/assets/images/' . $finalName;
                }
            }
        }
    }

    $userId = (int)($_SESSION['user']['id'] ?? 0);

    if ($title && $content && $categoryId > 0 && $userId > 0) {
        try {
            createArticle($title, $slug, $content, $imagePath, $status, $userId, $categoryId, $metaDescription, $altText);
            header('Location: /admin/articles?created=1');
            exit;
        } catch (PDOException $e) {
            if ($e->getCode() === '23505') {
                header('Location: /admin/articles/create?error=slug');
                exit;
            } else {
                header('Location: /admin/articles/create?error=1');
                exit;
            }
        }
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

    $imagePath = $_POST['current_image'] ?? null;

    if (!empty($_FILES['image']['name'])) {
        $uploadDir = __DIR__ . '/../assets/images/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileTmp  = $_FILES['image']['tmp_name'];
        $fileName = basename($_FILES['image']['name']);

        $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];
        $maxSize = 5 * 1024 * 1024;

        if (in_array($ext, $allowed, true) && $_FILES['image']['size'] <= $maxSize) {
            $safeName = preg_replace('/[^a-zA-Z0-9-_\.]/', '-', pathinfo($fileName, PATHINFO_FILENAME));
            $finalName = $safeName . '-' . time() . '.' . $ext;
            $dest = $uploadDir . $finalName;

            if ($ext === 'jpg' || $ext === 'jpeg') {
                $img = imagecreatefromjpeg($fileTmp);
                if ($img) {
                    imagejpeg($img, $dest, 80);
                    imagedestroy($img);
                    $imagePath = '/assets/images/' . $finalName;
                }
            } elseif ($ext === 'png') {
                $img = imagecreatefrompng($fileTmp);
                if ($img) {
                    imagepng($img, $dest, 7);
                    imagedestroy($img);
                    $imagePath = '/assets/images/' . $finalName;
                }
            } elseif ($ext === 'webp') {
                if (function_exists('imagecreatefromwebp')) {
                    $img = imagecreatefromwebp($fileTmp);
                    if ($img) {
                        imagewebp($img, $dest, 80);
                        imagedestroy($img);
                        $imagePath = '/assets/images/' . $finalName;
                    }
                }
            } else {
                if (move_uploaded_file($fileTmp, $dest)) {
                    $imagePath = '/assets/images/' . $finalName;
                }
            }
        }
    }

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

if ($uri === '/admin/categories/edit-form' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    if (empty($_SESSION['user'])) {
        header('Location: /admin/login');
        exit;
    }

    $id    = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $title = trim($_POST['title'] ?? '');
    $slug  = trim($_POST['slug'] ?? '');

    if ($id <= 0 || $title === '' || $slug === '') {
        header('Location: /admin/categories/edit?id=' . urlencode($id) . '&error=1');
        exit;
    }

    if (updateCategory($id, $title, $slug)) {
        header('Location: /admin/categories?updated=1');
        exit;
    }

    header('Location: /admin/categories/edit?id=' . urlencode($id) . '&error=1');
    exit;
}

header('Location: /admin/login');
exit;
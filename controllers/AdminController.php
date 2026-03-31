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
    $uploadDir = __DIR__ . '/../assets/images/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $allowed = ['jpg', 'jpeg', 'png', 'webp'];
    $maxSize = 5 * 1024 * 1024;

    if (!empty($_FILES['image']['name'])) {
        $fileTmp  = $_FILES['image']['tmp_name'];
        $fileName = basename($_FILES['image']['name']);
        $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (in_array($ext, $allowed, true) && $_FILES['image']['size'] <= $maxSize) {
            $safeName = preg_replace('/[^a-zA-Z0-9-_\.]/', '-', pathinfo($fileName, PATHINFO_FILENAME));
            $finalName = $safeName . '-' . time() . '.webp';
            $dest = $uploadDir . $finalName;

            $img = null;
            if ($ext === 'jpg' || $ext === 'jpeg') { $img = imagecreatefromjpeg($fileTmp); }
            elseif ($ext === 'png') { $img = imagecreatefrompng($fileTmp); imagepalettetotruecolor($img); imagealphablending($img, true); imagesavealpha($img, true); }
            elseif ($ext === 'webp' && function_exists('imagecreatefromwebp')) { $img = imagecreatefromwebp($fileTmp); }

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
            $articleId = createArticle($title, $slug, $content, $imagePath, $status, $userId, $categoryId, $metaDescription, $altText);

            if (!empty($_FILES['extra_images']['name'][0]) && $articleId) {

                foreach ($_FILES['extra_images']['name'] as $key => $name) {
                    $extraTmp  = $_FILES['extra_images']['tmp_name'][$key];
                    $extraSize = $_FILES['extra_images']['size'][$key];
                    $extraExt  = strtolower(pathinfo($name, PATHINFO_EXTENSION));

                    if (in_array($extraExt, $allowed, true) && $extraSize <= $maxSize) {
                        $safeExtraName = preg_replace('/[^a-zA-Z0-9-_\.]/', '-', pathinfo($name, PATHINFO_FILENAME));
                        $finalExtraName = $safeExtraName . '-' . time() . '-' . $key . '.webp';
                        $destExtra = $uploadDir . $finalExtraName;

                        $extraImg = null;
                        if ($extraExt === 'jpg' || $extraExt === 'jpeg') { $extraImg = imagecreatefromjpeg($extraTmp); }
                        elseif ($extraExt === 'png') { $extraImg = imagecreatefrompng($extraTmp); imagepalettetotruecolor($extraImg); imagealphablending($extraImg, true); imagesavealpha($extraImg, true); }
                        elseif ($extraExt === 'webp' && function_exists('imagecreatefromwebp')) { $extraImg = imagecreatefromwebp($extraTmp); }

                        if ($extraImg) {
                            imagewebp($extraImg, $destExtra, 75);
                            imagedestroy($extraImg);
                            $extraPath = '/assets/images/' . $finalExtraName;

                            createImageArticle($articleId, $extraPath, $altText);
                        }
                    }
                }
            }

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

    $uploadDir = __DIR__ . '/../assets/images/';
    $allowed = ['jpg', 'jpeg', 'png', 'webp'];
    $maxSize = 5 * 1024 * 1024;

    if (!empty($_FILES['image']['name'])) {
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileTmp  = $_FILES['image']['tmp_name'];
        $fileName = basename($_FILES['image']['name']);
        $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (in_array($ext, $allowed, true) && $_FILES['image']['size'] <= $maxSize) {
            $safeName = preg_replace('/[^a-zA-Z0-9-_\.]/', '-', pathinfo($fileName, PATHINFO_FILENAME));
            $finalName = $safeName . '-' . time() . '.webp';
            $dest = $uploadDir . $finalName;

            $img = null;
            if ($ext === 'jpg' || $ext === 'jpeg') { $img = imagecreatefromjpeg($fileTmp); }
            elseif ($ext === 'png') { $img = imagecreatefrompng($fileTmp); imagepalettetotruecolor($img); imagealphablending($img, true); imagesavealpha($img, true); }
            elseif ($ext === 'webp' && function_exists('imagecreatefromwebp')) { $img = imagecreatefromwebp($fileTmp); }

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

    if ($id > 0 && $title && $content && $categoryId > 0) {
        updateArticle($id, $title, $slug, $content, $imagePath, $status, $categoryId, $metaDescription, $altText);

        if (!empty($_FILES['extra_images']['name'][0])) {
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            foreach ($_FILES['extra_images']['name'] as $key => $name) {
                $extraTmp  = $_FILES['extra_images']['tmp_name'][$key];
                if (empty($extraTmp)) {
                    continue;
                }

                $extraSize = $_FILES['extra_images']['size'][$key];
                $extraExt  = strtolower(pathinfo($name, PATHINFO_EXTENSION));

                if (in_array($extraExt, $allowed, true) && $extraSize <= $maxSize) {
                    $safeExtraName = preg_replace('/[^a-zA-Z0-9-_\.]/', '-', pathinfo($name, PATHINFO_FILENAME));
                    $finalExtraName = $safeExtraName . '-' . time() . '-' . $key . '.webp';
                    $destExtra = $uploadDir . $finalExtraName;

                    $extraImg = null;
                    if ($extraExt === 'jpg' || $extraExt === 'jpeg') { $extraImg = imagecreatefromjpeg($extraTmp); }
                    elseif ($extraExt === 'png') { $extraImg = imagecreatefrompng($extraTmp); imagepalettetotruecolor($extraImg); imagealphablending($extraImg, true); imagesavealpha($extraImg, true); }
                    elseif ($extraExt === 'webp' && function_exists('imagecreatefromwebp')) { $extraImg = imagecreatefromwebp($extraTmp); }

                    if ($extraImg) {
                        imagewebp($extraImg, $destExtra, 75);
                        imagedestroy($extraImg);
                        $extraPath = '/assets/images/' . $finalExtraName;

                        createImageArticle($id, $extraPath, $altText);
                    }
                }
            }
        }

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

if ($uri === '/admin/users/edit-form' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    if (empty($_SESSION['user'])) {
        header('Location: /admin/login?error=2');
        exit;
    }
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $role = $_POST['role'] ?? '';
    $password = $_POST['password'] ?? null;
    if ($id <= 0 || $name === '' || $email === '' || $role === '') {
        header('Location: /admin/users/edit?id=' . urlencode($id) . '&error=1');
        exit;
    }
    // Si le champ mot de passe est vide, ne pas le modifier
    $passwordToUpdate = ($password !== null && $password !== '') ? $password : null;
    if (updateUser($id, $name, $email, $role, $passwordToUpdate)) {
        header('Location: /admin/users?updated=1');
        exit;
    }
    header('Location: /admin/users/edit?id=' . urlencode($id) . '&error=1');
    exit;
}

header('Location: /admin/login');
exit;

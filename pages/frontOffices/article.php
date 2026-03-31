<?php
require_once __DIR__ . '/../../models/functions/functions.php';

$slug = isset($_GET['slug']) ? preg_replace('/[^a-z0-9\-]/', '', $_GET['slug']) : '';
$articles = getArticles(100, 0, '', '', $slug);
$article = null;
foreach ($articles as $a) {
    if ($a['slug'] === $slug) {
        $article = $a;
        break;
    }
}
if (!$article) {
    header('HTTP/1.1 404 Not Found');
    echo 'Article non trouvé';
    exit;
}
$canonical = 'https://example.com/article/' . $slug . '.html';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($article['title']) ?></title>
    <meta name="description" content="<?= htmlspecialchars($article['meta_description'] ?? $article['content']) ?>">
    <meta name="keywords" content="Iran, guerre, actualité, sanctions, diplomatie, conflit">
    <link rel="canonical" href="<?= htmlspecialchars($canonical) ?>">
    <link rel="stylesheet" href="/pages/frontOffices/styles.min.css">
</head>
<body>
    <header>
        <div class="header-container">
            <a href="/" class="logo">
                <div class="logo-icon">📰</div>
                <span>Mada actu</span>
            </a>
            <nav>
                <a href="/">Accueil</a>
                <a href="/articles">Actualités</a>
                <a href="/admin/login/" class="login-btn"><span class="login-icon"></span> Admin</a>
            </nav>
        </div>
    </header>

    <div class="page">
        <div class="breadcrumbs"><a href="/">Accueil</a> &rsaquo; <?= htmlspecialchars($article['title']) ?></div>
        <h1><?= htmlspecialchars($article['title']) ?></h1>
        <p class="meta">Publié le <?= htmlspecialchars(date('d/m/Y', strtotime($article['created_at']))) ?> par <?= htmlspecialchars($article['author_name'] ?? '---') ?> | Catégorie : <?= htmlspecialchars($article['category_title'] ?? '') ?></p>

        <?php if (!empty($article['image_path'])): ?>
            <img class="article-image" src="<?= htmlspecialchars($article['image_path']) ?>" alt="<?= htmlspecialchars($article['alt_text'] ?? $article['title']) ?>">
        <?php endif; ?>

        <section class="toc">
            <h2>Résumé</h2>
            <p><?= nl2br(htmlspecialchars($article['meta_description'] ?? '')) ?></p>
        </section>

        <section>
            <h2>Contenu</h2>
            <p><?= nl2br(htmlspecialchars($article['content'])) ?></p>
        </section>

        <a class="cta" href="/">Retour à l’accueil</a>

        <footer>
            <div class="page">
                <div class="footer-content">
                    <div class="footer-section">
                        <h4>Navigation</h4>
                        <ul>
                            <li><a href="/">Accueil</a></li>
                            <li><a href="/articles">Actualités</a></li>
                        </ul>
                    </div>
                    <div class="footer-section">
                        <h4>À propos</h4>
                        <ul>
                            <li><a href="#">Qui sommes-nous</a></li>
                            <li><a href="#">Politique éditoriale</a></li>
                            <li><a href="#">Conditions d'utilisation</a></li>
                            <li><a href="#">Politique de confidentialité</a></li>
                        </ul>
                    </div>
                    <div class="footer-section">
                        <h4>Ressources</h4>
                        <ul>
                            <li><a href="#">Actualités régionales</a></li>
                            <li><a href="#">Analyses géopolitiques</a></li>
                            <li><a href="#">Dernières dépêches</a></li>
                            <li><a href="#">Archive</a></li>
                        </ul>
                    </div>
                    <div class="footer-section">
                        <h4>Contact</h4>
                        <ul>
                            <li>📧 info@irannews.local</li>
                            <li>📱 +33 (0)1 XX XX XX XX</li>
                            <li>🏢 Paris, France</li>
                            <li><a href="#">Nous contacter</a></li>
                        </ul>
                    </div>
                </div>
                <div class="footer-bottom">
                    <p>&copy; 2026 <strong>Iran News</strong> - Site d'information statique FrontOffice</p>
                    <p>Développé avec <strong>PHP</strong> + <strong>PostgreSQL</strong> | Hébergé sur <strong>Docker</strong> | Optimisé SEO &amp; Accessibilité</p>
                    <p>Article informatif réalisé avec HTML sémantique et balises méta optimisées</p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>

<?php
require_once __DIR__ . '/../../models/functions/functions.php';

$uri = $_SERVER['REQUEST_URI'];
$matches = [];
if (preg_match('#/article/(\d+)-([a-z0-9\-]+)#', $uri, $matches)) {
    $articleId = (int)$matches[1];
    $articleSlug = $matches[2];
} else {
    http_response_code(404);
    exit('Article non trouvé');
}

$article = getArticleById($articleId);
if (!$article || $article['slug'] !== $articleSlug) {
    http_response_code(404);
    exit('Article non trouvé');
}

// RECUPERATION DES IMAGES SUPPLÉMENTAIRES
$extraImages = getArticleImages($articleId);

$canonical = 'https://example.com/article/' . $article['id'] . '-' . $article['slug'];

$dbCategories = getCategories(); 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($article['title']) ?></title>
    <meta name="description" content="<?= htmlspecialchars($article['meta_description'] ?? '') ?>">
    <meta name="keywords" content="Iran, guerre, actualité, <?= htmlspecialchars($article['slug']) ?>">
    <link rel="canonical" href="<?= htmlspecialchars($canonical) ?>">
    <link rel="stylesheet" href="/pages/frontOffices/styles.css">
    
    <style>
        .article-gallery {
            margin: 2.5rem 0;
            padding-top: 1.5rem;
            border-top: 1px solid #eee;
        }
        .gallery-title {
            font-size: 1.3rem;
            margin-bottom: 1rem;
            color: #111;
        }
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1rem;
        }
        .gallery-item {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            height: 150px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            transition: transform 0.2s ease;
        }
        .gallery-item:hover {
            transform: scale(1.02);
            cursor: pointer;
        }
        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        @media (max-width: 600px) {
            .gallery-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="header-container">
            <a href="/" class="logo">
                <div class="logo-icon">📰</div>
                <span>Iran News</span>
            </a>
            <nav>
                <a href="/">Accueil</a>
                
                <?php foreach ($dbCategories as $cat): ?>
                    <?php 
                        $slug = htmlspecialchars($cat['slug']);
                        $isActive = ($article['category_slug'] === $cat['slug']);
                    ?>
                    <a href="/?category=<?= urlencode($slug) ?>" class="<?= $isActive ? 'active' : '' ?>">
                        <?= htmlspecialchars($cat['title']) ?>
                    </a>
                <?php endforeach; ?>
            </nav>
        </div>
    </header>

    <div class="page">
        <div class="breadcrumbs">
            <a href="/">Accueil</a> &rsaquo; 
            <a href="/?category=<?= urlencode($article['category_slug']) ?>"><?= htmlspecialchars($article['category_title'] ?? 'Sans catégorie') ?></a> &rsaquo; 
            <?= htmlspecialchars($article['title']) ?>
        </div>

        <h1><?= htmlspecialchars($article['title']) ?></h1>

        <div class="article-meta">
            <div class="meta">
                <strong>Par <?= htmlspecialchars($article['author_name'] ?? 'Anonyme') ?></strong>
                <?php if (!empty($article['created_at'])): ?> 
                    | Publié le <?= date('d/m/Y', strtotime($article['created_at'])) ?>
                <?php endif; ?>
            </div>
            <p class="article-description"><em><?= htmlspecialchars($article['meta_description'] ?? '') ?></em></p>
        </div>

        <?php if (!empty($article['image_path'])): ?>
            <img class="article-image" src="<?= htmlspecialchars($article['image_path']) ?>" alt="<?= htmlspecialchars($article['alt_text'] ?? $article['title']) ?>" loading="eager">
        <?php endif; ?>

        <div class="article-content">
            <?= nl2br(htmlspecialchars($article['content'])) ?>
        </div>

        <?php if (!empty($extraImages)): ?>
            <div class="article-gallery">
                <h3 class="gallery-title">En images</h3>
                <div class="gallery-grid">
                    <?php foreach ($extraImages as $img): ?>
                        <div class="gallery-item">
                            <img src="<?= htmlspecialchars($img['image_path']) ?>" 
                                 alt="<?= htmlspecialchars($img['alt_text'] ?? $article['title']) ?>" 
                                 loading="lazy">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="article-actions">
            <a class="cta" href="/">← Retour à l'accueil</a>
        </div>

        <footer>
            <div class="page">
                <div class="footer-content">
                    <div class="footer-section">
                        <h4>Navigation</h4>
                        <ul>
                            <li><a href="/">Accueil</a></li>
                            <?php foreach ($dbCategories as $cat): ?>
                                <li>
                                    <a href="/?category=<?= urlencode($cat['slug']) ?>">
                                        <?= htmlspecialchars($cat['title']) ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
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
                            <li>📧 iranwarinfo@gmail.com</li>
                            <li>📱 335462338</li>
                            <li>🏢 Antananarivo, Madagascar</li>
                            <li><a href="#">Nous contacter</a></li>
                        </ul>
                    </div>
                </div>
                <div class="footer-bottom">
                    <p>&copy; 2026 <strong>Iran News</strong> - Site d'information FrontOffice</p>
                    <p>Développé avec <strong>PHP</strong> + <strong>PostgreSQL</strong> | Hébergé sur <strong>Docker</strong> | Optimisé SEO &amp; Accessibilité</p>
                    <p>Article informatif réalisé avec HTML sémantique et balises méta optimisées</p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
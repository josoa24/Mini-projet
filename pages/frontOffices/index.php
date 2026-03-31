<?php
require_once __DIR__ . '/../../models/functions/functions.php';

$title = "Guerre en Iran : actualités et analyses";
$description = "Site d'information dédié à la guerre en Iran : dernières nouvelles, analyses géopolitiques et impacts régionaux.";
$canonical = "https://example.com/";
$updated = date('d/m/Y');

$dbCategories = getCategories(); 

$selectedCategorySlug = isset($_GET['category']) ? $_GET['category'] : '';

$articlesPerPage = 6;
$currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($currentPage - 1) * $articlesPerPage;

$allArticles = getArticles(1000, 0, 'published', $selectedCategorySlug, '');

$filteredArticles = $allArticles;
$totalArticles = count($filteredArticles);
$totalPages = ceil($totalArticles / $articlesPerPage);
$currentPage = min($currentPage, $totalPages > 0 ? $totalPages : 1);
$startIndex = ($currentPage - 1) * $articlesPerPage;

$pageArticles = array_slice($filteredArticles, $startIndex, $articlesPerPage);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?></title>
    <meta name="description" content="<?= htmlspecialchars($description) ?>">
    <meta name="keywords" content="guerre en Iran, actualités Iran, conflit Iran, géopolitique, sanctions Iran">
    <meta name="author" content="Mini Projet - FrontOffice">
    <link rel="canonical" href="<?= htmlspecialchars($canonical) ?>">
    <link rel="stylesheet" href="/pages/frontOffices/styles.css">
</head>
<body>
    <header>
        <div class="header-container">
            <a href="/" class="logo">
                <div class="logo-icon">📰</div>
                <span>Iran News</span>
            </a>
            <nav>
                <a href="/" class="<?= ($selectedCategorySlug === '') ? 'active' : '' ?>">Accueil</a>
                
                <?php foreach ($dbCategories as $cat): ?>
                    <?php 
                        $slug = htmlspecialchars($cat['slug']);
                        $isActive = ($selectedCategorySlug === $cat['slug']);
                    ?>
                    <a href="/?category=<?= urlencode($slug) ?>" class="<?= $isActive ? 'active' : '' ?>">
                        <?= htmlspecialchars($cat['title']) ?>
                    </a>
                <?php endforeach; ?>
            </nav>
        </div>
    </header>

    <div class="page">
        <p class="meta">Dernière mise à jour : <?= htmlspecialchars($updated) ?></p>
        <h1>Guerre en Iran : actualités, enjeux et analyses</h1>

        <section class="hero">
            <h2>Information claire et structurée sur le conflit en Iran</h2>
            <p>Ce site présente les dernières données accessibles et des analyses sur la guerre en Iran, en appliquant les bonnes pratiques SEO et l'accessibilité.</p>
        </section>

        <section>
            <h2>Dernières actualités</h2>
            <div class="articles-info">
                <?php if ($totalArticles > 0): ?>
                    <p class="articles-count">Affichage <?= $startIndex + 1 ?> à <?= min($startIndex + $articlesPerPage, $totalArticles) ?> sur <?= $totalArticles ?> articles</p>
                <?php else: ?>
                    <p class="articles-count">Aucun article trouvé dans cette catégorie.</p>
                <?php endif; ?>
            </div>
            
            <div class="cards">
                <?php foreach ($pageArticles as $article): ?>
                    <article class="card">
                        <?php if (!empty($article['image_path'])): ?>
                            <img src="<?= htmlspecialchars($article['image_path']) ?>" alt="<?= htmlspecialchars($article['alt_text'] ?? $article['title']) ?>" loading="lazy" />
                        <?php endif; ?>
                        <div class="card-content">
                            <div class="card-meta">
                                <span class="card-category">
                                    <svg width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path d="M2 2h12v2H2V2zm0 3h12v2H2V5zm0 3h12v2H2V8zm0 3h12v2H2v-2z"/></svg> 
                                    <?= htmlspecialchars($article['category_title'] ?? 'Sans catégorie') ?>
                                </span>
                                <span class="card-status">
                                    <svg width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><circle cx="8" cy="8" r="6" stroke="currentColor" stroke-width="2" fill="none"/></svg> 
                                    <?= htmlspecialchars($article['status'] ?? '') ?>
                                </span>
                            </div>
                            <h3><?= htmlspecialchars($article['title']) ?></h3>
                            <p class="article-date">
                                <svg width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 3v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1zm2 2a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8A.5.5 0 0 1 3 5zm0 2a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8A.5.5 0 0 1 3 7zm0 2a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8A.5.5 0 0 1 3 9zm0 2a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5z"/></svg> 
                                <?= isset($article['created_at']) ? date('d/m/Y', strtotime($article['created_at'])) : '' ?>
                            </p>
                            <p><?= htmlspecialchars($article['meta_description'] ?? 'Pas de description disponible.') ?></p>
                            <a href="/article/<?= htmlspecialchars($article['id']) ?>-<?= htmlspecialchars($article['slug']) ?>">Lire l'article</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

            <?php if ($totalPages > 1): ?>
                <nav class="pagination" aria-label="Pagination des articles">
                    <?php if ($currentPage > 1): ?>
                        <a href="/?page=1<?= ($selectedCategorySlug !== '') ? '&category=' . urlencode($selectedCategorySlug) : '' ?>" class="pagination-link pagination-first" title="Première page">✓ Première</a>
                        <a href="/?page=<?= $currentPage - 1 ?><?= ($selectedCategorySlug !== '') ? '&category=' . urlencode($selectedCategorySlug) : '' ?>" class="pagination-link pagination-prev" title="Page précédente">← Précédent</a>
                    <?php else: ?>
                        <span class="pagination-link pagination-disabled">✓ Première</span>
                        <span class="pagination-link pagination-disabled">← Précédent</span>
                    <?php endif; ?>
                    
                    <div class="pagination-numbers">
                        <?php for ($p = 1; $p <= $totalPages; $p++): ?>
                            <?php if ($p === $currentPage): ?>
                                <span class="pagination-current" aria-current="page"><?= $p ?></span>
                            <?php else: ?>
                                <a href="/?page=<?= $p ?><?= ($selectedCategorySlug !== '') ? '&category=' . urlencode($selectedCategorySlug) : '' ?>" class="pagination-number"><?= $p ?></a>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                    
                    <?php if ($currentPage < $totalPages): ?>
                        <a href="/?page=<?= $currentPage + 1 ?><?= ($selectedCategorySlug !== '') ? '&category=' . urlencode($selectedCategorySlug) : '' ?>" class="pagination-link pagination-next" title="Page suivante">Suivant →</a>
                        <a href="/?page=<?= $totalPages ?><?= ($selectedCategorySlug !== '') ? '&category=' . urlencode($selectedCategorySlug) : '' ?>" class="pagination-link pagination-last" title="Dernière page">Dernière ✓</a>
                    <?php else: ?>
                        <span class="pagination-link pagination-disabled">Suivant →</span>
                        <span class="pagination-link pagination-disabled">Dernière ✓</span>
                    <?php endif; ?>
                </nav>
            <?php endif; ?>
        </section>

        <section>
            <h2>Contexte et enjeux</h2>
            <h3>Origines du conflit</h3>
            <p>Le conflit en Iran est marqué par de forts enjeux géopolitiques, y compris l'équilibre régional, l'énergie et les alliances internationales.</p>
            <h3>Impact humain</h3>
            <p>La guerre a des conséquences majeures sur les populations civiles et la stabilité des pays voisins.</p>
        </section>

        <footer>
            <div class="page">
                <div class="footer-content">
                    <div class="footer-section">
                        <h4>Navigation</h4>
                        <ul>
                            <li><a href="/" class="<?= ($selectedCategorySlug === '') ? 'active' : '' ?>">Accueil</a></li>
                            <?php foreach ($dbCategories as $cat): ?>
                                <?php 
                                    $slug = htmlspecialchars($cat['slug']);
                                    $isActive = ($selectedCategorySlug === $cat['slug']);
                                ?>
                                <li><a href="/?category=<?= urlencode($slug) ?>" class="<?= $isActive ? 'active' : '' ?>"><?= htmlspecialchars($cat['title']) ?></a></li>
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
                    <p>&copy; 2026 <strong>Iran News</strong> - Site d'information statique FrontOffice</p>
                    <p>Développé avec <strong>PHP</strong> + <strong>PostgreSQL</strong> | Hébergé sur <strong>Docker</strong> | Optimisé SEO &amp; Accessibilité</p>
                    <p>Dernière mise à jour : <?= htmlspecialchars($updated) ?></p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
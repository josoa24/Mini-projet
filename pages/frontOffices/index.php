<?php
$title = "Guerre en Iran : actualités et analyses";
$description = "Site d'information dédié à la guerre en Iran : dernières nouvelles, analyses géopolitiques et impacts régionaux.";
$canonical = "https://example.com/";
$updated = date('d/m/Y');

// Articles listés statiquement
$allArticles = [
    ['slug' => 'tensions-militaires', 'title' => 'Tensions militaires accrues à la frontière iranienne', 'desc' => 'Les forces iraniennes se préparent à des incidents potentiels après plusieurs frappes signalées.', 'image' => 'https://picsum.photos/600x380?random=1', 'alt' => 'Soldats iraniens et forces militaires', 'date' => '30 mars 2026'],
    ['slug' => 'sanctions-economiques', 'title' => 'Sanctions économiques et impact sur l\'Iran', 'desc' => 'Les nouvelles sanctions internationales renforcent la pression financière sur l\'économie iranienne.', 'image' => 'https://picsum.photos/600x380?random=2', 'alt' => 'Graphique des sanctions économiques', 'date' => '28 mars 2026'],
    ['slug' => 'reactions-internationales', 'title' => 'Réactions internationales au conflit iranien', 'desc' => 'Les pays clés appellent à un cessez-le-feu tout en cherchant des solutions diplomatiques.', 'image' => 'https://picsum.photos/600x380?random=3', 'alt' => 'Drapeaux des nations membres du conseil', 'date' => '27 mars 2026'],
    ['slug' => 'impacts-civils', 'title' => 'Impacts humanitaires et civils du conflit', 'desc' => 'Les civils iraniens subissent les conséquences directes de la situation militaire et économique.', 'image' => 'https://picsum.photos/600x380?random=4', 'alt' => 'Population civile iranienne', 'date' => '26 mars 2026'],
    ['slug' => 'routes-commerciales', 'title' => 'Impact sur les routes commerciales du Golfe', 'desc' => 'Le conflit perturbe gravement les échanges commerciaux et les prix de l\'énergie mondiale.', 'image' => 'https://picsum.photos/600x380?random=5', 'alt' => 'Navires commerciaux Golfe Persique', 'date' => '25 mars 2026'],
    ['slug' => 'refugies-exodes', 'title' => 'Crises des réfugiés et exodes massifs', 'desc' => 'Les mouvements de population augmentent vers les pays voisins à cause de l\'instabilité.', 'image' => 'https://picsum.photos/600x380?random=6', 'alt' => 'Camps de réfugiés', 'date' => '24 mars 2026'],
    ['slug' => 'cyberattaques-technologie', 'title' => 'Cyberattaques et guerre technologique', 'desc' => 'Le conflit s\'étend vers le cyberespace avec des attaques contre infrastructures critiques.', 'image' => 'https://picsum.photos/600x380?random=7', 'alt' => 'Cybersécurité et technologie', 'date' => '23 mars 2026'],
    ['slug' => 'medias-propaganda', 'title' => 'Médias, propagande et désinformation', 'desc' => 'Les campagnes de désinformation se multiplient et affectent l\'opinion publique mondiale.', 'image' => 'https://picsum.photos/600x380?random=8', 'alt' => 'Médias et communication', 'date' => '22 mars 2026'],
    ['slug' => 'armes-arsenaux', 'title' => 'Arsenal militaire et capacités de défense', 'desc' => 'Analyse détaillée des armements et des stratégies militaires des puissances impliquées.', 'image' => 'https://picsum.photos/600x380?random=9', 'alt' => 'Équipements militaires modernes', 'date' => '21 mars 2026'],
    ['slug' => 'futur-previsions', 'title' => 'Prévisions et scénarios pour l\'avenir', 'desc' => 'Les experts discutent des possibles issues du conflit et de ses conséquences long terme.', 'image' => 'https://picsum.photos/600x380?random=10', 'alt' => 'Analyse prédictive géopolitique', 'date' => '20 mars 2026'],
];

// Pagination
$articlesPerPage = 6;
$currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$totalArticles = count($allArticles);
$totalPages = ceil($totalArticles / $articlesPerPage);
$currentPage = min($currentPage, $totalPages);

$startIndex = ($currentPage - 1) * $articlesPerPage;
$pageArticles = array_slice($allArticles, $startIndex, $articlesPerPage);
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
                <a href="/">Accueil</a>
                <a href="/article/tensions-militaires.html">Tensions militaires</a>
                <a href="/article/sanctions-economiques.html">Sanctions économiques</a>
                <a href="/article/reactions-internationales.html">Réactions internationales</a>
                <a href="/admin/login/" class="login-btn"><span class="login-icon"></span> Admin</a>
            </nav>
        </div>
    </header>

    <div class="page">
        <p class="meta">Dernière mise à jour : <?= htmlspecialchars($updated) ?></p>
        <h1>Guerre en Iran : actualités, enjeux et analyses</h1>

        <section class="hero">
            <h2>Information claire et structurée sur le conflit en Iran</h2>
            <p>Ce site statique présente les dernières données accessibles et des analyses sur la guerre en Iran, en appliquant les bonnes pratiques SEO et l'accessibilité.</p>
        </section>

        <section>
            <h2>Dernières actualités</h2>
            <div class="articles-info">
                <p class="articles-count">Affichage <?= $startIndex + 1 ?> à <?= min($startIndex + $articlesPerPage, $totalArticles) ?> sur <?= $totalArticles ?> articles</p>
            </div>
            <div class="cards">
                <?php foreach ($pageArticles as $article): ?>
                    <article class="card">
                        <img src="<?= htmlspecialchars($article['image']) ?>" alt="<?= htmlspecialchars($article['alt']) ?>" loading="lazy" />
                        <div class="card-content">
                            <h3><?= htmlspecialchars($article['title']) ?></h3>
                            <p class="article-date">📅 <?= htmlspecialchars($article['date']) ?></p>
                            <p><?= htmlspecialchars($article['desc']) ?></p>
                            <a href="/article/<?= htmlspecialchars($article['slug']) ?>.html">Lire l'article</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

            <?php if ($totalPages > 1): ?>
                <nav class="pagination" aria-label="Pagination des articles">
                    <?php if ($currentPage > 1): ?>
                        <a href="/?page=1" class="pagination-link pagination-first" title="Première page">✓ Première</a>
                        <a href="/?page=<?= $currentPage - 1 ?>" class="pagination-link pagination-prev" title="Page précédente">← Précédent</a>
                    <?php else: ?>
                        <span class="pagination-link pagination-disabled">✓ Première</span>
                        <span class="pagination-link pagination-disabled">← Précédent</span>
                    <?php endif; ?>

                    <div class="pagination-numbers">
                        <?php for ($p = 1; $p <= $totalPages; $p++): ?>
                            <?php if ($p === $currentPage): ?>
                                <span class="pagination-current" aria-current="page"><?= $p ?></span>
                            <?php else: ?>
                                <a href="/?page=<?= $p ?>" class="pagination-number"><?= $p ?></a>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>

                    <?php if ($currentPage < $totalPages): ?>
                        <a href="/?page=<?= $currentPage + 1 ?>" class="pagination-link pagination-next" title="Page suivante">Suivant →</a>
                        <a href="/?page=<?= $totalPages ?>" class="pagination-link pagination-last" title="Dernière page">Dernière ✓</a>
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
                            <li><a href="/">Accueil</a></li>
                            <li><a href="/article/tensions-militaires.html">Tensions militaires</a></li>
                            <li><a href="/article/sanctions-economiques.html">Sanctions économiques</a></li>
                            <li><a href="/article/reactions-internationales.html">Réactions internationales</a></li>
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
                    <p>Dernière mise à jour : <?= htmlspecialchars($updated) ?></p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>

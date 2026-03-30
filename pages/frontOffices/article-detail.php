<?php
$slug = isset($_GET['slug']) ? preg_replace('/[^a-z0-9\-]/', '', $_GET['slug']) : '';

$articles = [
    'tensions-militaires' => [
        'title' => 'Tensions militaires accrues à la frontière iranienne',
        'description' => 'Analyse détaillée des tensions militaires et mouvements des troupes autour de l\'Iran.',
        'image' => 'https://picsum.photos/900/500?random=1',
        'alt' => 'Soldats et blindés à la frontière iranienne',
        'author' => 'Correspondant Moyen-Orient',
        'date' => '30 mars 2026',
        'readTime' => '8 min',
        'keyword' => 'tensions-militaires',
        'sections' => [
            ['heading' => 'Situation sur le terrain', 'text' => 'Les forces iraniennes ont augmenté leurs patrouilles. Des renforts militaires déployés.', 'image' => 'https://picsum.photos/700/400?random=5', 'imageAlt' => 'Patrouilles militaires'],
            ['heading' => 'Mobilisation des effectifs', 'text' => 'Alertes de niveau élevé émises. Unités de chars repositionnées.', 'image' => 'https://picsum.photos/700/400?random=6', 'imageAlt' => 'Blindés militaires'],
            ['heading' => 'Pistes diplomatiques', 'text' => 'Appels à la désescalade. Pourparlers en cours.', 'image' => 'https://picsum.photos/700/400?random=7', 'imageAlt' => 'Diplomatie'],
            ['heading' => 'Implications régionales', 'text' => 'Routes commerciales affectées. Prices de l\'énergie fluctuent.', 'image' => 'https://picsum.photos/700/400?random=8', 'imageAlt' => 'Golfe Persique'],
        ],
    ],
    'sanctions-economiques' => [
        'title' => 'Sanctions économiques et impact sur l\'Iran',
        'description' => 'Analyse des sanctions et conséquences sur le marché iranien.',
        'image' => 'https://picsum.photos/900/500?random=9',
        'alt' => 'Sanctions économiques',
        'author' => 'Analyste Économique International',
        'date' => '28 mars 2026',
        'readTime' => '10 min',
        'keyword' => 'sanctions-economiques',
        'sections' => [
            ['heading' => 'Mesures restrictives', 'text' => 'Sanctions sur énergie, acier, télécommunications.', 'image' => 'https://picsum.photos/700/400?random=10', 'imageAlt' => 'Restrictions économiques'],
            ['heading' => 'Marché et inflation', 'text' => 'Inflation dépasse 40% annuellement.', 'image' => 'https://picsum.photos/700/400?random=11', 'imageAlt' => 'Inflation'],
            ['heading' => 'Impact emploi', 'text' => 'PME réduisent effectifs. Secteur tourisme en crise.', 'image' => 'https://picsum.photos/700/400?random=12', 'imageAlt' => 'Chômage'],
            ['heading' => 'Plan autonomie', 'text' => 'Gouvernement met en place plan économique alternatif.', 'image' => 'https://picsum.photos/700/400?random=13', 'imageAlt' => 'Plans alternatifs'],
        ],
    ],
    'reactions-internationales' => [
        'title' => 'Réactions internationales au conflit iranien',
        'description' => 'Positions diplomatiques des acteurs mondiaux face au conflit.',
        'image' => 'https://picsum.photos/900/500?random=14',
        'alt' => 'Diplomatie internationale',
        'author' => 'Correspondant Politique Internationale',
        'date' => '27 mars 2026',
        'readTime' => '7 min',
        'keyword' => 'reactions-internationales',
        'sections' => [
            ['heading' => 'Positions occidentales', 'text' => 'USA et UE appelent respect du droit international.', 'image' => 'https://picsum.photos/700/400?random=15', 'imageAlt' => 'Diplomatie USA UE'],
            ['heading' => 'Appels cessez-le-feu', 'text' => 'ONU demande cessez-le-feu immédiat.', 'image' => 'https://picsum.photos/700/400?random=16', 'imageAlt' => 'ONU'],
            ['heading' => 'Engagement régional', 'text' => 'Pays du Golfe cherchent stabiliser région.', 'image' => 'https://picsum.photos/700/400?random=17', 'imageAlt' => 'Golfe'],
            ['heading' => 'Conséquences diplomatiques', 'text' => 'Relations internationales se refroidissent.', 'image' => 'https://picsum.photos/700/400?random=18', 'imageAlt' => 'Diplomatie'],
        ],
    ],
];

if (!isset($articles[$slug])) {
    header('HTTP/1.1 404 Not Found');
    $slug = 'tensions-militaires';
}

$article = $articles[$slug];
$canonical = 'https://example.com/article/' . $slug . '.html';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($article['title']) ?></title>
    <meta name="description" content="<?= htmlspecialchars($article['description']) ?>">
    <meta name="keywords" content="Iran, guerre, actualité, <?= htmlspecialchars($article['keyword']) ?>">
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
        <div class="breadcrumbs"><a href="/">Accueil</a> &rsaquo; <?= htmlspecialchars($article['title']) ?></div>
        <h1><?= htmlspecialchars($article['title']) ?></h1>
        
        <div class="article-meta">
            <p class="meta">
                <strong><?= htmlspecialchars($article['author']) ?></strong> | 
                <?= htmlspecialchars($article['date']) ?> | 
                Temps de lecture: <?= htmlspecialchars($article['readTime']) ?>
            </p>
            <p class="article-description"><?= htmlspecialchars($article['description']) ?></p>
        </div>

        <img class="article-image" src="<?= htmlspecialchars($article['image']) ?>" alt="<?= htmlspecialchars($article['alt']) ?>" loading="eager">

        <section class="article-toc">
            <h2>Sommaire</h2>
            <ul>
                <?php foreach ($article['sections'] as $section): ?>
                    <li><?= htmlspecialchars($section['heading']) ?></li>
                <?php endforeach; ?>
            </ul>
        </section>

        <?php foreach ($article['sections'] as $section): ?>
            <section class="article-section">
                <h2><?= htmlspecialchars($section['heading']) ?></h2>
                <p><?= htmlspecialchars($section['text']) ?></p>
                
                <?php if (isset($section['image'])): ?>
                    <figure class="article-figure">
                        <img src="<?= htmlspecialchars($section['image']) ?>" alt="<?= htmlspecialchars($section['imageAlt']) ?>" loading="lazy">
                        <figcaption><?= htmlspecialchars($section['imageAlt']) ?></figcaption>
                    </figure>
                <?php endif; ?>
            </section>
        <?php endforeach; ?>

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
                    <p>Article informatif réalisé avec HTML sémantique et balises méta optimisées</p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>

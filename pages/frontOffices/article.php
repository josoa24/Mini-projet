<?php
$slug = isset($_GET['slug']) ? preg_replace('/[^a-z0-9\-]/', '', $_GET['slug']) : '';
$articles = [
    'tensions-militaires' => [
        'title' => 'Tensions militaires accrues à la frontière iranienne',
        'description' => 'Analyse des tensions militaires et des mouvements des troupes autour de l’Iran.',
        'image' => 'https://via.placeholder.com/900x500?text=Tensions+militaires',
        'alt' => 'Soldats et blindés près de la frontière iranienne',
        'content' => [
            [
                'heading' => 'Situation sur le terrain',
                'text' => 'Les forces iraniennes se préparent à des incidents potentiels après plusieurs frappes signalées dans les zones frontalières.',
            ],
            [
                'heading' => 'Pistes diplomatiques',
                'text' => 'Les pays voisins appellent à la désescalade, tandis que les responsables iraniens maintiennent leur position de défense nationale.',
            ],
        ],
    ],
    'sanctions-economiques' => [
        'title' => 'Sanctions économiques et impact sur l’Iran',
        'description' => 'Retour sur les sanctions récentes et leurs effets sur l’économie iranienne.',
        'image' => 'https://via.placeholder.com/900x500?text=Sanctions+economiques',
        'alt' => 'Graphique représentant les sanctions économiques',
        'content' => [
            [
                'heading' => 'Marché et inflation',
                'text' => 'Les nouvelles mesures restrictives aggravent l’inflation et pénalisent l’accès aux biens essentiels.',
            ],
            [
                'heading' => 'Réponse des autorités',
                'text' => 'Le gouvernement iranien cherche des alternatives économiques pour limiter l’impact des sanctions.',
            ],
        ],
    ],
    'reactions-internationales' => [
        'title' => 'Réactions internationales au conflit iranien',
        'description' => 'Synthèse des réactions diplomatiques et des positions des principaux acteurs mondiaux.',
        'image' => 'https://via.placeholder.com/900x500?text=Reactions+internationales',
        'alt' => 'Drapeaux de plusieurs nations du conseil de sécurité',
        'content' => [
            [
                'heading' => 'Appels à un cessez-le-feu',
                'text' => 'Plusieurs nations exigent une désescalade immédiate et la reprise du dialogue politique.',
            ],
            [
                'heading' => 'Conséquences diplomatiques',
                'text' => 'Les relations internationales avec l’Iran sont de plus en plus tendues, en particulier dans le Golfe.',
            ],
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
    <meta name="keywords" content="Iran, guerre, actualité, sanctions, diplomatie, conflit">
    <link rel="canonical" href="<?= htmlspecialchars($canonical) ?>">
    <link rel="stylesheet" href="/pages/frontOffices/styles.css">
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
        <p class="meta">Article statique FrontOffice sur la guerre en Iran</p>

        <img class="article-image" src="<?= htmlspecialchars($article['image']) ?>" alt="<?= htmlspecialchars($article['alt']) ?>">

        <section class="toc">
            <h2>Sommaire</h2>
            <ul>
                <?php foreach ($article['content'] as $block): ?>
                    <li><?= htmlspecialchars($block['heading']) ?></li>
                <?php endforeach; ?>
            </ul>
        </section>

        <?php foreach ($article['content'] as $block): ?>
            <section>
                <h2><?= htmlspecialchars($block['heading']) ?></h2>
                <p><?= htmlspecialchars($block['text']) ?></p>
            </section>
        <?php endforeach; ?>

        <a class="cta" href="/">Retour à l’accueil</a>

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

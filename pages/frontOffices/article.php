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
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #f7f7f7; color: #222; }
        .page { max-width: 960px; margin: 0 auto; padding: 18px; background: #fff; }
        header, footer { padding: 14px 0; }
        h1 { font-size: 2rem; margin: 0 0 10px; }
        .breadcrumbs a { color: #0056b3; text-decoration: none; }
        .breadcrumbs a:hover { text-decoration: underline; }
        .article-image { width: 100%; max-height: 420px; object-fit: cover; border-radius: 8px; margin: 18px 0; }
        section { margin-bottom: 22px; }
        h2 { color: #0f2d5c; }
        .meta { color: #555; font-size: 0.95rem; }
        .toc { background: #eef4ff; padding: 12px; border-left: 4px solid #0056b3; margin: 16px 0; }
        .toc ul { margin: 0; padding-left: 1.25rem; }
        a.cta { display: inline-block; margin-top: 16px; padding: 10px 16px; background: #0056b3; color: #fff; text-decoration: none; border-radius: 4px; }
        a.cta:hover { background: #003f8a; }
        @media (max-width: 720px) { .page { padding: 14px; } }
    </style>
</head>
<body>
    <div class="page">
        <header>
            <div class="breadcrumbs"><a href="/">Accueil</a> &rsaquo; <?= htmlspecialchars($article['title']) ?></div>
            <h1><?= htmlspecialchars($article['title']) ?></h1>
            <p class="meta">Article statique FrontOffice sur la guerre en Iran</p>
        </header>

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
            <p>Page FrontOffice statique réalisée dans <strong>pages/frontOffices</strong> avec une structure SEO et des balises sémantiques correctes.</p>
        </footer>
    </div>
</body>
</html>

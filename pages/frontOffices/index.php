<?php
$title = "Guerre en Iran : actualités et analyses";
$description = "Site d'information dédié à la guerre en Iran : dernières nouvelles, analyses géopolitiques et impacts régionaux.";
$canonical = "https://example.com/";
$updated = date('d/m/Y');
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
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; margin: 0; padding: 0; color: #111; background: #f5f5f5; }
        .page { max-width: 1024px; margin: 0 auto; padding: 18px; background: #fff; }
        header, footer { padding: 14px 0; }
        header h1 { font-size: 2.2rem; margin: 0 0 8px; }
        .meta { color: #555; font-size: 0.95rem; }
        nav a { color: #0056b3; text-decoration: none; margin-right: 20px; }
        nav a:hover { text-decoration: underline; }
        .hero { margin: 24px 0; padding: 20px; background: #e7f0ff; border-left: 4px solid #0056b3; }
        .cards { display: grid; gap: 16px; margin: 24px 0; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); }
        .card { background: #fff; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; box-shadow: 0 1px 6px rgba(0,0,0,.08); }
        .card img { width: 100%; height: 190px; object-fit: cover; }
        .card-content { padding: 16px; }
        .card-content h3 { margin-top: 0; }
        .card-content p { margin: 0.75rem 0; }
        .card-content a { color: #0056b3; text-decoration: none; font-weight: bold; }
        .card-content a:hover { text-decoration: underline; }
        section { margin-bottom: 24px; }
        h2, h3 { color: #222; }
        .list { margin: 0; padding: 0 0 0 1.25rem; }
        .highlight { color: #c00; font-weight: bold; }
        footer { border-top: 1px solid #ddd; font-size: 0.9rem; color: #444; }
        @media (max-width: 640px) { .page { padding: 14px; } }
    </style>
</head>
<body>
    <div class="page">
        <header>
            <p class="meta">Dernière mise à jour : <?= htmlspecialchars($updated) ?></p>
            <h1>Guerre en Iran : actualités, enjeux et analyses</h1>
            <nav>
                <a href="/">Accueil</a>
                <a href="/article/tensions-militaires.html">Tensions militaires</a>
                <a href="/article/sanctions-economiques.html">Sanctions économiques</a>
                <a href="/article/reactions-internationales.html">Réactions internationales</a>
            </nav>
        </header>

        <section class="hero">
            <h2>Information claire et structurée sur le conflit en Iran</h2>
            <p>Ce site statique présente les dernières données accessibles et des analyses sur la guerre en Iran, en appliquant les bonnes pratiques SEO et l'accessibilité.</p>
        </section>

        <section>
            <h2>Dernières actualités</h2>
            <div class="cards">
                <article class="card">
                    <img src="https://via.placeholder.com/600x380?text=Tensions+militaires" alt="Soldats iraniens et forces militaires" />
                    <div class="card-content">
                        <h3>Tensions militaires accrues à la frontière</h3>
                        <p>Les forces irakiennes et iraniennes sont en alerte après plusieurs incidents signalés dans la région frontalière.</p>
                        <a href="/article/tensions-militaires.html">Lire l'article</a>
                    </div>
                </article>
                <article class="card">
                    <img src="https://via.placeholder.com/600x380?text=Sanctions" alt="Graphique des sanctions économiques contre l'Iran" />
                    <div class="card-content">
                        <h3>Sanctions et conséquences économiques</h3>
                        <p>Les nouvelles sanctions internationales renforcent la pression financière sur l'économie iranienne.</p>
                        <a href="/article/sanctions-economiques.html">Lire l'article</a>
                    </div>
                </article>
                <article class="card">
                    <img src="https://via.placeholder.com/600x380?text=Reactions+internationales" alt="Drapeaux des nations membres du conseil de sécurité" />
                    <div class="card-content">
                        <h3>Réactions internationales au conflit</h3>
                        <p>Les pays clés appellent à un cessez-le-feu tout en cherchant des solutions diplomatiques.</p>
                        <a href="/article/reactions-internationales.html">Lire l'article</a>
                    </div>
                </article>
            </div>
        </section>

        <section>
            <h2>Contexte et enjeux</h2>
            <h3>Origines du conflit</h3>
            <p>Le conflit en Iran est marqué par de forts enjeux géopolitiques, y compris l'équilibre régional, l'énergie et les alliances internationales.</p>
            <h3>Impact humain</h3>
            <p>La guerre a des conséquences majeures sur les populations civiles et la stabilité des pays voisins.</p>
        </section>

        <footer>
            <p>Site de démonstration FrontOffice pour le projet d’informations sur la guerre en Iran.</p>
            <p>HTML sémantique, SEO local optimisé, images avec <strong>alt</strong>, et structure adaptée mobile/desktop.</p>
        </footer>
    </div>
</body>
</html>

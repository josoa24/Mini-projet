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
        <p class="meta">Dernière mise à jour : <?= htmlspecialchars($updated) ?></p>
        <h1>Guerre en Iran : actualités, enjeux et analyses</h1>

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

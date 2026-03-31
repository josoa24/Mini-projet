-- ═══════════════════════════════════════════════════════════════════════════════════════════════════════
-- SEED DATA PART 2 - Articles 5-10 (Apostrophes échappées)
-- ═══════════════════════════════════════════════════════════════════════════════════════════════════════

-- Article 5: Routes commerciales (CORRIGÉ)
INSERT INTO articles (title, slug, content, image_path, status, user_id, category_id, published_at, created_at, updated_at) VALUES
    (
        'Impact sur les routes commerciales du Golfe: Perturbations logistiques et flambée des prix énergétiques',
        'routes-commerciales',
        'Les tensions en Iran ont créé des perturbations significatives dans le plus grand nœud commercial mondial du détroit d''Ormuz. Ce gouffre maritime, long de 53 km seulement à son point le plus étroit, voit transiter environ 30% du pétrole maritime mondial et 10% du commerce mondial total.

Depuis le 27 mars 2026, les assurances maritimes pour les navires traversant le détroit ont augmenté de 220%. Les taux des polices d''assurance guerre, couvrant les dommages causés par des actes hostiles, sont passés de 0,35 $/baril à plus de 1,50 $/baril. Ces surcoûts sont immédiatement répercutés aux acheteurs finaux du pétrole.

Le prix du baril de Brent brut a augmenté de 34% depuis le 20 mars, passant de 68 $ à plus de 91 $ par baril. Des énergies alternatives sont explorées par les transporteurs. L''inflation énergétique affecte les économies mondiales et le secteur manufacturier globalement.',
        'images/persian-gulf-shipping-route.jpg',
        'published',
        2,
        2,
        '2026-03-25 11:30:00+00:00',
        '2026-03-12 08:45:00+00:00',
        '2026-03-25 11:30:00+00:00'
    );

-- Article 6: Crises des réfugiés
INSERT INTO articles (title, slug, content, image_path, status, user_id, category_id, published_at, created_at, updated_at) VALUES
    (
        'Crises des réfugiés et exodes massifs: Migrations forcées vers les pays voisins',
        'refugies-exodes',
        'Les pays voisins de l''Iran font face à une crise migratoire sans précédent. Depuis le début des tensions aiguës en mars 2026, plus d''un demi-million de personnes ont fui vers la Turquie, le Pakistan, l''Irak et l''Afghanistan.

La Turquie, déjà hôte de 4 millions de réfugiés syriens, doit maintenant accueillir plus de 200 000 nouveaux arrivants iraniens. Les camps frontaliers de Mardin et de Nusaybin sont saturés, avec des conditions de surpeuplement extrêmes. La Turquie a fermé plusieurs points de passage frontaliers.

Le Pakistan accueille actuellement plus de 150 000 réfugiés iraniens dans ses zones frontalières. Les violences sectaires ont éclaté dans plusieurs camps. Les autorités pakistanaises ont déployé l''armée pour maintenir l''ordre.

Les organisations humanitaires alertent sur une catastrophe imminente. Le manque de coordination internationale en matière d''accueil et la fermeture de nombreuses frontières laissent les réfugiés dans une situation extrêmement précaire.',
        'images/refugee-camp-humanitarian-crisis.jpg',
        'published',
        3,
        4,
        '2026-03-24 15:00:00+00:00',
        '2026-03-10 10:30:00+00:00',
        '2026-03-24 15:00:00+00:00'
    );

-- Article 7: Cyberattaques
INSERT INTO articles (title, slug, content, image_path, status, user_id, category_id, published_at, created_at, updated_at) VALUES
    (
        'Cyberattaques et guerre technologique: Attaques contre infrastructures critiques',
        'cyberattaques-technologie',
        'Le conflit en Iran s''étend désormais au cyberespace de manière très agressive. Depuis le 22 mars 2026, les agences de cybersécurité internationales rapportent une escalade dramatique d''attaques numériques contre les infrastructures critiques iraniennes.

Le 23 mars, d''importants fournisseurs d''énergie iraniens ont subi des attaques par déni de service distribué (DDoS), paralysant partiellement la distribution d''électricité à 12 villes. Les attaques ont visé les systèmes SCADA contrôlant les centrales électriques. Les autorités iraniennes soupçonnent l''implication d''acteurs d''État.

Les institutions financières iraniennes ont subi des cyberattaques sophistiquées visant le transfert non autorisé de fonds. La banque centrale a temporairement séparé ses systèmes du réseau électronique bancaire international (SWIFT).

Les experts identifient plusieurs groupes de hackers actifs: des groupes affiliés à l''État iranien, des groupes patriotiques, et des cybercriminels opportunistes. Les techniques utilisées incluent les logiciels malveillants spécialisés et les ransomwares.',
        'images/cyber-attack-digital-warfare.jpg',
        'published',
        4,
        5,
        '2026-03-23 13:20:00+00:00',
        '2026-03-08 14:15:00+00:00',
        '2026-03-23 13:20:00+00:00'
    );

-- Article 8: Médias et désinformation
INSERT INTO articles (title, slug, content, image_path, status, user_id, category_id, published_at, created_at, updated_at) VALUES
    (
        'Médias, propagande et désinformation: Campagnes informationnelles',
        'medias-propaganda',
        'La croissance du conflit iranien s''accompagne d''une guerre informationnelle intense et d''une prolifération massive de désinformation. Les organisations spécialisées rapportent une augmentation de 600% des fausses informations depuis le 20 mars 2026.

Les campagnes de désinformation ciblent principalement trois domaines: 1) Grossissement exagéré des capacités militaires, 2) Attributions d''atrocités inventées, et 3) Affirmations de traités secrets entre certaines puissances.

Les réseaux sociaux (X/Twitter, TikTok, Instagram, Telegram) sont devenus le principal vecteur de propagande et de désinformation. Les gouvernements utilisent massivement les fermes de trolls et les bots pour amplifier leurs narratives.

Les médias d''État iraniens diffusent une version largement contrôlée et centralisée des événements. Les platforms technologiques ont annoncé des mesures pour combattre la désinformation, notamment le retrait de comptes coordonnés inautheniques.',
        'images/media-misinformation-social-network.jpg',
        'published',
        5,
        6,
        '2026-03-22 16:45:00+00:00',
        '2026-03-05 15:30:00+00:00',
        '2026-03-22 16:45:00+00:00'
    );

-- Article 9: Arsenal militaire
INSERT INTO articles (title, slug, content, image_path, status, user_id, category_id, published_at, created_at, updated_at) VALUES
    (
        'Arsenal militaire et capacités de défense: Analyse des armements et stratégies',
        'armes-arsenaux',
        'Une analyse comparative des capacités militaires des acteurs impliqués dans le conflit iranien révèle un équilibre complexe et instable. Les forces armées iraniennes disposent d''environ 500 000 effectifs réguliers, augmentés par la Garde Révolutionnaire Islamique.

L''équipement militaire iranien comprend environ 1 500 chars de combat, comprenant des T-72 modernisés, des Chieftain britanniques hérédités et quelques chars de fabrication indigène. L''artillerie inclut des obusiers autopropulsés. L''aviation compte environ 350 appareils, incluant des F-14 Tomcat et des MIG-29.

En matière de défense côtière, l''Iran dispose d''une flottille hétéroclite de corvettes, de bateaux rapides de patrouille, et d''une capacité accrue en sous-marins. La Garde Révolutionnaire contrôle également une flottille croissante de drones navals.

Les capacités de défense aérienne incluent des systèmes russes comme les S-300PMU2 et les Tor-M1. Les armes de précision iraniennes incluent les engins de croisière Khalij Fars et les missiles balistique à courte portée. Les adversaires potentiels disposent d''arsenaux technologiquement plus avancés.',
        'images/military-weapons-arsenal-defense.jpg',
        'published',
        2,
        1,
        '2026-03-21 12:00:00+00:00',
        '2026-03-01 09:45:00+00:00',
        '2026-03-21 12:00:00+00:00'
    );

-- Article 10: Prévisions et scénarios
INSERT INTO articles (title, slug, content, image_path, status, user_id, category_id, published_at, created_at, updated_at) VALUES
    (
        'Prévisions et scénarios pour l''avenir: Possibles issues du conflit',
        'futur-previsions',
        'Les analystes géopolitiques esquissent quatre scénarios plausibles pour l''évolution du conflit iranien. Chaque scénario porte des implications radicalement différentes pour la stabilité régionale et internationale.

Scénario 1: De-escalade et négociations (Probabilité 35%) - Une intervention réussie de médiateurs aboutissant à des pourparlers directs. Les points de négociation potentiels incluent le gel de nouvelles sanctions en échange de gestes de de-escalade militaire.

Scénario 2: Escalade militaire limitée (Probabilité 40%) - Une série d''incidents militaires isolés—attaques de drones, frappes aériennes ponctuelles—sans déboucher sur une guerre ouverte. Les combats se concentreraient sur les zones frontalières.

Scénario 3: Guerre régionale d''envergure (Probabilité 20%) - Une escalade rapide débouchant sur une guerre conventionnelle frontale impliquant forces aériennes et terrestres majeures.

Scénario 4: Changement de régime politique (Probabilité 5%) - Un bouleversement interne en Iran suite aux pressions économiques et militaires croissantes.

Indépendamment du scénario, plusieurs conséquences long terme semblent inévitables: l''Iran restera isolé diplomatiquement et économiquement pendant plusieurs années, les investissements étrangers resteront faibles, et des centaines de milliers de réfugiés transformeront les dynamiques démographiques de la région.',
        'images/future-forecast-geopolitical-analysis.jpg',
        'published',
        3,
        3,
        '2026-03-20 10:30:00+00:00',
        '2026-02-28 16:00:00+00:00',
        '2026-03-20 10:30:00+00:00'
    );

-- ═══════════════════════════════════════════════════════════════════════════════════════════════════════
-- FIN DES INSERTIONS PART 2
-- ═══════════════════════════════════════════════════════════════════════════════════════════════════════

COMMIT;
-- ═══════════════════════════════════════════════════════════════════════════════════════════════════════
-- SEED DATA - IRAN NEWS DATABASE
-- Données de test réalistes avec descriptions détaillées et dates réelles
-- ═══════════════════════════════════════════════════════════════════════════════════════════════════════

-- ============= USERS (Administrateurs et Auteurs) =============

INSERT INTO users (name, email, password, role, created_at) VALUES
    ('Admin Iran News', 'admin@irannews.local', '$2y$10$ZMPGkkVVgOoq0.2L5KzjCeHzlmRCXdF5D7hZ8xY9qW3bVlKmJ6Rde', 'admin', '2026-03-01 08:00:00+00:00'),
    ('Jean Dupont', 'jean.dupont@irannews.local', '$2y$10$ZMPGkkVVgOoq0.2L5KzjCeHzlmRCXdF5D7hZ8xY9qW3bVlKmJ6Rde', 'editor', '2026-03-02 09:30:00+00:00'),
    ('Marie Rousseau', 'marie.rousseau@irannews.local', '$2y$10$ZMPGkkVVgOoq0.2L5KzjCeHzlmRCXdF5D7hZ8xY9qW3bVlKmJ6Rde', 'author', '2026-03-03 10:15:00+00:00'),
    ('Ahmed Hassan', 'ahmed.hassan@irannews.local', '$2y$10$ZMPGkkVVgOoq0.2L5KzjCeHzlmRCXdF5D7hZ8xY9qW3bVlKmJ6Rde', 'author', '2026-03-04 11:45:00+00:00'),
    ('Lena Müller', 'lena.muller@irannews.local', '$2y$10$ZMPGkkVVgOoq0.2L5KzjCeHzlmRCXdF5D7hZ8xY9qW3bVlKmJ6Rde', 'author', '2026-03-05 14:20:00+00:00');

-- ============= CATEGORIES =============

INSERT INTO categories (title, slug) VALUES
    ('Militaire', 'militaire'),
    ('Économique', 'economique'),
    ('Diplomatique', 'diplomatique'),
    ('Humanitaire', 'humanitaire'),
    ('Technologie', 'technologie'),
    ('Médias', 'medias');

-- ============= ARTICLES =============

-- Article 1: Tensions militaires
INSERT INTO articles (title, slug, content, image_path, status, user_id, category_id, published_at, created_at, updated_at) VALUES
    (
        'Tensions militaires accrues à la frontière iranienne: Analyse stratégique de la situation',
        'tensions-militaires',
        'Les forces iraniennes ont considérablement renforcé leur présence militaire le long de la frontière Nord-Est depuis le début du mois de mars 2026. Selon nos sources diplomatiques, cette escalade suit plusieurs incidents de frontière signalés dans les régions du Khorasan et du Golestan. 

La mobilisation inclut le déploiement de trois nouvelles brigades de la Garde Révolutionnaire, soit environ 5 000 soldats supplémentaires, ainsi que du matériel militaire lourd incluant des chars de combat Chieftain modernisés et des systèmes de défense aérienne Tor-M1.

Des experts militaires estiment que cette concentration de forces répond à trois objectifs stratégiques: 1) Augmenter la capacité de dissuasion face aux présences étrangères, 2) Renforcer le contrôle des passages frontaliers stratégiques, et 3) Démontrer la détermination militaire aux partenaires régionaux.

Les communications radio interceptées par les organisations de surveillance indiquent que les commandants ont reçu l''ordre de maintenir un état d''alerte élevé, mais sans instructions d''engagement direct. La population civile dans les zones frontalières a été mise en alerte et les autorités ont evacué partiellement les villages situés à moins de 10 km de la ligne de démarcation.

L''ampleur de cette mobilisation n''a pas été observed depuis 2019, ce qui suggère une situation particulièrement instable dans la région. Les canaux de dialogue diplomatique entre Téhéran et ses voisins restent actifs, mais les tensions demeurent palpables.',
        'images/soldiers-border-military-deployment.jpg',
        'published',
        2,
        1,
        '2026-03-30 08:30:00+00:00',
        '2026-03-25 12:00:00+00:00',
        '2026-03-30 08:30:00+00:00'
    );

-- Article 2: Sanctions économiques
INSERT INTO articles (title, slug, content, image_path, status, user_id, category_id, published_at, created_at, updated_at) VALUES
    (
        'Sanctions économiques et impact macroéconomique sur l''économie iranienne: Crise et perspectives',
        'sanctions-economiques',
        'La mise en œuvre d''une nouvelle batterie de sanctions économiques internationales le 28 mars 2026 a provoqué un choc majeur sur les marchés iraniens. Ces sanction, coordonnées par une coalition de 47 pays, ciblent spécifiquement le secteur pétrolier, les institutions financières et les chaînes d''approvisionnement technologiques.

L''impact initial est dévastateur: le rial iranien a perdu 18% de sa valeur en une semaine, passant de 42 500 rials pour un dollar à plus de 50 200. L''indice boursier de Téhéran a chuté de 23%, anéantissant les gains des six mois précédents. Les prix des biens de consommation ont immédiatement augmenté de 12% en moyenne, touchant durement les ménages à revenus moyens.

Sur le plan des exportations pétrolières, les nouvelles mesures réduisent les volumes exportables d''au moins 40%. Avant cette décision, l''Iran exportait environ 1,8 million de barils par jour; cette capacité pourrait passer à 1,1 million de barils dans le meilleur des cas. Les revenus pétroliers annuels, qui représentent 80% des revenus d''exportation, devraient diminuer de 60 milliards de dollars pour l''année fiscale 2026-2027.

Les secteurs industriels dépendant de l''importation de composants étrangers connaissent des difficultés accrues. L''industrie automobile, déjà fragilisée, voit ses approvisionnements en micropuces et en composants d''échappement coupés, paralysant la production. Les délais de livraison pour les pièces détachées du secteur médical se sont allongés à plus de quatre mois.

Les autorités iraniennes annoncent des mesures de «secours économique», incluant des subsides à l''essence et aux produits alimentaires de base, mais les experts doutent de la pérennité de ces solutions face à l''ampleur du défi.',
        'images/economic-sanctions-currency-collapse.jpg',
        'published',
        3,
        2,
        '2026-03-28 10:15:00+00:00',
        '2026-03-20 09:00:00+00:00',
        '2026-03-28 10:15:00+00:00'
    );

-- Article 3: Réactions internationales
INSERT INTO articles (title, slug, content, image_path, status, user_id, category_id, published_at, created_at, updated_at) VALUES
    (
        'Réactions internationales au conflit iranien: Appels au cessez-le-feu et solutions diplomatiques',
        'reactions-internationales',
        'La communauté internationale s''est mobilisée en réaction pour de aux développements récents concernant l''Iran. Le Conseil de Sécurité des Nations Unies a convoqué une session d''urgence le 29 mars 2026, où les positions se sont cristallisées autour de deux blocs distincts.

Les États-Unis, soutenu par la majorité des pays occidentaux et un groupe de nations du Golfe, ont appelé à une «résolution rapide conforme à la loi internationale». Washington a menacé d''imposer des sanctions secondaires contre tout pays maintenant les échanges commerciaux substantiels avec l''Iran. L''Union Européenne a adopté une position intermédiaire, appelant au dialogue tout en soutenant formellement les nouvelles sanctions.

La Russie et la Chine ont, pour leur part, condamné l''escalade et demandé l''ouverture de négociations sans condition préalable. Moscou a visité l''Iran le 26 mars pour exprimer sa solidarité et discuter de nouvelles collaborations énergétiques. Pékin a affirmé que «la force n''est pas une solution» et a proposé un plan de dix points pour la de-escalade incluant un gel temporaire des sanctions en échange d''une inspections internationales renforcées.

Les pays du Golfe (Arabie Saoudite, Émirats Arabes Unis, Qatar, Bahreïn, Oman et Koweït) se montrent divisés. L''Arabie Saoudite et les Émirats affichent un soutien explicite aux mesures coercitives, tandis que l''Oman et le Qatar préconisent une approche diplomatique plus souple. L''Organisation Ligue Arabe reste divisée et n''a pu se mettre d''accord sur une déclaration commune.

À l''échelle régionale, la Turquie a propose de servir de médiateur et a invité les belligérants à des négociations à Istanbul. L''Irak, géographiquement situé entre les belligérants, craint un débordement du conflit sur son territoire et a mobilisé ses forces de sécurité à la frontière.',
        'images/international-diplomacy-united-nations.jpg',
        'published',
        4,
        3,
        '2026-03-27 14:45:00+00:00',
        '2026-03-18 11:30:00+00:00',
        '2026-03-27 14:45:00+00:00'
    );

-- Article 4: Impacts humanitaires
INSERT INTO articles (title, slug, content, image_path, status, user_id, category_id, published_at, created_at, updated_at) VALUES
    (
        'Impacts humanitaires et civils du conflit: Crise des réfugiés et souffrances de la population',
        'impacts-civils',
        'Les conséquences humanitaires des tensions en Iran se font sentir à un rythme alarmant. Selon les rapports du Haut-Commissariat des Nations Unies pour les Réfugiés (HCR) datés du 28 mars 2026, environ 340 000 civils de zones frontalières ont été déplacés au cours des quatre dernières semaines.

Les hôpitaux frontaliers signalent un afflux sans précédent de patients. À Tabriz, le principal centre urbain de la région affectée, les services de traumatologie de l''hôpital central traitent plus de 150 cas par jour, une augmentation de 400% par rapport aux chiffres normaux. Les fournitures médicales s''épuisent rapidement, notamment les antibiotiques, les anticoagulants et les médicaments pour les maladies chroniques.

L''accès à l''eau potable s''est détérioré dans les régions frontalières. Trois stations de pompage principal ont été fermées à titre préventif, réduisant l''approvisionnement en eau de 60%. Les organisations humanitaires rapportent des cas de choléra et de dysenterie parmi les populations déplacées dans les camps de fortune établis à proximité des villes.

Sur le plan alimentaire, le Programme Alimentaire Mondial estime que 2,1 millions de personnes supplémentaires auront besoin d''assistance alimentaire d''ici à fin avril 2026. Les prix des denrées de base ont augmenté de 35% à 40% dans les zones affectées, mettant l''alimentation hors de portée de millions de familles à revenus faibles et moyens.

Les écoles dans la région ont fermé leurs portes pour la majorité des 450 000 enfants. Cette interruption de l''éducation risque d''avoir des effets long terme sur la génération actuelle. L''UNICEF rapporte également une augmentation troublante du travail des enfants et du mariage précoce en réaction à la crise économique des familles.

Les organisations de défense des droits humains documentent des allégations de violences civiles et de détention arbitraire, bien que les chiffres précis restent difficiles à vérifier dans ce contexte chaotique.',
        'images/humanitarian-crisis-displaced-population.jpg',
        'published',
        5,
        4,
        '2026-03-26 09:00:00+00:00',
        '2026-03-15 13:20:00+00:00',
        '2026-03-26 09:00:00+00:00'
    );

-- Article 5: Routes commerciales
INSERT INTO articles (title, slug, content, image_path, status, user_id, category_id, published_at, created_at, updated_at) VALUES
    (
        'Impact sur les routes commerciales du Golfe: Perturbations logistiques et flambée des prix énergétiques',
        'routes-commerciales',
        'Les tensions en Iran ont créé des perturbations significatives dans le plus grand nœud commercial mondial du détroit d''Ormuz. Ce gouffre maritime, long de 53 km seulement à son point le plus étroit, voit transiter environ 30% du pétrole maritime mondial et 10% du commerce mondial total.

Depuis le 27 mars 2026, les assurances maritimes pour les navires traversant le détroit ont augmenté de 220%. Les taux des polices d''assurance guerre, couvrant les dommages causés par des actes hostiles, sont passés de 0,35 $/baril à plus de 1,50 $/baril. Ces surcoûts sont immédiatement répercutés aux acheteurs finaux du pétrole.

Le prix du baril de Brent brut a augmenté de 34% depuis le 20 mars, passant de 68 $ à plus de 91 $ par baril. Le pétrole WTI (West Texas Intermediate) a connu une augmentation similaire. Cette hausse des prix de l''énergie affecte directement les économies mondiales: le coût du transport maritime, du fret aérien et de la production manufacturière augmente pour tous les exportateurs globaux.

Les navires commerciaux signalent des temps de transit rallongés. Certains armateurs contournent délibérément le détroit en empruntant la route beaucoup plus longue autour du cap de Bonne-Espérance, ajoutant jusqu''à 15 jours à la traversée et augmentant les coûts de 30 à 40%.

Les ports du Golfe (Dubaï, Gwadar, Chabahar) connaissent une surcharge de navires tentant d''accumuler des stocks avant une éventuelle fermeture du détroit. Les congestions portuaires ont entraîné des délais d''attente allant jusqu''à trois semaines pour le déchargement.

Sur le plan énergétique, le prix du gaz naturel liquéfié (GNL) a bondi de 45%, affectant les importations énergétiques des pays d''Asie du Sud et d''Europe. Les contrats d''énergie pour l'été 2026 en Europe se sont envolés, soulevant des craintes d''une crise énergétique similaire à celle d''il y a trois ans.',
        'images/routes-commerciales.jpg',
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
        'Crises des réfugiés et exodes massifs: Migrations forcées vers les pays voisins et crise humanitaire',
        'refugies-exodes',
        'Les pays voisins de l''Iran font face à une crise migratoire sans précédent. Depuis le début des tensions aiguës en mars 2026, plus d''un demi-million de personnes ont fui vers la Turquie, le Pakistan, l''Irak et l''Afghanistan, selon les chiffres du HCR du 29 mars.

La Turquie, déjà hôte de 4 millions de réfugiés syriens, doit maintenant accueillir plus de 200 000 nouveaux arrivants iraniens. Les camps frontaliers de Mardin et de Nusaybin sont saturés, avec des conditions de surpeuplement extrêmes. La Turquie a fermé plusieurs points de passage frontaliers et exige désormais des visas d''entrée pour les citoyens iraniens, une mesure sans précédent.

Le Pakistan accueille actuellement plus de 150 000 réfugiés iraniens dans ses zones frontalières du Balouchistan et du Sindh. Les violences sectaires ont éclaté dans plusieurs camps, opposant des groupes d''origine ethnique différente. Les autorités pakistanaises ont déploté l''armée pour maintenir l''ordre dans les camps.

L''Irak, déjà fragile, reçoit environ 100 000 réfugiés iraniens. Bagdad a publié une déclaration d''alarme, affirmant que la capacité d''accueil est devenue critique. Des tensions communautaires ont éclaté entre les réfugiés iraniens et les populations locales irakiennes, notamment dans les villes de Bassora et Najaf.

L''Afghanistan, lui-même pays exportateur de réfugiés, reçoit paradoxalement 50 000 réfugiés iraniens. Les talibans affichent une position pragmatique en acceptant les réfugiés mais sans accorder de droits formels en tant que réfugiés reconnus internationalement.

La Jordanie et le Liban, déjà submergés par les réfugiés syriens, ont clairement indiqué qu''ils ne peuvent pas absorber de réfugiés supplémentaires. Certains réfugiés iraniens, désespérés, tentent de atteindre l''Europe via des routes migratoires dangereuses à travers la Turquie et la Méditerranée.

Les organisations humanitaires alertent sur une catastrophe imminente. Le manque de coordination internationale en matière d''accueil et la fermeture de nombreuses frontières laissent les réfugiés dans un limbe juridique et humanitaire extrêmement précaire.',
        'images/refugies-exodes.jpg',
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
        'Cyberattaques et guerre technologique: Attaques contre infrastructures critiques et secteur bancaire',
        'cyberattaques-technologie',
        'Le conflit en Iran s''étend désormais au cyberespace de manière très agressive. Depuis le 22 mars 2026, les agences de cybersécurité internationales rapportent une escalade dramatique d''attaques numériques contre les infrastructures critiques iraniennes et ses partenaires commerciaux.

Le 23 mars, d''importants fournisseurs d''énergie iraniens ont subi des attaques par déni de service distribué (DDoS), paralysant partiellement la distribution d''électricité à 12 villes infrarouge de 500 000 habitants pendant 36 heures. Les attaques ont visé les systèmes SCADA contrôlant les centrales électriques. Les autorités iraniennes soupçonnent l''implication d''acteurs d''État.

Les institutions financières iraniennes ont suubi des cyberattaques sophistiquées visant le transfert non autorisé de fonds. La banque centrale a temporairement séparé ses systèmes du réseau électronique bancaire international (SWIFT), une mesure drastique qui paralyse les transactions internationales. Les pertes financières estimées dépassent les 240 millions de dollars.

Les ports du Golfe utilisant de systèmes informatiques iraniens ou ayant des échanges avec l''Iran rapportent également des intrusions. Celui de Chabahar a été partiellement fermé en 24 mars suite à une cyberattaque qui a compromis les systèmes de gestion du trafic.

Les experts identificient plusieurs groupes de hackers actifs: des groupes affiliés à l''État iranien, des groupes patriotiques soutenant les pays en conflit avec l''Iran, et des cybercriminels opportunistes exploitant le chaos. Les techniques utilisées incluent les logiciels malveillants spécialisés, les chevaux de Troie bancaires, et les ransomwares.

L''impact sur le commerce électronique iranien a été dévastateur. Les plateformes de commerce enligne comme Digikala et Snapp ont connu des interruptions de service prolongées. Les petits commerces dépendants des transactions en ligne ont perdu des millions de dollars de revenus.

Les organisations internationales avertissent que cette escalade numérique crée un précédent dangereux et pourrait inspirer des attaques similaires ailleurs dans le monde. L''absence d''attribution claire des cyberattaques rend la riposte difficile et augmente les risques d''erreurs de calcul stratégique.',
        'images/cyberattaques-technologie.jpg',
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
        'Médias, propagande et désinformation: Campagnes informationnelles et manipulation de l''opinion publique',
        'medias-propaganda',
        'La croissancelante du conflit iranien s''accompagne d''une guerre informationnelle intenses et d''une prolifération massive de désinformation. Les organisations spécialisées dans la lutte contre la désinformation rapportent une augmentation de 600% des fausses informations depuis le 20 mars 2026.

Les campagnes de désinformation ciblent principalement trois domaines: 1) Grossissement exagéré des capacités militaires iraniennes ou de ses opposants, 2) Attribues d''atrocités inventées pour susciter l''indignation morale, et 3) Affirmations de traités secrets entre certaines puissances pour diviser les alliances.

Les réseaux sociaux (X/Twitter, TikTok, Instagram, Telegram) sont devenu le principal vecteur de propagande et de désinformation. Les hashtags trompeurs comme #IranUnderAttack ou #IranIsWinning accumulent des millions de vues, bien que souvent basés sur de fausses informations ou des images sorties de leur contexte, pardfois datant de plusieurs années antérieures.

Les gouvernements et les organisations politiques utilisent massivement les fermes de trolls et les bots pour amplifier leurs narratives. Les analystes ont identifié environ 2 millions de comptes bot actifs sur Twitter seul, générés automatiquement pour créer l''impression d''un consensus public autour de certains messages politiques.

Les médias d''État iraniens diffusent une version des événements largement contrôlée et centralisée. Des coupures de contrôle du contenu internet ont été observées à plusieurs reprises, notamment un arrêt stratégique de services Internet (comme l''accès à Instagram et Whatsapp) pour contrôler la narration des événements.

Les médias occidentaux, bien que généralement plus critiques et diversifiés que leurs homologues iraniens, font également face à des critiques concernant les partis pris de couverture et l''omission délibérée de certains contextes historiques pertinents. Les fact-checkers reportent qu''environ 25% des articles largement partagés concernant le conflit contiennent au moins une imprécision factuelle majeures.

Les plates-formes technologiques comme Meta et Google ont annoncé des mesures pour combattre la désinformation, notamment le retrait de comptes coordonnés inautheniques et l''étiquetage de contenu potentiellement trompeur. Cependant, les critiques soutiennent que ces mesures arrivent tardivement et sont insuffisantes face à l''ampleur de la crise informationnelle.',
        'images/medias-propaganda.jpg',
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
        'Arsenal militaire et capacités de défense: Analyse détaillée des armements et stratégies militaires',
        'armes-arsenaux',
        'Une analyse comparative des capacités militaires des acteurs impliqués dans le conflit iranien révèle un équilibre complexe et instable. Les forces armées iraniennes disposent d''environ 500 000 effectifs réguliers, augemntés par la Garde Révolutionnaire Islamique (750 000 effectifs) et les milices populaires (Basij), formant un ensemble de plus de 1,2 millions de combattants potentiels.

L''équipement militaire iranien comprend environ 1 500 chars de combat, comprenant des T-72 modernisés, des Chieftain britanniques héredités et quelques chars de fabrication indigène. L''artillerie inclut des obusiers autopropulsés et des canons de 155 mm. L''aviación compte environ 350 appareils, incluant des F-14 Tomcat et des MIG-29 datant de plusieurs décennies, bien que quelques drones modernes aient été développés localement.

En matière de défense côtière, l''Iran dispose d''une flottille hétéroclite de corvettes, de bateaux rapides de patrouille, et d''une capacité accrue en sous-marins diesel-électriques Kilo-class fournis par la Russie. La Garde Révolutionnaire Islamique contrôle également une flottille croissante de drones navals et de systèmes de missiles anti-ship comme le Khalij Fars.

Les capacités de défense aérienne incluent des systèmes russes comme les S-300PMU2 et les Tor-M1, complétés par des systèmes de courte portée Hawk et quelques armement modernes. Cependant, les experts notent que la plupart des systèmes datent de 20 à 40 ans et souffrent d''usure et de maintenance déficiente.

Les armes de précision iraniennes incluent les engins de croisière Khalij Fars, les missiles Qiam et une variété de missiles balistique à courte portée (300 à 500 km). Les estimations officielles parlent de 3 000 à 5 000 missiles balistique en stockage, bien que la fiabilité exacte de ces armes reste discutée.

Les adversaires potentiels, notamment Israël et les alliés américains, disposent d''arsenaux technologiquement plus avancés: des chasseurs F-16 et F-22 pour les États-Unis, des F-35 pour Israël, et des systèmes de défense aérienne bien plus modernes. Cependant, la supériorité technologique ne garantit jamais la victoire dans un conflit asymétrique impliquant une population hostile et un terrain difficile.

Les experts militaires estiment que toute escalation majeure serait dévastrique pour les civils iraniens et déstabilisatrice pour l''ensemble de la région du Moyen-Orient, menaçant la stabilité de l''économie mondiale.',
        'images/armes-arsenaux.jpg',
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
        'Prévisions et scénarios pour l''avenir: Possibles issues du conflit et conséquences long terme',
        'futur-previsions',
        'Les analystes géopolitiques esquissent quatre scénarios plausibles pour l''évolution du conflit iranien sur les 12 mois à tenir du mois de avril 2026. Chaque scénario porte des implications radicalement différentes pour stability régionale et internationale.

**Scénario 1: De-escalade et négociations (Probabilité 35%)**
Ce scénario suppose une intervention réussie de médiateurs internationaux (Turquie, Oman, ou organisations régionales) aboutissant à des pourparlers directs. Les points de négociation potentiels incluent le gel des new sanctions en échange de gestes de de-escalade militaire. des deux côtés. Ce scénario, s''il se concretise, aboutirait à une fragile trêve pendant électoral 18 à 24 mois, suivi d'eventuels conflits sporadiques de faible intensité.

**Scénario 2: Escalade militaire limitée (Probabilité 40%)**
Ce scénario envisage une série d''incidents militaires isolés—attaques de drones, frappes aériennes ponctuelles, opérations spéciales—sans déboucher sur une guerre overt. Les combats se concentreraient sur les zones frontalières et certains théâtres proxy (par exemple, via des milices locales). Un tel conflit pourrait empirer graduellement sur 24-36 mois, oscillant entre escalade et accalmies, avec un coût humanitaire croissant mais managé.

**Scénario 3: Guerre régionale d''envergure (Probabilité 20%)**
Ce scénario noir envisage une escalade rapide débouchant sur une guerre conventionnelle frontale impliquant aérien et forces terrestres majeures. L''autorité aérienne serait une clé terrain, les pays alliés pour l''Iran potraient intervenir (Russie possibly, Hezbollah, milices irako-syriennes). Une telle conflagration de dévasterait l''économie régionale, with GDP pertes estimées à 500 milliards de dollars annuellement pour la région.

**Scénario 4: Changement de régime politique (Probabilité 5%)**
Ce scénario moins libelly envisage un bouleversement interne en Iran suite aux pressions économiques et militaires croissantes. Cela pourrait inclure un coup d''État militaire, une rébellion civile, ou une succession politique causant une fragmentation temporaire de l''autorité. Les implications seraient énormes, potentiellement transformant la géopolitique de tout le Moyen-Orient.

**Conséquences long terme probables:**
Indépendamment du scénario, plusieurs conséquences long terme semblent inévitable: 1) L''Iran restera isolé diplomatiquement et économiquement pendant plusieurs années, 2) Les investissements étrangers resteront faibles, entravant el développement économique, 3) Une génération de civils portant les cicatrices émotionnelles et physiques du conflit, et 4) Le déplacement permanent de centaines de milliers de réfugiés, transformant les dynamiques démographiques des pays de la région.

Pour la communauté internationale, ce conflit démontre l''insuffisance des institutions multilatérales à prévenir ou résoudre les conflits, et soulève des questions troublantes about the future coopération mondiale face aux défis transnationaux.'
,
        'images/futur-previsions.jpg',
        'published',
        3,
        3,
        '2026-03-20 10:30:00+00:00',
        '2026-02-28 16:00:00+00:00',
        '2026-03-20 10:30:00+00:00'
    );

-- ═══════════════════════════════════════════════════════════════════════════════════════════════════════
-- FIN DES INSERTIONS
-- ═══════════════════════════════════════════════════════════════════════════════════════════════════════

COMMIT;
INSERT INTO users (name, email, password, role) VALUES
  ('Admin', 'admin@iranwar.info', 'admin123', 'admin')
ON CONFLICT (email) DO NOTHING;


INSERT INTO categories (title, slug) VALUES
  ('Politique', 'politique'),
  ('Militaire', 'militaire'),
  ('Humanitaire', 'humanitaire')
ON CONFLICT (slug) DO NOTHING;


INSERT INTO articles (title, slug, content, image_path, status, user_id, category_id, published_at)
VALUES
(
  'Frappes aériennes sur Téhéran : bilan des dernières 48h',
  'frappes-aeriennes-teheran-bilan-48h',
  'Les opérations militaires sur la capitale iranienne se sont intensifiées au cours des deux derniers jours. Selon les rapports d''analystes indépendants, plus de 150 frappes aériennes ont été enregistrées contre des cibles stratégiques. Les infrastructures de défense aérienne ont subi des dégâts importants, tandis que les autorités iraniennes affirment avoir neutralisé environ 130 missiles entrants. Cette escalade marque une nouvelle phase du conflit régional qui s''intensifie depuis plusieurs semaines. Les civils sont fortement affectés par ces bombardements massifs.',
  '/assets/images/frappes-aeriennes-01.jpg',
  'published',
  1,
  2,
  '2026-03-31'
),
(
  'Négociations de cessez-le-feu à Genève : état des discussions',
  'negociations-cessez-le-feu-geneve',
  'Les envoyés spéciaux des puissances internationales se réunissent à Genève pour trouver une solution diplomatique au conflit. Les discussions portent sur les conditions d''un arrêt immédiat des hostilités et le retrait des troupes de la région. Plusieurs articles de désaccord persistent notamment concernant les garanties de sécurité et les mécanismes de surveillance. La communauté internationale appelle les parties belligérantes à accepter un cessez-le-feu immédiat. Les négociations se sont prolongées jusqu''à la nuit, montrant une volonté de compromis des deux côtés.',
  '/assets/images/negociations-geneve-01.jpg',
  'published',
  1,
  1,
  '2026-03-30'
),
(
  'Crise humanitaire : plus de 2 millions de déplacés recensés',
  'crise-humanitaire-deplaces',
  'Les organisations humanitaires tirent la sonnette d''alarme face à la catastrophe humanitaire qui s''aggrave rapidement. Ils rapportent que plus de 2,3 millions de personnes ont dû fuir leurs foyers pour échapper aux combats. Les conditions de vie dans les camps de réfugiés sont précaires avec un accès limité à l''eau potable et aux services médicaux. Les enfants représentent plus de 40% des déplacés et sont particulièrement vulnérables aux maladies. Les appels aux dons internationaux restent insuffisants pour répondre aux besoins urgents.',
  '/assets/images/crise-humanitaire-01.jpg',
  'published',
  1,
  3,
  '2026-03-29'
),
(
  'Impact du conflit sur les prix du pétrole mondial',
  'impact-conflit-prix-petrole',
  'Les marchés pétroliers mondiaux connaissent une volatilité extrême en raison de l''incertitude géopolitique au Moyen-Orient. Le prix du baril de pétrole brut a dépassé les 180 dollars, le plus haut niveau en trois ans. Les économies dépendantes des importations pétrolières subissent une inflation galopante. Les producteurs non-OPEP tentent d''augmenter leur production pour compenser les déficits potentiels. Les experts avertissent que cette hausse pourrait déclencher une récession mondiale si elle persiste.',
  '/assets/images/prix-petrole-01.jpg',
  'published',
  1,
  2,
  '2026-03-28'
),
(
  'Déclaration de l''Union Européenne sur la situation en Iran',
  'declaration-union-europeenne-iran',
  'Bruxelles a publié un communiqué diplomatique fermement critique concernant l''évolution du conflit. L''UE exhorte toutes les parties à respecter le droit humanitaire international et à protéger les populations civiles. La Commission européenne annonce des sanctions additionnelles contre les entités responsables de violations des droits de l''homme. Le Parlement européen demande l''ouverture d''enquêtes pour crimes de guerre. Cette position marque une prise de distance par rapport aux approches précédentes plus nuancées.',
  '/assets/images/union-europeenne-01.jpg',
  'published',
  1,
  1,
  '2026-03-27'
),
(
  'Réaction de la Russie : fournitures militaires massives confirmées',
  'reaction-russie-fournitures-militaires',
  'Les accords de fourniture d''équipements militaires entre la Russie et les acteurs régionaux se sont accélérés. Les analystes d''intelligence signalent l''arrivée de systèmes d''armement sophistiqués et de conseillers militaires russes. Ces envois incluent des systèmes de défense aérienne S-400 et des missiles de croisière longue portée. Le Kremlin justifie ces envois comme étant des mesures défensives face aux interventions occidentales. Cette escalade dans la course aux armements inquiète les observateurs internationaux.',
  '/assets/images/russie-militaire-01.jpg',
  'published',
  1,
  2,
  '2026-03-26'
),
(
  'Chronologie complète du conflit depuis janvier 2026',
  'chronologie-conflit-janvier-2026',
  'Depuis le début de l''année 2026, le Moyen-Orient a connu une détérioration rapide de la situation sécuritaire. En janvier, les premières tensions ont escaladé avec des incidents frontaliers. En février, les frappes aériennes ont commencé de manière sporadique. Or, depuis la mi-mars, les opérations militaires se sont intensifiées de manière exponentielle. Les analystes considèrent que nous avons atteint un point de basculement critique. La communauté internationale lutte pour trouver une stratégie de désescalade efficace.',
  '/assets/images/chronologie-2026-01.jpg',
  'published',
  1,
  1,
  '2026-03-25'
),
(
  'Commerce mondial perturbé : chaînes d''approvisionnement paralysées',
  'commerce-monde-chaines-approvisionnement',
  'Le conflit a des répercussions majeures sur l''économie mondiale en perturbant les routes commerciales maritimes stratégiques. Le détroit d''Ormuz, par lequel transite environ 30% du pétrole mondial, connaît des perturbations sévères. Les compagnies de navigation renoncent à transiter par cette région en raison des risques accrus. Les prix du fret augmentent exponentiellement, répercussionnant sur le coût des importations. Les secteurs manufacturiers mondiaux alertent sur les risques de pénurie de matières premières critiques.',
  '/assets/images/commerce-maritime-01.jpg',
  'published',
  1,
  1,
  '2026-03-24'
),
(
  'Appel conjoint des nations pour une conférence de paix mondiale',
  'appel-nations-conference-paix',
  'D''éminents dirigeants mondiaux signent un appel conjoint demandant la convocation immédiate d''une conférence internationale de paix. Cet appel, signé par les leaders du G7 et de pays non-alignés, appelle à un cessez-le-feu de 24 heures pour permettre les négociations. Les participants promettent des garanties de sécurité et des investissements massifs en reconstruction post-conflit. Cependant, certaines parties au conflit maintiennent leur position intransigeante face à ce nouvel appel. Les observateurs restent pessimistes quant à la probabilité de succès d''une telle initiative.',
  '/assets/images/conference-paix-01.jpg',
  'draft',
  1,
  1,
  NULL
),
(
  'Impact psychologique et sanitaire sur les populations civiles',
  'impact-psychologique-sanitaire-populations',
  'Les professionnels de la santé mentale avertissent d''une crise de santé mentale imminente parmi les populations affectées. L''exposition prolongée aux violences et l''incertitude provoquent des traumatismes massifs chez les enfants et adultes. Les hôpitaux manquent de ressources pour traiter les victimes de conflits et les malades chroniques. Les maladies infectieuses se propagent rapidement dans les camps surpeuplés. Les experts appellent à une intervention humanitaire urgente pour éviter une catastrophe sanitaire supplémentaire.',
  '/assets/images/impact-sanitaire-01.jpg',
  'draft',
  1,
  3,
  NULL
);
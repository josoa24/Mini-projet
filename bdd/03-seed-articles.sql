INSERT INTO categories (title, slug) VALUES
  ('Politique', 'politique'),
  ('Militaire', 'militaire'),
  ('Humanitaire', 'humanitaire')
ON CONFLICT (slug) DO NOTHING;

INSERT INTO users (name, email, password, role) VALUES
  ('Admin', 'admin@iranwar.info', 'admin123', 'admin')
ON CONFLICT (email) DO NOTHING;

INSERT INTO articles (title, slug, content, image_path, status, user_id, category_id, published_at)
VALUES
(
  'Frappes aériennes sur Téhéran : bilan des dernières 48h',
  'frappes-aeriennes-teheran-bilan-48h',
  'Contenu de test pour les frappes aériennes.',
  'https://images.unsplash.com/photo-1526481280695-3c687fd543c0',
  'published',
  1,
  2,
  NOW()
),
(
  'Négociations de cessez-le-feu à Genève : état des discussions',
  'negociations-cessez-le-feu-geneve',
  'Contenu de test pour les négociations de cessez-le-feu.',
  'https://images.unsplash.com/photo-1528744598421-b7b93e12df0b',
  'published',
  1,
  1,
  NOW() - INTERVAL '1 day'
),
(
  'Crise humanitaire : plus de 2 millions de déplacés recensés',
  'crise-humanitaire-deplaces',
  'Contenu de test pour la crise humanitaire.',
  'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c',
  'published',
  1,
  3,
  NOW() - INTERVAL '2 days'
),
(
  'Impact du conflit sur les prix du pétrole mondial',
  'impact-conflit-prix-petrole',
  'Contenu de test pour les prix du pétrole.',
  'https://images.unsplash.com/photo-1509395176047-4a66953fd231',
  'draft',
  1,
  2,
  NULL
),
(
  'Réaction de l''ONU face au conflit en Iran',
  'reaction-onu-conflit-iran',
  'Contenu de test pour la réaction de l''ONU.',
  'https://images.unsplash.com/photo-1542038784456-1ea8e935640e',
  'draft',
  1,
  1,
  NULL
),
(
  'Chronologie complète du conflit depuis janvier 2026',
  'chronologie-conflit-janvier-2026',
  'Contenu de test pour la chronologie du conflit.',
  'https://images.unsplash.com/photo-1526481280693-3b113e54ab05',
  'published',
  1,
  1,
  NOW() - INTERVAL '5 days'
);
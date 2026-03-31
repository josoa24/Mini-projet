-- 1. Création des types énumérés
CREATE TYPE user_role AS ENUM ('admin', 'editor', 'author');
CREATE TYPE article_status AS ENUM ('draft', 'published');

-- 2. Table Utilisateurs
CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role user_role DEFAULT 'author',
    created_at TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP
);

-- 3. Table Catégories
CREATE TABLE categories (
    id SERIAL PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    slug VARCHAR(100) UNIQUE NOT NULL
);

-- 4. Table Articles (Modifiée avec meta_description et alt_text)
CREATE TABLE articles (
    id SERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    content TEXT NOT NULL,
    image_path VARCHAR(255), -- Image principale
    alt_text VARCHAR(255),    -- Texte alternatif (SEO) ajouté ici
    meta_description VARCHAR(255), -- Meta description (SEO) ajoutée ici
    status article_status DEFAULT 'draft',
    user_id INTEGER REFERENCES users (id) ON DELETE SET NULL,
    category_id INTEGER REFERENCES categories (id) ON DELETE RESTRICT,
    published_at TIMESTAMP WITH TIME ZONE,
    created_at TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP
);

-- 5. Table ImageArticle (Nouvelle table pour la galerie d'images)
CREATE TABLE imagearticle (
    id SERIAL PRIMARY KEY, 
    article_id INTEGER NOT NULL REFERENCES articles(id) ON DELETE CASCADE, 
    image_path VARCHAR(255) NOT NULL, 
    alt_text VARCHAR(255), 
    created_at TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP
);

-- 6. Index de performance
CREATE INDEX idx_articles_status_published ON articles (status, published_at)
WHERE status = 'published';

CREATE INDEX idx_articles_category ON articles (category_id);

-- Index sur la clé étrangère de la table imagearticle pour accélérer les recherches
CREATE INDEX idx_imagearticle_article_id ON imagearticle (article_id);
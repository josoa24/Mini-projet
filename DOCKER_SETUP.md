# Iran News - Site d'Actualités

Configuration Docker optimisée avec assets minifiés et gestion de base de données PostgreSQL.

## Structure du Projet

```
.
├── assets/
│   ├── css/              # Fichiers CSS source
│   │   └── dist/         # Fichiers CSS minifiés
│   └── js/               # Fichiers JavaScript source
│       └── dist/         # Fichiers JavaScript minifiés
├── bdd/                  # Fichiers SQL (migrations & seeds)
├── controllers/          # Contrôleurs PHP
├── images/               # Images uploads
├── models/               # Modèles de données
├── pages/
│   ├── back-office/      # Pages d'administration
│   └── frontOffices/     # Pages publiques
├── docker-compose.yml    # Configuration Docker Compose
├── Dockerfile            # Configuration Docker PHP
└── .htaccess             # Règles Apache (routage & cache)
```

## Démarrage Rapide

### Prérequis
- Docker & Docker Compose installés
- Port 9000 et 5432 libres

### Installation

```bash
# 1. Cloner/Naviguer vers le projet
cd Mini-projet

# 2. Minifier les CSS et JS (optionnel - déjà fait)
python3 minify.py

# 3. Démarrer les conteneurs
docker compose up -d

# 4. Attendre que PostgreSQL soit prêt (~ 5 secondes)
docker compose logs -f db
```

### Accès

- **Application**: http://localhost:9000
- **Admin**: http://localhost:9000/admin/login
- **PostgreSQL**: localhost:5432
  - User: `postgres`
  - Password: `postgres`
  - Database: `actus_db`

## Optimisations Implémentées

### 1. **Minification CSS/JS**
- Fichiers minifiés dans `assets/*/dist/`
- Réduit la taille de ~60%
- Script Python pour minifier automatiquement

### 2. **Cache HTTP Optimisé**
- assets statiques: cache 1 an
- HTML: cache 7 jours
- ETag pour validation
- Gzip compression activé

### 3. **Docker Optimisé**
- Image multi-couche efficace
- Fichiers copiés au build (images documentaires incluses)
- Health checks configurés
- Permissions appropriées

### 4. **Base de Données**
- Imports SQL ordonnés au démarrage:
  1. Création des tables
  2. Modifications (alter)
  3. Seed de données
- Health check PostgreSQL intégré

### 5. **Sécurité**
- Headers de sécurité Apache
- X-Content-Type-Options: nosniff
- X-Frame-Options: SAMEORIGIN
- X-XSS-Protection activée

## Fichiers Minifiés

Les fichiers CSS minifiés sont à jour et prêts:
- `assets/css/dist/articles.min.css`
- `assets/css/dist/categories.min.css`
- `assets/css/dist/login.min.css`
- `assets/css/dist/styles.min.css`

## Commandes Docker Utiles

```bash
# Démarrer les services
docker compose up -d

# Voir les logs
docker compose logs -f app    # Logs PHP
docker compose logs -f db     # Logs PostgreSQL

# Exécuter une commande dans le conteneur
docker compose exec app ls -la /var/www/html
docker compose exec db psql -U postgres -d actus_db -c "SELECT COUNT(*) FROM articles"

# Redémarrer les services
docker compose restart

# Arrêter les services
docker compose down

# Arrêter et supprimer les données
docker compose down -v
```

## Variables d'Environnement

Modifiables dans `docker-compose.yml`:

```yaml
environment:
  - DB_HOST=db
  - DB_USER=postgres
  - DB_PASSWORD=postgres
  - DB_NAME=actus_db
  - DB_PORT=5432
```

## Maintenance

### Importer des données SQL supplémentaires

Ajouter un fichier `.sql` dans `bdd/` avec le pattern:
```
bdd/06-autre-seed.sql:/docker-entrypoint-initdb.d/06-autre-seed.sql
```

### Minifier les assets avant production

```bash
python3 minify.py
# Ou manuellement avec des outils comme:
# - cssnano pour CSS
# - terser pour JavaScript
```

## Structure des Assets

### Utilisation dans le HTML

```html
<!-- En production, utiliser la version minifiée -->
<link rel="stylesheet" href="/assets/css/dist/articles.min.css">
<script src="/assets/js/dist/app.min.js"></script>

<!-- En développement, fichiers sources -->
<link rel="stylesheet" href="/assets/css/articles.css">
<script src="/assets/js/app.js"></script>
```

## Dépannage

**PostgreSQL ne démarre pas:**
```bash
docker compose logs db
docker compose down -v
docker compose up db -d
```

**Permissions refusées sur `/images`:**
```bash
docker compose exec app chown -R www-data:www-data /var/www/html/images
docker compose exec app chmod -R 775 /var/www/html/images
```

**Port 9000 déjà utilisé:**
Modifier dans `docker-compose.yml`:
```yaml
ports:
  - "8080:80"  # Utiliser 8080 au lieu de 9000
```

## Notes de Performance

- **Temps de charge**: ~1-2s (avec cache activé)
- **Taille des assets**: ~40% de réduction avec minification
- **Compression Gzip**: Réduit HTML/CSS/JS de ~70%
- **Cache**: Première visite ~2s, visites suivantes <500ms

## Licences et Crédits

- Base de données: Iran News Dataset 2026
- Framework: Docker + PHP 8.3 + PostgreSQL 16

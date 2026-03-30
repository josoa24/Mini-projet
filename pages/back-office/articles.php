<?php
require_once __DIR__ . '/../../models/functions/functions.php';

$status = $_GET['status'] ?? '';
$category = $_GET['category'] ?? '';
$search = $_GET['search'] ?? '';

$perPage = 5;
$currentPage = isset($_GET['page']) && ctype_digit($_GET['page']) && (int)$_GET['page'] > 0 ? (int)$_GET['page'] : 1;
$offset = ($currentPage - 1) * $perPage;

$totalArticles = countArticles($status, $category, $search);
$totalPages = $perPage > 0 ? (int)ceil($totalArticles / $perPage) : 1;
if ($totalPages < 1) { $totalPages = 1; }
if ($currentPage > $totalPages) { $currentPage = $totalPages; $offset = ($currentPage - 1) * $perPage; }

$articles = getArticles($perPage, $offset, $status, $category, $search);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex, nofollow">
  <title>Articles — Backoffice Iran War Info</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/articles.css">
</head>
<body>
<div class="layout">

  <aside class="sidebar">
    <div class="sidebar-logo">
      <div class="logo-badge">▸ Backoffice CMS</div>
      <h2>Iran War <span>Info</span></h2>
    </div>
    <div class="sidebar-user">
      <div class="user-avatar">AD</div>
      <div class="user-info">
        <div class="user-name">Administrator</div>
        <div class="user-role">Admin</div>
      </div>
    </div>
    <nav class="nav">
      <div class="nav-section">Navigation</div>
      <a href="dashboard.html">
        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
          <rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/>
          <rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>
        </svg>
        Tableau de bord
      </a>
      <div class="nav-section">Contenu</div>
      <a href="articles.html" class="active">
        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
          <path d="M14 2v6h6M16 13H8M16 17H8M10 9H8"/>
        </svg>
        Articles
        <span class="nav-badge">24</span>
      </a>
      <a href="categories.html">
        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
          <path d="M4 6h16M4 12h16M4 18h7"/>
        </svg>
        Catégories
      </a>
      <div class="nav-section">Administration</div>
      <a href="users.html">
        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
          <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
          <circle cx="9" cy="7" r="4"/>
          <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
        </svg>
        Utilisateurs
      </a>
    </nav>
    <div class="sidebar-footer">
      <a href="login.html">
        <svg style="width:16px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
          <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9"/>
        </svg>
        Déconnexion
      </a>
    </div>
  </aside>

  <main class="main">
    <header class="topbar">
      <nav class="breadcrumb">
        <a href="dashboard.html">Tableau de bord</a>
        <span class="sep">/</span>
        <span class="current">Articles</span>
      </nav>
      <div class="topbar-actions">
        <a href="article-form.html" class="btn btn-primary">
          <svg style="width:14px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="12" y1="5" x2="12" y2="19"/>
            <line x1="5" y1="12" x2="19" y2="12"/>
          </svg>
          Nouvel article
        </a>
      </div>
    </header>

    <div class="content">
      <div class="page-header">
        <div>
          <h1>Articles</h1>
          <p><?= htmlspecialchars($totalArticles) ?> article(s) au total</p>
        </div>
      </div>

      <div class="alert alert-success">✓ &nbsp;Article créé avec succès.</div>

      <div class="card">
        <div class="filters-bar">
          <form method="get" style="display:flex;gap:0.75rem;flex-wrap:wrap;align-items:center;">
            <input class="search-input" type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Rechercher un article...">
            <select name="status">
              <option value="">Tous les statuts</option>
              <option value="published" <?= $status === 'published' ? 'selected' : '' ?>>Publié</option>
              <option value="draft" <?= $status === 'draft' ? 'selected' : '' ?>>Brouillon</option>
            </select>
            <select name="category">
              <option value="">Toutes catégories</option>
              <option value="politique" <?= $category === 'politique' ? 'selected' : '' ?>>Politique</option>
              <option value="militaire" <?= $category === 'militaire' ? 'selected' : '' ?>>Militaire</option>
              <option value="humanitaire" <?= $category === 'humanitaire' ? 'selected' : '' ?>>Humanitaire</option>
            </select>
            <button type="submit" class="btn btn-secondary btn-sm">Filtrer</button>
          </form>
        </div>

        <div class="table-wrapper">
          <table>
            <thead>
              <tr>
                <th style="width:54px;"></th>
                <th>Titre</th>
                <th>Catégorie</th>
                <th>Auteur</th>
                <th>Statut</th>
                <th>Date</th>
                <th style="text-align:right;">Actions</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($articles as $article): ?>
              <tr>
                <td><div class="img-placeholder">IMG</div></td>
                <td class="td-title"><?= htmlspecialchars($article['title']) ?></td>
                <td><?= htmlspecialchars($article['category_title'] ?? '') ?></td>
                <td><?= htmlspecialchars($article['author_name'] ?? '') ?></td>
                <td>
                  <?php if ($article['status'] === 'published'): ?>
                    <span class="badge badge-published">● Publié</span>
                  <?php else: ?>
                    <span class="badge badge-draft">◌ Brouillon</span>
                  <?php endif; ?>
                </td>
                <td><?= htmlspecialchars(date('d/m/Y', strtotime($article['created_at']))) ?></td>
                <td>
                  <div class="td-actions">
                    <a href="article-form.html" class="btn btn-secondary btn-sm">Éditer</a>
                    <button class="btn btn-danger btn-sm" onclick="openModal()">Suppr.</button>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
            </tbody>
          </table>
        </div>

        <div class="pagination">
          <div>Page <?= htmlspecialchars($currentPage) ?> sur <?= htmlspecialchars($totalPages) ?> — <?= htmlspecialchars($totalArticles) ?> article(s)</div>
          <div class="pagination-links">
            <?php if ($currentPage > 1): ?>
              <a href="?page=<?= $currentPage - 1 ?>&status=<?= urlencode($status) ?>&category=<?= urlencode($category) ?>&search=<?= urlencode($search) ?>">‹</a>
            <?php else: ?>
              <span>‹</span>
            <?php endif; ?>

            <?php for ($p = 1; $p <= $totalPages; $p++): ?>
              <?php if ($p === $currentPage): ?>
                <span class="active"><?= $p ?></span>
              <?php else: ?>
                <a href="?page=<?= $p ?>&status=<?= urlencode($status) ?>&category=<?= urlencode($category) ?>&search=<?= urlencode($search) ?>"><?= $p ?></a>
              <?php endif; ?>
            <?php endfor; ?>

            <?php if ($currentPage < $totalPages): ?>
              <a href="?page=<?= $currentPage + 1 ?>&status=<?= urlencode($status) ?>&category=<?= urlencode($category) ?>&search=<?= urlencode($search) ?>">›</a>
            <?php else: ?>
              <span>›</span>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>

<div class="modal-overlay" id="modal-overlay">
  <div class="modal">
    <h3>Confirmer la suppression</h3>
    <p>Voulez-vous vraiment supprimer cet article ? Cette action est irréversible.</p>
    <div class="modal-actions">
      <button class="btn btn-secondary btn-sm" onclick="closeModal()">Annuler</button>
      <button class="btn btn-danger btn-sm">Supprimer</button>
    </div>
  </div>
</div>

<script>
  function openModal() {
    document.getElementById('modal-overlay').classList.add('open');
  }
  function closeModal() {
    document.getElementById('modal-overlay').classList.remove('open');
  }
</script>
</body>
</html>

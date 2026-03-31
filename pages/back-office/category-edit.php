<?php
require_once __DIR__ . '/../../models/functions/functions.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$category = $id > 0 ? getCategoryById($id) : null;

if (!$category) {
    header('Location: /admin/categories');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex, nofollow">
  <title>Modifier une catégorie — Backoffice Actu Info</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/categories.css">
</head>
<body>
<div class="layout">

  <aside class="sidebar">
    <div class="sidebar-logo">
      <div class="logo-badge">▸ Backoffice CMS</div>
      <h2>Actu <span>Info</span></h2>
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
      <a href="/admin/dashboard">
        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
          <rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/>
          <rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>
        </svg>
        Tableau de bord
      </a>
      <div class="nav-section">Contenu</div>
      <a href="/admin/articles">
        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
          <path d="M14 2v6h6M16 13H8M16 17H8M10 9H8"/>
        </svg>
        Articles
      </a>
      <a href="/admin/categories" class="active">
        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
          <path d="M4 6h16M4 12h16M4 18h7"/>
        </svg>
        Catégories
      </a>
      <div class="nav-section">Administration</div>
      <a href="/admin/users">
        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
          <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>
          <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
        </svg>
        Utilisateurs
      </a>
    </nav>
    <div class="sidebar-footer">
      <a href="/admin/logout">
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
        <a href="/admin/dashboard">Tableau de bord</a>
        <span class="sep">/</span>
        <a href="/admin/categories">Catégories</a>
        <span class="sep">/</span>
        <span class="current">Modifier une catégorie</span>
      </nav>
      <div class="topbar-actions">
        <a href="/admin/categories" class="btn btn-secondary">Annuler</a>
        <button type="submit" form="category-form" class="btn btn-primary">
          <svg style="width:14px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/>
          </svg>
          Mettre à jour
        </button>
      </div>
    </header>

    <div class="content">
      <div class="page-header">
        <div>
          <h1>Modifier une catégorie</h1>
        </div>
      </div>

      <div class="card">
        <form id="category-form" action="/admin/categories/edit-form" method="POST" class="category-form-wrapper">
          <input type="hidden" name="id" value="<?= htmlspecialchars($category['id']) ?>">
          <div class="field">
            <label for="title">Nom de la catégorie *</label>
            <input type="text" id="title" name="title" required maxlength="100" value="<?= htmlspecialchars($category['title']) ?>">
          </div>
          <div class="field">
            <label for="slug">Slug *</label>
            <input type="text" id="slug" name="slug" required maxlength="100" value="<?= htmlspecialchars($category['slug']) ?>">
          </div>
        </form>
      </div>
    </div>
  </main>
</div>

</body>
</html>

<?php
require_once __DIR__ . '/../../models/functions/functions.php';

session_start();
if (empty($_SESSION['user'])) {
    header('Location: /admin/login?error=2');
    exit;
}
$user = $_SESSION['user'];

// Statistiques rapides
$articles = getArticles(5, 0); // Récupère les 5 derniers articles
$categories = getCategories();
$users = getUsers();

// Extraction des initiales pour l'avatar
$words = explode(' ', $user['name']);
$initials = '';
foreach ($words as $w) {
    $initials .= strtoupper(substr($w, 0, 1));
}
$avatarInitials = substr($initials, 0, 2);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex, nofollow">
  <title>Tableau de bord — Backoffice Actu Info</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/articles.css">
  <style>
    /* STYLES SPECIFIQUES DU DASHBOARD */
    .dashboard-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
      gap: 1.5rem;
      margin-bottom: 2rem;
    }
    
    .stat-card {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      padding: 1.5rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    
    .stat-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    
    .stat-info .stat-title {
      font-size: 0.75rem;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      color: var(--text-muted);
      margin-bottom: 0.25rem;
    }
    
    .stat-info .stat-value {
      font-size: 1.8rem;
      font-weight: 700;
      color: var(--text);
      font-family: 'DM Sans', sans-serif;
    }
    
    .stat-icon {
      width: 48px;
      height: 48px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    .icon-articles { background: rgba(212, 175, 55, 0.1); color: var(--gold); }
    .icon-categories { background: rgba(59, 130, 246, 0.1); color: #3b82f6; }
    .icon-users { background: rgba(16, 185, 129, 0.1); color: var(--green); }
    
    .section-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1rem;
    }
    
    .section-header h2 {
      font-family: 'Playfair Display', serif;
      font-size: 1.4rem;
    }
    
    /* Tableau d'articles rapide */
    .recent-table-wrapper {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      overflow: hidden;
    }
    
    .recent-table {
      width: 100%;
      border-collapse: collapse;
      font-size: 0.84rem;
    }
    
    .recent-table th, .recent-table td {
      padding: 0.85rem 1rem;
      text-align: left;
      border-bottom: 1px solid var(--border);
    }
    
    .recent-table th {
      background: var(--bg);
      font-size: 0.72rem;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      color: var(--text-muted);
    }
    
    .recent-table tr:last-child td { border-bottom: none; }
    
    .recent-table tr:hover td { background: var(--surface-2); }
    
    .recent-table a {
      color: var(--text);
      font-weight: 500;
      text-decoration: none;
    }
    
    .recent-table a:hover { color: var(--gold); }
    
    .badge {
      display: inline-block;
      padding: 0.2rem 0.5rem;
      border-radius: 3px;
      font-size: 0.65rem;
      font-weight: 600;
      text-transform: uppercase;
    }
    .badge-published { background: var(--green-dim); color: var(--green); }
    .badge-draft { background: var(--yellow-dim); color: var(--yellow); }
  </style>
</head>
<body>

<div class="layout">

  <aside class="sidebar">
    <div class="sidebar-logo">
      <div class="logo-badge">▸ Backoffice CMS</div>
      <h2>Actu <span>Info</span></h2>
    </div>
    <div class="sidebar-user">
      <div class="user-avatar"><?= $avatarInitials ?></div>
      <div class="user-info">
        <div class="user-name"><?= htmlspecialchars($user['name']) ?></div>
        <div class="user-role"><?= htmlspecialchars(ucfirst($user['role'])) ?></div>
      </div>
    </div>
    <nav class="nav">
      <div class="nav-section">Navigation</div>
      <a href="/admin/dashboard" class="active">
        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
          <rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/>
          <rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>
        </svg>
        Tableau de bord
      </a>
      <div class="nav-section">Contenu</div>
      <a href="/admin/articles">
        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6M16 13H8M16 17H8M10 9H8"/>
        </svg>
        Articles
      </a>
      <a href="/admin/categories">
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
        <span class="current">Tableau de bord</span>
      </nav>
      <div class="topbar-actions">
        <a href="/admin/articles/create" class="btn btn-primary">
          <svg style="width:14px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line>
          </svg>
          Nouvel article
        </a>
      </div>
    </header>

    <div class="content">
      <div class="page-header">
        <div>
          <h1>Bienvenue, <?= htmlspecialchars($user['name']) ?> !</h1>
          <p>Voici un aperçu rapide de l'activité de votre site.</p>
        </div>
      </div>

      <div class="dashboard-grid">
        
        <div class="stat-card">
          <div class="stat-info">
            <div class="stat-title">Articles</div>
            <div class="stat-value"><?= count($articles) ?></div>
          </div>
          <div class="stat-icon icon-articles">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
              <polyline points="14 2 14 8 20 8"></polyline>
              <line x1="16" y1="13" x2="8" y2="13"></line>
              <line x1="16" y1="17" x2="8" y2="17"></line>
              <polyline points="10 9 9 9 8 9"></polyline>
            </svg>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-info">
            <div class="stat-title">Catégories</div>
            <div class="stat-value"><?= count($categories) ?></div>
          </div>
          <div class="stat-icon icon-categories">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path>
            </svg>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-info">
            <div class="stat-title">Utilisateurs</div>
            <div class="stat-value"><?= count($users) ?></div>
          </div>
          <div class="stat-icon icon-users">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
              <circle cx="9" cy="7" r="4"></circle>
              <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
              <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            </svg>
          </div>
        </div>
      </div>

      <div class="dashboard-section">
        <div class="section-header">
          <h2>Dernières publications</h2>
          <a href="/admin/articles" style="font-size: 0.8rem; color: var(--gold); text-decoration: none; font-weight: 500;">Voir tout →</a>
        </div>
        
        <div class="recent-table-wrapper">
          <table class="recent-table">
            <thead>
              <tr>
                <th>Titre</th>
                <th>Statut</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($articles as $article): ?>
                <tr>
                  <td>
                    <a href="/admin/articles/edit?id=<?= urlencode($article['id']) ?>">
                      <?= htmlspecialchars($article['title']) ?>
                    </a>
                  </td>
                  <td>
                    <span class="badge badge-<?= htmlspecialchars($article['status']) ?>">
                      <?= $article['status'] === 'published' ? 'Publié' : 'Brouillon' ?>
                    </span>
                  </td>
                  <td>
                    <a href="/admin/articles/edit?id=<?= urlencode($article['id']) ?>" style="font-size: 0.75rem; text-decoration: underline;">
                      Éditer
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </main>
</div>

</body>
</html>
<?php
require_once __DIR__ . '/../../models/functions/functions.php';

session_start();
if (empty($_SESSION['user'])) {
    header('Location: /admin/login?error=2');
    exit;
}
$user = $_SESSION['user'];
$error = $_GET['error'] ?? '';

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
  <title>Créer un utilisateur — Backoffice Actu Info</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/articles.min.css">
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
      <a href="/admin/users" class="active">
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
        <a href="/admin/users">Utilisateurs</a>
        <span class="sep">/</span>
        <span class="current">Créer</span>
      </nav>
      <div class="topbar-actions">
        <a href="/admin/users" class="btn btn-secondary">Annuler</a>
        <button type="submit" form="create-user-form" class="btn btn-primary">
          <svg style="width:14px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line>
          </svg>
          Créer
        </button>
      </div>
    </header>

    <div class="content">
      <div class="page-header">
        <div>
          <h1>Créer un utilisateur</h1>
          <p>Remplissez les informations ci-dessous pour ajouter un membre.</p>
        </div>
      </div>

      <?php if ($error): ?>
        <div class="alert-error">⚠️ Erreur : <?= htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <form id="create-user-form" action="/admin/users/create-form" method="POST">
        <div class="form-grid">
          
          <div>
            <div class="form-section">
              <h3>Informations du compte</h3>

              <div class="field">
                <label for="name">Nom complet *</label>
                <input type="text" id="name" name="name" required placeholder="Ex: Jean Dupont">
              </div>

              <div class="field">
                <label for="email">Adresse e-mail *</label>
                <input type="email" id="email" name="email" required placeholder="email@exemple.com">
              </div>

              <div class="field">
                <label for="password">Mot de passe *</label>
                <div style="position:relative;">
                  <input type="password" id="password" name="password" required placeholder="••••••••" style="padding-right:2.2rem;">
                  <button type="button" id="togglePassword" aria-label="Afficher/Masquer le mot de passe" style="position:absolute;top:50%;right:0.5rem;transform:translateY(-50%);background:none;border:none;cursor:pointer;padding:0;">
                    <svg id="eyeIcon" style="width:20px;height:20px;color:#888;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z"/><circle cx="12" cy="12" r="3"/></svg>
                  </button>
                </div>
                <div class="field-hint">Utilisez au moins 8 caractères avec des lettres et des chiffres.</div>
              </div>
            </div>
          </div>

          <div>
            <div class="form-section">
              <h3>Rôle & Droits</h3>
              
              <div class="field">
                <label for="role">Rôle assigné *</label>
                <select id="role" name="role" required>
                  <option value="admin">Administrateur</option>
                  <option value="editor">Éditeur</option>
                  <option value="author" selected>Auteur</option>
                </select>
              </div>
              
              <div class="field-hint">
                <strong>Admin</strong> : Accès total.<br>
                <strong>Éditeur</strong> : Gère le contenu de tout le monde.<br>
                <strong>Auteur</strong> : Gère uniquement ses propres articles.
              </div>
            </div>
          </div>

        </div>
      </form>

    </div>
  </main>
</div>

<script src="/assets/js/user-create.min.js"></script>

</body>
</html>
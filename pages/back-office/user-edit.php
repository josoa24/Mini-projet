<?php
require_once __DIR__ . '/../../models/functions/functions.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$user = getUserById($id);
if (!$user) {
    header('Location: /admin/users');
    exit;
}
$error = $_GET['error'] ?? '';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex, nofollow">
  <title>Éditer utilisateur — Backoffice Actu Info</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/articles.css">
  <style>
    /* Styles spécifiques pour l'édition utilisateur */
    .form-grid { display: grid; grid-template-columns: 2fr 1.1fr; gap: 1.5rem; }
    .form-section { margin-bottom: 1.5rem; }
    .field { margin-bottom: 1rem; }
    .field label { display: block; font-size: .8rem; margin-bottom: .35rem; color: var(--text-soft); }
    .field input[type="text"], .field input[type="email"], .field input[type="password"], .field select { 
      width: 100%; background: var(--bg); border: 1px solid var(--border); border-radius: var(--radius); 
      padding: .55rem .75rem; color: var(--text); font-family: 'DM Sans', sans-serif; font-size: .84rem; outline: none; 
    }
    .field-hint { font-size: .72rem; color: var(--text-muted); margin-top: .25rem; }
    .alert-error { background: rgba(239, 68, 68, 0.1); color: #ef4444; padding: 0.75rem; border-radius: var(--radius); border: 1px solid rgba(239, 68, 68, 0.2); margin-bottom: 1.5rem; font-size: 0.84rem; }
    .role-badge { display: inline-block; padding: 0.2rem 0.5rem; border-radius: 3px; font-size: 0.7rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; }
    .role-admin { background: var(--green-dim); color: var(--green); }
    .role-editor { background: var(--yellow-dim); color: var(--yellow); }
    .role-author { background: var(--surface-2); color: var(--text-soft); }
    
    @media(max-width: 980px) { .form-grid { grid-template-columns: 1fr; } }
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
        <span class="current">Éditer</span>
      </nav>
      <div class="topbar-actions">
        <a href="/admin/users" class="btn btn-secondary">Annuler</a>
        <button type="submit" form="user-form" class="btn btn-primary">
          <svg style="width:14px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/>
          </svg>
          Enregistrer
        </button>
      </div>
    </header>

    <div class="content">
      <div class="page-header">
        <div>
          <h1>Éditer utilisateur</h1>
          <p>Modifiez les informations du compte ci-dessous.</p>
        </div>
      </div>

      <?php if ($error): ?>
        <div class="alert-error">⚠️ Erreur : <?= htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <form id="user-form" action="/admin/users/edit-form" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">
        
        <div class="form-grid">
          <div>
            <div class="form-section">
              <h3>Informations du profil</h3>

              <div class="field">
                <label for="name">Nom complet *</label>
                <input type="text" id="name" name="name" required value="<?= htmlspecialchars($user['name']) ?>" placeholder="Ex: Jean Dupont">
              </div>

              <div class="field">
                <label for="email">Adresse e-mail *</label>
                <input type="email" id="email" name="email" required value="<?= htmlspecialchars($user['email']) ?>" placeholder="email@exemple.com">
              </div>
            </div>

            <div class="form-section">
              <h3>Sécurité</h3>
              <div class="field">
                <label for="password">Nouveau mot de passe</label>
                <div style="position:relative;">
                  <input type="password" id="password" name="password" placeholder="••••••••" style="padding-right:2.2rem;">
                  <button type="button" id="togglePassword" aria-label="Afficher/Masquer le mot de passe" style="position:absolute;top:50%;right:0.5rem;transform:translateY(-50%);background:none;border:none;cursor:pointer;padding:0;">
                    <svg id="eyeIcon" style="width:20px;height:20px;color:#888;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z"/><circle cx="12" cy="12" r="3"/></svg>
                  </button>
                </div>
                <div class="field-hint">Laissez ce champ vide pour ne pas modifier le mot de passe actuel.</div>
              </div>
            </div>
          </div>

          <div>
            <div class="form-section">
              <h3>Rôle & Autorisations</h3>
              
              <div class="field">
                <label for="role">Attribuer un rôle *</label>
                <select id="role" name="role" required>
                  <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Administrateur</option>
                  <option value="editor" <?= $user['role'] === 'editor' ? 'selected' : '' ?>>Éditeur</option>
                  <option value="author" <?= $user['role'] === 'author' ? 'selected' : '' ?>>Auteur</option>
                </select>
              </div>

              <div style="margin-top: 1rem; font-size: 0.8rem; color: var(--text-soft);">
                Statut actuel : 
                <span class="role-badge role-<?= htmlspecialchars($user['role']) ?>">
                  <?= htmlspecialchars($user['role']) ?>
                </span>
              </div>
            </div>
          </div>
        </div>
      </form>

    </div>
  </main>
</div>

<script>
  const passwordInput = document.getElementById('password');
  const togglePassword = document.getElementById('togglePassword');
  const eyeIcon = document.getElementById('eyeIcon');
  let passwordVisible = false;
  togglePassword.addEventListener('click', function() {
    passwordVisible = !passwordVisible;
    passwordInput.type = passwordVisible ? 'text' : 'password';
    eyeIcon.innerHTML = passwordVisible
      ? '<circle cx="12" cy="12" r="3"/><path d="M17.94 17.94A10.94 10.94 0 0 1 12 19c-7 0-11-7-11-7a21.77 21.77 0 0 1 5.06-6.06M1 1l22 22"/>'
      : '<path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z"/><circle cx="12" cy="12" r="3"/>';
  });
</script>

</body>
</html>
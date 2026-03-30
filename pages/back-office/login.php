<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Connexion au backoffice — Système de gestion des contenus">
  <meta name="robots" content="noindex, nofollow">
  <title>Connexion — Backoffice Iran War Info</title>
  <link rel="stylesheet" href="/assets/css/login.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
</head>
<body>
  <div class="login-wrapper">
    <div class="brand">
      <div class="brand-badge">Backoffice CMS</div>
      <h1>Iran War <span>Info</span></h1>
      <p>Système de gestion des contenus</p>
    </div>
    <div class="card">
      <h2 class="card-title">Connexion</h2>
      <?php
      $error = $_GET['error'] ?? null;
      if ($error === '1') {
          echo '<div class="alert alert-error">✕ &nbsp;Identifiants incorrects. Veuillez réessayer.</div>';
      }
      if ($error === '2') {
          echo '<div class="alert alert-error">✕ &nbsp;Session expirée. Veuillez vous reconnecter.</div>';
      }
      ?>
      <div class="alert alert-success" style="display:none;">
        ✓ &nbsp;Déconnexion réussie.
      </div>
      <form action="authentify" method="POST">
        <div class="field">
          <label for="email">Adresse e-mail</label>
          <input type="email" id="email" name="email" placeholder="admin@iranwar.info" required autocomplete="email">
        </div>
        <div class="field">
          <label for="password">Mot de passe</label>
          <input type="password" id="password" name="password" placeholder="••••••••" required autocomplete="current-password">
        </div>
        <button type="submit" class="btn-primary">Se connecter</button>
      </form>
      <div class="hint">
        Identifiants par défaut : <strong>admin@iranwar.info</strong> / <strong>admin123</strong>
      </div>
    </div>
    <p class="footer-note">Iran War Info &copy; 2026 — Accès restreint</p>
  </div>
</body>
</html>

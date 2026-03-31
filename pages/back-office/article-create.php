<?php
require_once __DIR__ . '/../../models/functions/functions.php';

$categories = getCategories();
$error = $_GET['error'] ?? '';
$title = $_POST['title'] ?? '';
$content = $_POST['content'] ?? '';
$status = $_POST['status'] ?? 'draft';
$categoryId = $_POST['category_id'] ?? '';
$metaDescription = $_POST['meta_description'] ?? '';
$altText = $_POST['alt_text'] ?? '';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex, nofollow">
  <title>Nouvel article — Backoffice Iran War Info</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/articles.css">
  <style>
    .char-count{font-size:.7rem;color:var(--text-muted);text-align:right;margin-top:.3rem}
    .slug-preview{font-size:.72rem;color:var(--text-muted);margin-top:.35rem;font-family:'Courier New',monospace}
    .slug-preview span{color:var(--gold)}
    .status-toggle{display:flex;border:1px solid var(--border);border-radius:var(--radius);overflow:hidden}
    .status-toggle label{flex:1;text-align:center;padding:.65rem 0;cursor:pointer;font-size:.78rem;font-weight:500;letter-spacing:.06em;text-transform:uppercase;transition:all .15s;color:var(--text-muted);background:var(--bg);margin:0}
    .status-toggle input[type="radio"]{display:none}
    .status-toggle input[value="draft"]:checked+label{background:var(--yellow-dim);color:var(--yellow)}
    .status-toggle input[value="published"]:checked+label{background:var(--green-dim);color:var(--green)}
    .image-preview{width:100%;height:160px;object-fit:cover;border-radius:var(--radius);border:1px solid var(--border);display:none;margin-bottom:.75rem}
    .image-preview.visible{display:block}
    .meta-info{background:var(--bg);border:1px solid var(--border);border-radius:var(--radius);padding:1rem;font-size:.78rem}
    .meta-row{display:flex;justify-content:space-between;padding:.4rem 0;border-bottom:1px solid var(--border);color:var(--text-muted)}
    .meta-row:last-child{border-bottom:none}
    .meta-row span:last-child{color:var(--text-soft)}
    .toolbar{display:flex;gap:4px;padding:.6rem;background:var(--bg);border:1px solid var(--border);border-bottom:none;border-radius:var(--radius) var(--radius) 0 0;flex-wrap:wrap}
    .toolbar-btn{width:30px;height:30px;display:flex;align-items:center;justify-content:center;background:transparent;border:1px solid transparent;border-radius:3px;color:var(--text-soft);cursor:pointer;font-size:.78rem;font-weight:600;transition:all .15s}
    .toolbar-btn:hover{background:var(--surface-2);border-color:var(--border);color:var(--text)}
    .toolbar-sep{width:1px;background:var(--border);margin:4px 2px}
    .field textarea.with-toolbar{border-radius:0 0 var(--radius) var(--radius);border-top:none}
    .form-grid{display:grid;grid-template-columns:2fr 1.1fr;gap:1.5rem}
    .form-section{margin-bottom:1.5rem}
    .field{margin-bottom:1rem}
    .field label{display:block;font-size:.8rem;margin-bottom:.35rem;color:var(--text-soft)}
    .field input[type="text"],.field input[type="file"],.field select,.field textarea{width:100%;background:var(--bg);border:1px solid var(--border);border-radius:var(--radius);padding:.55rem .75rem;color:var(--text);font-family:'DM Sans',sans-serif;font-size:.84rem;outline:none}
    .field textarea{min-height:180px;resize:vertical}
    .upload-zone{border:1px dashed var(--border);border-radius:var(--radius);padding:1rem;text-align:center;color:var(--text-muted);cursor:pointer}
    .field-hint{font-size:.72rem;color:var(--text-muted);margin-top:.25rem}
    
    /* Styles pour les images multiples cumulables */
    .extra-img-container {
        position: relative;
        width: 80px;
        height: 80px;
    }
    .extra-img-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 6px;
        border: 1px solid var(--border);
    }
    .extra-img-container .delete-btn {
        position: absolute;
        top: -5px;
        right: -5px;
        background: #ff4d4d;
        color: white;
        border: none;
        border-radius: 50%;
        width: 18px;
        height: 18px;
        font-size: 11px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }

    @media(max-width:980px){.form-grid{grid-template-columns:1fr}}
  </style>
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
      <a href="/admin/dashboard">
        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
          <rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/>
          <rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>
        </svg>
        Tableau de bord
      </a>
      <div class="nav-section">Contenu</div>
      <a href="/admin/articles" class="active">
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
        <a href="/admin/dashboard">Tableau de bord</a>
        <span class="sep">/</span>
        <a href="/admin/articles">Articles</a>
        <span class="sep">/</span>
        <span class="current">Nouvel article</span>
      </nav>
      <div class="topbar-actions">
        <a href="/admin/articles" class="btn btn-secondary">Annuler</a>
        <button type="submit" form="article-form" class="btn btn-primary">
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
          <h1>Nouvel article</h1>
          <p>Remplissez les informations ci-dessous puis enregistrez.</p>
        </div>
      </div>

      <?php if ($error === 'slug'): ?>
        <div class="alert alert-error">Le titre ou le slug existe déjà. Veuillez en choisir un autre.</div>
      <?php endif; ?>

      <form id="article-form" action="/admin/articles/create-form" method="POST" enctype="multipart/form-data">
        <div class="form-grid">
          <div>
            <div class="form-section">
              <h3>Contenu principal</h3>

              <div class="field">
                <label for="title">Titre de l'article *</label>
                <input type="text" id="title" name="title" required maxlength="255" oninput="updateSlug(this.value);updateCharCount('title',255)" placeholder="Ex : Frappes aériennes sur Téhéran..." value="<?= htmlspecialchars($title) ?>">
                <div class="slug-preview">URL : /article/<span id="slug-preview">slug-de-larticle</span></div>
                <div class="char-count"><span id="title-count"><?= strlen($title) ?></span>/255</div>
              </div>

              <div class="field">
                <label for="content">Contenu *</label>
                <div class="toolbar">
                  <button type="button" class="toolbar-btn" title="Gras" onclick="wrapSelection('b')"><b>B</b></button>
                  <button type="button" class="toolbar-btn" title="Italique" onclick="wrapSelection('i')"><i>I</i></button>
                  <button type="button" class="toolbar-btn" title="Souligné" onclick="wrapSelection('u')"><u>U</u></button>
                  <div class="toolbar-sep"></div>
                  <button type="button" class="toolbar-btn" title="H1" style="font-size:0.65rem;" onclick="wrapSelection('h1')">H1</button>
                  <button type="button" class="toolbar-btn" title="H2" style="font-size:0.65rem;" onclick="wrapSelection('h2')">H2</button>
                  <button type="button" class="toolbar-btn" title="H3" style="font-size:0.65rem;" onclick="wrapSelection('h3')">H3</button>
                </div>
                <textarea class="with-toolbar" id="content" name="content" required placeholder="Rédigez votre article ici..."><?= htmlspecialchars($content) ?></textarea>
              </div>
            </div>
          </div>

          <div>
            <div class="form-section">
              <h3>Publication</h3>
              <div class="field">
                <label>Statut</label>
                <div class="status-toggle">
                  <input type="radio" name="status" id="status-draft" value="draft" <?= $status === 'draft' ? 'checked' : '' ?>>
                  <label for="status-draft">◌ Brouillon</label>
                  <input type="radio" name="status" id="status-published" value="published" <?= $status === 'published' ? 'checked' : '' ?>>
                  <label for="status-published">● Publier</label>
                </div>
              </div>

              <div class="field">
                <label for="category_id">Catégorie *</label>
                <select id="category_id" name="category_id" required>
                  <option value="">— Sélectionner —</option>
                  <?php foreach ($categories as $cat): ?>
                    <option value="<?= htmlspecialchars($cat['id']) ?>" <?= $categoryId == $cat['id'] ? 'selected' : '' ?>><?= htmlspecialchars($cat['title']) ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>

            <div class="form-section">
              <h3>Image à la une</h3>
              <img id="image-preview" class="image-preview" src="" alt="Aperçu de l'image à la une">
              <div class="upload-zone" onclick="document.getElementById('image').click()">
                <svg width="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="color:var(--text-muted); margin-bottom:0.5rem;">
                  <rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/>
                  <polyline points="21 15 16 10 5 21"/>
                </svg>
                <p>Cliquez pour choisir l'image principale</p>
              </div>
              <input type="file" id="image" name="image" accept="image/*" style="display:none;" onchange="previewImage(this)">

              <div class="field" style="margin-top:1rem; margin-bottom:0;">
                <label for="alt_text">Texte alternatif (alt)</label>
                <input type="text" id="alt_text" name="alt_text" placeholder="Description de l'image principale" value="<?= htmlspecialchars($altText) ?>">
              </div>
            </div>

            <div class="form-section">
              <h3>Images supplémentaires</h3>
              <div class="upload-zone" onclick="document.getElementById('extra_images').click()">
                <svg width="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="color:var(--text-muted); margin-bottom:0.5rem;">
                  <rect x="3" y="3" width="18" height="18" rx="2"/><path d="M12 8v8M8 12h8"/>
                </svg>
                <p>Ajouter des images supplémentaires</p>
              </div>
              <input type="file" id="extra_images" accept="image/*" multiple style="display:none;">
              
              <div class="field-hint">Vous pouvez en ajouter autant que vous voulez. Cliquez sur la croix pour retirer.</div>
              
              <div id="extra-images-preview" style="display:flex;flex-wrap:wrap;gap:10px;margin-top:15px;"></div>
            </div>

            <div class="form-section">
              <h3>SEO / Référencement</h3>
              <div class="field">
                <label for="meta_description">Meta description</label>
                <textarea id="meta_description" name="meta_description" style="min-height:90px;" maxlength="160" oninput="updateCharCount('meta_description',160)" placeholder="Résumé affiché dans les résultats Google..."><?= htmlspecialchars($metaDescription) ?></textarea>
                <div class="char-count"><span id="meta_description-count"><?= strlen($metaDescription) ?></span>/160</div>
              </div>
            </div>
          </div>

        </div>
      </form>
    </div>
  </main>
</div>

<script>
  function updateSlug(title) {
    const slug = title.toLowerCase()
      .normalize('NFD').replace(/[\u0300-\u036f]/g,'')
      .replace(/[^a-z0-9\s-]/g,'')
      .replace(/\s+/g,'-')
      .replace(/-+/g,'-')
      .trim();
    document.getElementById('slug-preview').textContent = slug || 'slug-de-larticle';
  }

  function updateCharCount(id,max) {
    const el = document.getElementById(id);
    document.getElementById(id+'-count').textContent = el.value.length;
  }

  function previewImage(input) {
    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = e => {
        const img = document.getElementById('image-preview');
        img.src = e.target.result;
        img.classList.add('visible');
      };
      reader.readAsDataURL(input.files[0]);
    }
  }

  function wrapSelection(tag) {
    const textarea = document.getElementById('content');
    const start = textarea.selectionStart;
    const end = textarea.selectionEnd;
    const text = textarea.value;
    const before = text.substring(0, start);
    const selected = text.substring(start, end);
    const after = text.substring(end);

    let open = '', close = '';
    if (tag === 'b') { open = '<strong>'; close = '</strong>'; }
    if (tag === 'i') { open = '<em>'; close = '</em>'; }
    if (tag === 'u') { open = '<u>'; close = '</u>'; }
    if (tag === 'h1') { open = '<h1>'; close = '</h1>'; }
    if (tag === 'h2') { open = '<h2>'; close = '</h2>'; }
    if (tag === 'h3') { open = '<h3>'; close = '</h3>'; }

    const newText = before + open + selected + close + after;
    textarea.value = newText;
    textarea.focus();
    const cursorPos = start + open.length + selected.length + close.length;
    textarea.setSelectionRange(cursorPos, cursorPos);
  }

  // LOGIQUE POUR ACCUMULER LES IMAGES MULTIPLES
  let selectedFiles = []; // Notre tableau virtuel pour stocker toutes les images choisies

  document.getElementById('extra_images').addEventListener('change', function(e) {
    const files = Array.from(e.target.files);
    
    files.forEach(file => {
        selectedFiles.push(file); // On ajoute l'image au tableau global
    });

    renderPreviews();
    this.value = ''; // On vide l'input file pour permettre de re-sélectionner les mêmes fichiers si besoin
  });

  function renderPreviews() {
    const previewContainer = document.getElementById('extra-images-preview');
    previewContainer.innerHTML = ''; // On nettoie l'affichage pour le reconstruire

    selectedFiles.forEach((file, index) => {
        const reader = new FileReader();
        reader.onload = ev => {
            const container = document.createElement('div');
            container.className = 'extra-img-container';

            const img = document.createElement('img');
            img.src = ev.target.result;

            const deleteBtn = document.createElement('button');
            deleteBtn.className = 'delete-btn';
            deleteBtn.innerHTML = '×';
            deleteBtn.title = 'Supprimer cette image';
            
            // Événement pour retirer l'image du tableau virtuel
            deleteBtn.onclick = function() {
                selectedFiles.splice(index, 1);
                renderPreviews(); // On actualise l'affichage
            };

            container.appendChild(img);
            container.appendChild(deleteBtn);
            previewContainer.appendChild(container);
        };
        reader.readAsDataURL(file);
    });
  }

  // Intercepter l'envoi du formulaire pour y injecter nos images accumulées
  document.getElementById('article-form').addEventListener('submit', function(e) {
    e.preventDefault(); // On bloque l'envoi classique temporairement

    const formData = new FormData(this);

    // On ajoute toutes les images de notre tableau virtuel dans le FormData
    selectedFiles.forEach((file, index) => {
        formData.append('extra_images[]', file);
    });

    // On envoie le formulaire complet via Fetch (AJAX) ou en forçant la soumission
    fetch(this.action, {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (response.redirected) {
            window.location.href = response.url; // Redirection si le PHP redirige (par ex : vers la liste)
        } else {
            return response.text();
        }
    })
    .then(data => {
        if (data) {
            // Optionnel : Gérer ici les retours d'erreurs bruts ou rafraîchir la page
            document.open();
            document.write(data);
            document.close();
        }
    })
    .catch(error => console.error('Erreur lors de l\'envoi:', error));
  });
</script>

</body>
</html>
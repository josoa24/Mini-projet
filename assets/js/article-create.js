// Mise à jour du slug à partir du titre
function updateSlug(title) {
  const slug = title.toLowerCase()
    .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
    .replace(/[^a-z0-9\s-]/g, '')
    .replace(/\s+/g, '-')
    .replace(/-+/g, '-')
    .trim();
  document.getElementById('slug-preview').textContent = slug || 'slug-de-larticle';
}

// Mise à jour du compteur de caractères
function updateCharCount(id, max) {
  const el = document.getElementById(id);
  document.getElementById(id + '-count').textContent = el.value.length;
}

// Aperçu de l'image principale
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

// Envelopper le texte sélectionné avec des balises HTML
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

document.addEventListener('DOMContentLoaded', function() {
  const extraImagesInput = document.getElementById('extra_images');
  
  if (extraImagesInput) {
    extraImagesInput.addEventListener('change', function(e) {
      const files = Array.from(e.target.files);
      
      files.forEach(file => {
        selectedFiles.push(file); // On ajoute l'image au tableau global
      });

      renderPreviews();
      this.value = ''; // On vide l'input file pour permettre de re-sélectionner les mêmes fichiers si besoin
    });
  }

  const form = document.getElementById('article-form');
  if (form) {
    form.addEventListener('submit', function(e) {
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
  }
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

// user-create.js - version non minifiée
document.addEventListener('DOMContentLoaded', function() {
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
});

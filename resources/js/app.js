import './bootstrap';

// resources/js/app.js
import '../css/app.css'

// Fungsi toggle dark mode
const setupDarkMode = () => {
  const darkModeToggle = document.getElementById('darkModeToggle')
  
  if (darkModeToggle) {
    darkModeToggle.addEventListener('click', () => {
      document.documentElement.classList.toggle('dark')
      localStorage.setItem('darkMode', document.documentElement.classList.contains('dark'))
    })
  }

  // Set initial mode from localStorage
  if (localStorage.getItem('darkMode') === 'true') {
    document.documentElement.classList.add('dark')
  } else if (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches) {
    // Fallback to system preference if no localStorage setting
    document.documentElement.classList.add('dark')
  }
}

document.addEventListener('DOMContentLoaded', setupDarkMode)
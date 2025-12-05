// Aplicar tema salvo na Local Storage (Estando no script estava recompilando a memória)
(function() {
    const savedTheme = localStorage.getItem('theme');
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    
    let theme = 'light'; // padrão
    
    if (savedTheme) {
        theme = savedTheme;
    } else if (prefersDark) {
        theme = 'dark';
    }
    
    // Aplica o tema IMEDIATAMENTE
    document.documentElement.setAttribute('data-theme', theme);
})();

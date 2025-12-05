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

    // Reinicializa listeners dos botões se já foram carregados (fallback)
    function initializeButtons() {
        const themeToggleButton = document.getElementById('theme-toggle');
        const htmlElement = document.documentElement;
        const cssToggleBtn = document.getElementById('css-toggle');

        if (themeToggleButton && !themeToggleButton.__initialized) {
            themeToggleButton.__initialized = true;

            const updateThemeButtonIcon = (theme) => {
                if (theme === 'dark') {
                    themeToggleButton.textContent = '☀️ Modo Claro';
                } else {
                    themeToggleButton.textContent = '🌙 Modo Noturno';
                }
            };

            const applyTheme = (theme) => {
                htmlElement.setAttribute('data-theme', theme);
                localStorage.setItem('theme', theme);
                updateThemeButtonIcon(theme);
            };

            const toggleTheme = () => {
                const currentTheme = htmlElement.getAttribute('data-theme');
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                applyTheme(newTheme);
            };

            themeToggleButton.addEventListener('click', toggleTheme);

            const savedTheme = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

            if (savedTheme) {
                applyTheme(savedTheme);
            } else if (prefersDark) {
                applyTheme('dark');
            } else {
                updateThemeButtonIcon('light');
            }
        }

        if (cssToggleBtn && !cssToggleBtn.__initialized) {
            cssToggleBtn.__initialized = true;

            const toggleCSS = () => {
                const styleLinks = document.querySelectorAll('link[rel="stylesheet"]');
                const isCSSDisabled = localStorage.getItem('css-disabled') === 'true';
                
                styleLinks.forEach(link => {
                    if (isCSSDisabled) {
                        link.disabled = false;
                    } else {
                        link.disabled = true;
                    }
                });
                
                localStorage.setItem('css-disabled', !isCSSDisabled);
                
                if (isCSSDisabled) {
                    cssToggleBtn.textContent = '🔧 Modo Desenvolvedor (CSS)';
                    cssToggleBtn.style.background = 'linear-gradient(45deg, #ef4444, #f97316)';
                } else {
                    cssToggleBtn.textContent = '✅ CSS Desligado';
                    cssToggleBtn.style.background = 'linear-gradient(45deg, #22c55e, #16a34a)';
                }
            };
            
            cssToggleBtn.addEventListener('click', toggleCSS);
            
            const isCSSDisabled = localStorage.getItem('css-disabled') === 'true';
            if (isCSSDisabled) {
                const styleLinks = document.querySelectorAll('link[rel="stylesheet"]');
                styleLinks.forEach(link => {
                    link.disabled = true;
                });
                cssToggleBtn.textContent = '✅ CSS Desligado';
                cssToggleBtn.style.background = 'linear-gradient(45deg, #22c55e, #16a34a)';
            }
        }
    }

    // Tenta inicializar imediatamente se o DOM estiver pronto
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initializeButtons);
    } else {
        initializeButtons();
    }

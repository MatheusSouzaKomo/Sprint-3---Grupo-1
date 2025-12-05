document.addEventListener('DOMContentLoaded', () => {

    // --- LÓGICA DO BOTÃO "VOLTAR AO TOPO" ---
    const backToTopBtn = document.getElementById('backToTopBtn');

    // Verifica se o botão existe na página
    if (backToTopBtn) {
        // Define o container de rolagem. Nas páginas de setor, é o <main>, senão é a janela.
        const scrollContainer = document.querySelector('.page-setor main') || window;
        const scrollElement = document.querySelector('.page-setor main') || document.documentElement;

        // Função para mostrar ou ocultar o botão
        const toggleBackToTopButton = () => {
            // Usa scrollTop para o <main> ou scrollY para a janela
            const scrollPosition = scrollContainer.scrollTop || window.scrollY;

            if (scrollPosition > 300) { // Mostra o botão após rolar 300px
                backToTopBtn.classList.add('show');
            } else {
                backToTopBtn.classList.remove('show');
            }
        };

        // Função para rolar suavemente para o topo
        const scrollToTop = () => {
            scrollElement.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        };

        // Adiciona os ouvintes de evento
        scrollContainer.addEventListener('scroll', toggleBackToTopButton);
        backToTopBtn.addEventListener('click', scrollToTop);
    }

    // --- OUTRAS LÓGICAS JAVASCRIPT PODEM SER ADICIONADAS AQUI ---

    // Lógica do relógio

    function atualizarHorario() {
    const agora = new Date();

    const dia = String(agora.getDate()).padStart(2, '0');
    const mes = String(agora.getMonth() + 1).padStart(2, '0');
    const ano = agora.getFullYear();

    const horas = String(agora.getHours()).padStart(2, '0');
    const minutos = String(agora.getMinutes()).padStart(2, '0');
    const segundos = String(agora.getSeconds()).padStart(2, '0');

    // Fuso horário de Brasília (utc-3)
    const fuso = -agora.getTimezoneOffset() / 60;
    const fusoString = `GMT${fuso >= 0 ? '+' : ''}${fuso}`;

    document.getElementById('relogio').textContent =
    `${dia}/${mes}/${ano} ${horas}:${minutos}:${segundos} (${fusoString})`;
}

setInterval(atualizarHorario, 1000);
atualizarHorario(); //Chama o código para que não haja atraso

    // Lógica do tema claro/escuro
    const themeToggleButton = document.getElementById('theme-toggle');
    const htmlElement = document.documentElement;

    if (themeToggleButton) {
        // Função para atualizar o texto/ícone do botão
        const updateThemeButtonIcon = (theme) => {
            if (theme === 'dark') {
                themeToggleButton.textContent = '☀️ Modo Claro';
            } else {
                themeToggleButton.textContent = '🌙 Modo Noturno';
            }
        };

        // Função para aplicar o tema
        const applyTheme = (theme) => {
            htmlElement.setAttribute('data-theme', theme);
            localStorage.setItem('theme', theme);
            updateThemeButtonIcon(theme); // Atualiza o ícone do botão
        };

        // Função para alternar o tema
        const toggleTheme = () => {
            const currentTheme = htmlElement.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            applyTheme(newTheme);
        };

        // Adiciona o evento de clique ao botão
        themeToggleButton.addEventListener('click', toggleTheme);

        // Lógica para definir o tema inicial
        const savedTheme = localStorage.getItem('theme');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

        if (savedTheme) {
            // Se houver um tema salvo, usa ele
            applyTheme(savedTheme);
        } else if (prefersDark) {
            // Senão, se o sistema operacional preferir o modo escuro, usa ele
            applyTheme('dark');
        } else {
            // Se nada, usa o claro e atualiza o ícone
            updateThemeButtonIcon('light');
        }
    }
    
    // Lógica do botão de modo desenvolvedor (desliga/liga CSS)
    const cssToggleBtn = document.getElementById('css-toggle');
    
    if (cssToggleBtn) {
        // Função para aplicar/remover CSS
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
            
            // Salva o estado
            localStorage.setItem('css-disabled', !isCSSDisabled);
            
            // Muda o texto do botão
            if (isCSSDisabled) {
                cssToggleBtn.textContent = '🔧 Modo Desenvolvedor (CSS)';
                cssToggleBtn.style.background = 'linear-gradient(45deg, #ef4444, #f97316)';
            } else {
                cssToggleBtn.textContent = '✅ CSS Desligado';
                cssToggleBtn.style.background = 'linear-gradient(45deg, #22c55e, #16a34a)';
            }
        };
        
        // Evento de clique
        cssToggleBtn.addEventListener('click', toggleCSS);
        
        // Verifica se CSS estava desligado na última sessão
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
});
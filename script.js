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

    // --- LÓGICA DO MODO ESCURO (THEME TOGGLE) ---
    const themeToggleButton = document.getElementById('theme-toggle');
    const htmlElement = document.documentElement;

    if (themeToggleButton) {
        // Função para aplicar o tema
        const applyTheme = (theme) => {
            htmlElement.setAttribute('data-theme', theme);
            localStorage.setItem('theme', theme);
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
        }
        // Se nenhuma das condições acima for atendida, o tema claro (padrão do CSS) será usado.
    }
});
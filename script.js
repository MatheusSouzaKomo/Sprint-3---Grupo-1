document.addEventListener('DOMContentLoaded', () => {

    // --- LÓGICA DO RELÓGIO ---
    const relEl = document.getElementById('relogio');
    if (relEl) {
        function atualizarRelogio() {
            const agora = new Date();

            const dia = String(agora.getDate()).padStart(2, "0");
            const mes = String(agora.getMonth() + 1).padStart(2, "0");
            const ano = agora.getFullYear();

            const horas = String(agora.getHours()).padStart(2, "0");
            const minutos = String(agora.getMinutes()).padStart(2, "0");
            const segundos = String(agora.getSeconds()).padStart(2, "0");

            // Fuso horário (ex.: GMT-3)
            const fusoBruto = -agora.getTimezoneOffset() / 60;
            const fusoString = `GMT${fusoBruto >= 0 ? "+" : ""}${fusoBruto}`;

            relEl.textContent =
                `${dia}/${mes}/${ano} — ${horas}:${minutos}:${segundos} (${fusoString})`;
        }

        // Força o relógio ficar visível
        try {
            relEl.style.setProperty('color', '#ffffff', 'important');
            relEl.style.setProperty('background', 'transparent', 'important');
        } catch (e) {
            relEl.style.color = '#ffffff';
            relEl.style.background = 'transparent';
        }

        setInterval(atualizarRelogio, 1000);
        atualizarRelogio();
    }

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

    // --- OUTRAS LÓGICAS JAVASCRIPT PODEM SER ADICIONADAS AQUI --
});
/**
 * main.js (corrigido)
 *
 * Lida com todas as interações de front-end do site, com foco
 * em menu hambúrguer robusto, acessível e confiável.
 */
(function () {
  'use strict';

  const onDOMLoaded = () => {
    initHamburgerMenu();
    initBackToTopButton();
    initDismissibleAlerts();
    initSkeletonLoader();
    initClock();
    initThemeToggle();
    initCssDevToggle();
  };

  /* ---------- HAMBURGER MENU ---------- */
  const initHamburgerMenu = () => {
    const hamburgerBtn = document.getElementById('hamburger-btn');
    const mobileNav = document.getElementById('mobile-nav');
    const overlay = document.getElementById('menu-overlay');

    if (!hamburgerBtn || !mobileNav || !overlay) return;

    // Sempre defina atributos ARIA iniciais corretos
    hamburgerBtn.setAttribute('aria-expanded', 'false');
    mobileNav.setAttribute('aria-hidden', 'true');
    overlay.setAttribute('aria-hidden', 'true');

    // Seletores de elementos focáveis dentro do menu
    const focusableSelector = 'a[href], button:not([disabled]), input, [tabindex]:not([tabindex="-1"])';
    let focusableElements = Array.from(mobileNav.querySelectorAll(focusableSelector)).filter(el => el.offsetParent !== null);
    let firstFocusable = focusableElements[0] || null;
    let lastFocusable = focusableElements[focusableElements.length - 1] || null;

    // Estado do menu
    const isOpen = () => mobileNav.classList.contains('is-active');

    // Abre menu
    const openMenu = () => {
      document.body.classList.add('u-body-no-scroll');
      hamburgerBtn.classList.add('is-active');
      mobileNav.classList.add('is-active');
      overlay.classList.add('is-active');

      hamburgerBtn.setAttribute('aria-expanded', 'true');
      mobileNav.setAttribute('aria-hidden', 'false');
      overlay.setAttribute('aria-hidden', 'false');

      // atualizar lista de focáveis (caso conteúdo mude dinamicamente)
      focusableElements = Array.from(mobileNav.querySelectorAll(focusableSelector)).filter(el => el.offsetParent !== null);
      firstFocusable = focusableElements[0] || mobileNav;
      lastFocusable = focusableElements[focusableElements.length - 1] || firstFocusable;

      // Move foco para primeiro elemento focável para acessibilidade
      window.setTimeout(() => {
        if (firstFocusable && typeof firstFocusable.focus === 'function') firstFocusable.focus();
      }, 0);

      // Escuta tab para trap de foco
      document.addEventListener('keydown', trapFocus);
    };

    // Fecha menu
    const closeMenu = () => {
      document.body.classList.remove('u-body-no-scroll');
      hamburgerBtn.classList.remove('is-active');
      mobileNav.classList.remove('is-active');
      overlay.classList.remove('is-active');

      hamburgerBtn.setAttribute('aria-expanded', 'false');
      mobileNav.setAttribute('aria-hidden', 'true');
      overlay.setAttribute('aria-hidden', 'true');

      // Remove trap
      document.removeEventListener('keydown', trapFocus);

      // Retorna foco ao botão
      window.setTimeout(() => {
        hamburgerBtn.focus();
      }, 0);
    };

    // Toggle principal
    const toggleMenu = (forceClose = false) => {
      if (forceClose) {
        if (isOpen()) closeMenu();
        return;
      }
      if (isOpen()) closeMenu(); else openMenu();
    };

    // Fecha se clicar fora do menu (clicar no overlay já é tratado, mas este é um fallback)
    const onDocumentClick = (e) => {
      if (!isOpen()) return;
      if (e.target === overlay) {
        // overlay click lida abaixo; manter
        return;
      }
      if (!mobileNav.contains(e.target) && e.target !== hamburgerBtn) {
        closeMenu();
      }
    };

    // Trap de foco simples (tab wrap)
    const trapFocus = (e) => {
      if (e.key !== 'Tab') return;
      // recalcula se necessário
      focusableElements = Array.from(mobileNav.querySelectorAll(focusableSelector)).filter(el => el.offsetParent !== null);
      firstFocusable = focusableElements[0] || mobileNav;
      lastFocusable = focusableElements[focusableElements.length - 1] || firstFocusable;

      if (e.shiftKey) { // shift + tab
        if (document.activeElement === firstFocusable) {
          e.preventDefault();
          lastFocusable.focus();
        }
      } else { // tab
        if (document.activeElement === lastFocusable) {
          e.preventDefault();
          firstFocusable.focus();
        }
      }
    };

    // Event listeners
    hamburgerBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      toggleMenu();
    });

    overlay.addEventListener('click', () => toggleMenu(true));

    // fechar ao clicar em qualquer link dentro do menu
    mobileNav.addEventListener('click', (e) => {
      const link = e.target.closest('a');
      if (link) {
        // se o link for âncora local, permitir navegação suave; fecha logo em seguida
        toggleMenu(true);
      }
    });

    // fechar com ESC
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && isOpen()) {
        toggleMenu(true);
      }
    });

    // fechar ao clicar fora (fallback)
    document.addEventListener('click', onDocumentClick);
  };

  /* ---------- BACK TO TOP ---------- */
  const initBackToTopButton = () => {
    const backToTopBtn = document.getElementById('backToTopBtn');
    if (!backToTopBtn) return;

    const onScroll = () => {
      backToTopBtn.classList.toggle('c-back-to-top--visible', window.scrollY > 300);
    };

    window.addEventListener('scroll', onScroll);
    onScroll();

    backToTopBtn.addEventListener('click', () => {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  };

  /* ---------- DISMISSIBLE ALERTS ---------- */
  const initDismissibleAlerts = () => {
    document.querySelectorAll('.c-alert').forEach(alert => {
      // não forçar focus se não for apropriado
      const closeButton = alert.querySelector('.c-alert__close-btn');
      if (closeButton) {
        closeButton.addEventListener('click', () => {
          alert.style.opacity = '0';
          alert.addEventListener('transitionend', () => alert.remove(), { once: true });
        });
      }
    });
  };

  /* ---------- SKELETON LOADER ---------- */
  const initSkeletonLoader = () => {
    const skeletonGrid = document.getElementById('skeleton-grid');
    const cardGrid = document.getElementById('card-grid');
    if (!skeletonGrid || !cardGrid) return;

    setTimeout(() => {
      skeletonGrid.style.display = 'none';
      cardGrid.style.display = 'grid';
    }, 1000);
  };

  /* ---------- RELOGIO ---------- */
  const initClock = () => {
    const clockElement = document.getElementById('relogio');
    if (!clockElement) return;

    const updateClock = () => {
      const now = new Date();
      clockElement.textContent = now.toLocaleTimeString('pt-BR');
    };

    updateClock();
    setInterval(updateClock, 1000);
  };

  /* ---------- THEME TOGGLE ---------- */
  const initThemeToggle = () => {
    const themeToggleBtn = document.getElementById('theme-toggle');
    if (!themeToggleBtn) return;

    const moonIcon = document.getElementById('theme-toggle-moon');
    const sunIcon = document.getElementById('theme-toggle-sun');
    const themeText = document.getElementById('theme-toggle-text');
    const htmlElement = document.documentElement;

    const applyTheme = (theme) => {
      htmlElement.setAttribute('data-theme', theme);
      const isDark = theme === 'dark';

      if (moonIcon) moonIcon.style.display = isDark ? 'none' : 'inline';
      if (sunIcon) sunIcon.style.display = isDark ? 'inline' : 'none';
      if (themeText) themeText.textContent = isDark ? 'Modo Claro' : 'Modo Escuro';

      themeToggleBtn.setAttribute('aria-pressed', String(isDark));
      localStorage.setItem('theme', theme);
    };

    const toggleTheme = () => {
      const currentTheme = htmlElement.getAttribute('data-theme') || 'light';
      const newTheme = currentTheme === 'light' ? 'dark' : 'light';
      applyTheme(newTheme);
    };

    themeToggleBtn.addEventListener('click', toggleTheme);

    const savedTheme = localStorage.getItem('theme');
    const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
    const initialTheme = savedTheme || (prefersDark ? 'dark' : 'light');
    applyTheme(initialTheme);
  };

  /* ---------- NO-CSS TOGGLE ---------- */
  const initCssDevToggle = () => {
    const cssToggleMenuBtn = document.getElementById('css-toggle-menu');
    if (!cssToggleMenuBtn) return;

    // Mantém estado simples (true = estilos desabilitados)
    let cssDisabled = false;

    const toggleStylesheets = () => {
      // Procurar todos os estilos vinculados ao site (evita desabilitar CSS de bibliotecas externas com querystring diferente)
      const sheets = Array.from(document.querySelectorAll('link[rel="stylesheet"]'));
      sheets.forEach(sheet => {
        // Permitir desabilitar apenas os estilos locais (nome contendo 'style' é heurística)
        const href = sheet.getAttribute('href') || '';
        const localHeuristic = /style|main|app|site|guru/i;
        if (localHeuristic.test(href)) {
          sheet.disabled = !sheet.disabled;
        }
      });
      cssDisabled = !cssDisabled;
      cssToggleMenuBtn.setAttribute('aria-pressed', String(cssDisabled));
      cssToggleMenuBtn.textContent = cssDisabled ? 'CSS Desabilitado' : '🚫 No CSS';
    };

    cssToggleMenuBtn.addEventListener('click', toggleStylesheets);
  };

  document.addEventListener('DOMContentLoaded', onDOMLoaded);
})();

/* ==========================================================================
    Script Principal da Aplicação
    Descrição: Gerencia funcionalidades principais do site.
    Autor: Guru's Company
    Versão: 1.7.5
     ========================================================================== */

(function () {
  'use strict';

  /* ==========================================================================
     1. PREVENÇÃO DE FOUC (Flash of Unstyled Content) & CONFIG INICIAL
     Deve rodar imediatamente, antes do DOM estar pronto.
     ========================================================================== */
  
  const initImmediateSettings = () => {
    // --- TEMA ---
    const html = document.documentElement;
    const savedTheme = localStorage.getItem('theme');
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    const initialTheme = savedTheme || (prefersDark ? 'dark' : 'light');
    
    html.setAttribute('data-theme', initialTheme);

    // --- CSS DEV TOGGLE (Estado salvo) ---
    const savedCssState = localStorage.getItem('css-disabled');
    if (savedCssState === 'true') {
      // Nota: O elemento link pode ainda não existir, então lidamos com isso no DOMLoaded também
      // mas definimos o estado local para referência futura.
      window.__CSS_DISABLED_INIT = true; 
    }
  };

  initImmediateSettings();

  /* ==========================================================================
     2. APP CORE (Executa quando o HTML estiver carregado)
     ========================================================================== */
  
  const onDOMLoaded = () => {
    // UI & Layout
    initThemeControl();
    initCssDevControl();
    initHamburgerMenu();
    initBackToTop();
    initClock();
    initSkeletonLoader();
    initDismissibleAlerts();
    initCardActions();

    // Formulários
    initFormValidation();
    initProfileEdit();
  };

  /* ==========================================================================
     3. FUNCIONALIDADES DE UI / LAYOUT
     ========================================================================== */

  /**
   * Gerencia a troca de tema (Dark/Light) e ícones
   */
  const initThemeControl = () => {
    const toggleBtn = document.getElementById('theme-toggle') || document.getElementById('btn-theme-toggle');
    if (!toggleBtn) return;

    const html = document.documentElement;
    const sunIcon = toggleBtn.querySelector('.icon-sun'); // Ajuste o seletor conforme seu HTML
    const moonIcon = toggleBtn.querySelector('.icon-moon');
    const textSpan = toggleBtn.querySelector('span'); // Texto do botão se houver

    const updateUI = (theme) => {
      const isDark = theme === 'dark';
      html.setAttribute('data-theme', theme);
      localStorage.setItem('theme', theme);

      // Atualiza botão (classes ou ícones)
      if (isDark) toggleBtn.classList.add('is-active');
      else toggleBtn.classList.remove('is-active');

      // Alternância visual de ícones (se existirem)
      if (sunIcon && moonIcon) {
        sunIcon.style.display = isDark ? 'inline-block' : 'none';
        moonIcon.style.display = isDark ? 'none' : 'inline-block';
      }
      
      // Atualiza texto (se existir)
      if (textSpan) {
        textSpan.textContent = isDark ? ' Modo Claro' : ' Modo Escuro';
      }
    };

    // Sincroniza estado inicial com os botões
    updateUI(html.getAttribute('data-theme'));

    toggleBtn.addEventListener('click', () => {
      const current = html.getAttribute('data-theme');
      const next = current === 'dark' ? 'light' : 'dark';
      updateUI(next);
    });
  };

  /**
   * Ferramenta de dev para desativar CSS
   */
  const initCssDevControl = () => {
    const btn = document.getElementById('btn-no-css') || document.getElementById('css-toggle');
    if (!btn) {
      // Se não houver botão, apenas aplica o estado salvo (se houver link de estilo carregado)
      if (window.__CSS_DISABLED_INIT) toggleLocalStyles(true);
      return;
    }

    let isDisabled = window.__CSS_DISABLED_INIT || false;

    // Aplica estado inicial se necessário
    if (isDisabled) toggleLocalStyles(true);

    btn.addEventListener('click', () => {
      isDisabled = !isDisabled;
      toggleLocalStyles(isDisabled);
      
      // Atualiza texto do botão se aplicável
      const title = btn.querySelector('.c-settings-item__title') || btn;
      if (title.childNodes.length > 0 && title.nodeType !== Node.TEXT_NODE) {
         // Se tiver estrutura interna, tenta atualizar só o texto
         title.textContent = isDisabled ? 'Ativar CSS' : 'Desativar CSS';
      }
    });
  };

  // Helper para desativar/ativar stylesheets locais
  const toggleLocalStyles = (disable) => {
    const sheets = Array.from(document.querySelectorAll('link[rel="stylesheet"]'));
    const localHeuristic = /style|main|app|site|guru/i;
    
    sheets.forEach(sheet => {
      const href = sheet.getAttribute('href') || '';
      if (localHeuristic.test(href)) {
        sheet.disabled = disable;
      }
    });
    localStorage.setItem('css-disabled', disable);
  };

  /**
   * Menu Hambúrguer Acessível com Focus Trap
   */
  const initHamburgerMenu = () => {
    const btn = document.getElementById('hamburger-btn');
    const nav = document.getElementById('mobile-nav');
    const overlay = document.getElementById('menu-overlay');
    if (!btn || !nav || !overlay) return;

    // Configuração A11y Inicial
    btn.setAttribute('aria-expanded', 'false');
    nav.setAttribute('aria-hidden', 'true');

    // Seletores focáveis
    const focusableSelector = 'a[href], button:not([disabled]), input, textarea, select, [tabindex]:not([tabindex="-1"])';
    
    const toggleMenu = (forceClose = false) => {
      const isActive = nav.classList.contains('is-active');
      const shouldOpen = forceClose ? false : !isActive;

      if (shouldOpen) {
        document.body.classList.add('u-body-no-scroll');
        btn.classList.add('is-active');
        nav.classList.add('is-active');
        overlay.classList.add('is-active');
        btn.setAttribute('aria-expanded', 'true');
        nav.setAttribute('aria-hidden', 'false');
        
        // Focus Trap: Mover foco para o primeiro item
        setTimeout(() => {
          const first = nav.querySelector(focusableSelector);
          if (first) first.focus();
        }, 50);
        document.addEventListener('keydown', trapFocus);
      } else {
        document.body.classList.remove('u-body-no-scroll');
        btn.classList.remove('is-active');
        nav.classList.remove('is-active');
        overlay.classList.remove('is-active');
        btn.setAttribute('aria-expanded', 'false');
        nav.setAttribute('aria-hidden', 'true');
        document.removeEventListener('keydown', trapFocus);
        btn.focus(); // Retorna foco ao botão
      }
    };

    const trapFocus = (e) => {
      if (e.key !== 'Tab') return;
      const focusables = Array.from(nav.querySelectorAll(focusableSelector));
      const first = focusables[0];
      const last = focusables[focusables.length - 1];

      if (e.shiftKey) { // Shift + Tab
        if (document.activeElement === first) {
          e.preventDefault();
          last.focus();
        }
      } else { // Tab
        if (document.activeElement === last) {
          e.preventDefault();
          first.focus();
        }
      }
    };

    // Listeners
    btn.addEventListener('click', (e) => { e.stopPropagation(); toggleMenu(); });
    overlay.addEventListener('click', () => toggleMenu(true));
    
    // Fechar ao clicar em links internos
    nav.addEventListener('click', (e) => {
      if (e.target.closest('a')) toggleMenu(true);
    });

    // Fechar com ESC
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && nav.classList.contains('is-active')) toggleMenu(true);
    });
  };

  /**
   * Botão Voltar ao Topo
   */
  const initBackToTop = () => {
    const btn = document.getElementById('backToTopBtn');
    if (!btn) return;

    window.addEventListener('scroll', () => {
      btn.classList.toggle('c-back-to-top--visible', window.scrollY > 300);
    });

    btn.addEventListener('click', () => {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  };

  /**
   * Relógio Digital
   */
  const initClock = () => {
    const clockEl = document.getElementById('relogio');
    if (!clockEl) return;

    const update = () => {
      const now = new Date();
      clockEl.textContent = now.toLocaleTimeString('pt-BR');
    };
    update();
    setInterval(update, 1000);
  };

  /**
   * Skeleton Loading Simulator
   */
  const initSkeletonLoader = () => {
    const skeleton = document.getElementById('skeleton-grid');
    const content = document.getElementById('card-grid');
    if (!skeleton || !content) return;

    // Simula delay de API
    setTimeout(() => {
      skeleton.style.display = 'none';
      content.style.display = 'grid';
    }, 1000);
  };

  /**
   * Alertas Dispensáveis
   */
  const initDismissibleAlerts = () => {
    document.querySelectorAll('.c-alert__close-btn').forEach(btn => {
      btn.addEventListener('click', (e) => {
        const alert = e.target.closest('.c-alert');
        if (alert) {
          alert.style.opacity = '0';
          setTimeout(() => alert.remove(), 300); // Aguarda transição CSS
        }
      });
    });
  };

  /**
   * Ações dos Cards (stop propagation)
   */
  const initCardActions = () => {
    document.querySelectorAll('.c-card__action-btn').forEach(btn => {
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();
        console.log('Ação do card acionada:', btn);
      });
    });
  };

  /* ==========================================================================
     4. VALIDAÇÃO DE FORMULÁRIOS & PERFIL
     ========================================================================== */

  // Helpers de Validação
  const Forms = {
    setError: (field, message) => {
      const wrapper = field.parentElement;
      wrapper.classList.add('c-form-field--error');
      let msgEl = wrapper.querySelector('.c-form-field__error-message');
      if (!msgEl) {
        msgEl = document.createElement('p');
        msgEl.className = 'c-form-field__error-message';
        wrapper.appendChild(msgEl);
      }
      msgEl.textContent = message;
    },
    clearError: (field) => {
      const wrapper = field.parentElement;
      wrapper.classList.remove('c-form-field--error');
      const msgEl = wrapper.querySelector('.c-form-field__error-message');
      if (msgEl) msgEl.remove();
    },
    validators: {
      required: (field, name) => {
        if (!field.value.trim()) {
          Forms.setError(field, `O campo ${name} é obrigatório.`);
          return false;
        }
        Forms.clearError(field);
        return true;
      },
      email: (field) => {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!field.value.trim()) {
          Forms.setError(field, 'Email obrigatório.');
          return false;
        }
        if (!regex.test(field.value)) {
          Forms.setError(field, 'Insira um email válido.');
          return false;
        }
        Forms.clearError(field);
        return true;
      },
      password: (field, minLen = 6) => {
        if (!field.value.trim()) {
          Forms.setError(field, 'Senha obrigatória.');
          return false;
        }
        if (field.value.length < minLen) {
          Forms.setError(field, `Mínimo de ${minLen} caracteres.`);
          return false;
        }
        Forms.clearError(field);
        return true;
      },
      match: (field, matchValue, msg) => {
        if (field.value !== matchValue) {
          Forms.setError(field, msg || 'Os campos não coincidem.');
          return false;
        }
        Forms.clearError(field);
        return true;
      }
    }
  };

  const initFormValidation = () => {
    // --- LOGIN ---
    const loginForm = document.getElementById('login-form');
    if (loginForm) {
      const email = loginForm.querySelector('#email');
      const pass = loginForm.querySelector('#senha');

      loginForm.addEventListener('submit', (e) => {
        const v1 = Forms.validators.email(email);
        const v2 = Forms.validators.required(pass, 'senha');
        if (!v1 || !v2) e.preventDefault();
      });
      
      // Validação em tempo real (UX)
      email.addEventListener('blur', () => Forms.validators.email(email));
    }

    // --- CADASTRO ---
    const registerForm = document.getElementById('cadastro-form');
    if (registerForm) {
      const name = registerForm.querySelector('#nome');
      const email = registerForm.querySelector('#email');
      const pass = registerForm.querySelector('#senha');

      registerForm.addEventListener('submit', (e) => {
        const v1 = Forms.validators.required(name, 'nome');
        const v2 = Forms.validators.email(email);
        const v3 = Forms.validators.password(pass);
        if (!v1 || !v2 || !v3) e.preventDefault();
      });

      // Listeners
      [name, email, pass].forEach(f => {
        f.addEventListener('blur', () => {
           if(f === name) Forms.validators.required(f, 'nome');
           if(f === email) Forms.validators.email(f);
           if(f === pass) Forms.validators.password(f);
        });
      });
    }
  };

  const initProfileEdit = () => {
    const form = document.getElementById('profile-edit-form');
    if (!form) return;

    const btnEdit = document.getElementById('edit-profile-btn');
    const btnCancel = document.getElementById('cancel-edit-btn');
    const btnContainer = document.getElementById('edit-mode-buttons');

    const fields = {
      nome: form.querySelector('#nome'),
      email: form.querySelector('#email'),
      nivel: form.querySelector('#nivel_acesso'),
      passCurrent: form.querySelector('#senha_atual'),
      passNew: form.querySelector('#nova_senha'),
      passConfirm: form.querySelector('#confirmar_senha')
    };

    // Toggle de UI
    const toggleEdit = (isEditing) => {
      fields.nome.readOnly = !isEditing;
      fields.email.readOnly = !isEditing;
      // Nivel geralmente não edita
      
      // Campos de senha
      [fields.passCurrent, fields.passNew, fields.passConfirm].forEach(el => {
        el.parentElement.style.display = isEditing ? 'block' : 'none';
        if (!isEditing) {
          el.value = ''; // Limpa ao cancelar
          Forms.clearError(el);
        }
      });

      btnEdit.style.display = isEditing ? 'none' : 'block';
      btnContainer.style.display = isEditing ? 'flex' : 'none';
    };

    // Inicializa
    toggleEdit(false);

    btnEdit.addEventListener('click', () => toggleEdit(true));
    btnCancel.addEventListener('click', () => toggleEdit(false));

    // Submit do Perfil
    form.addEventListener('submit', (e) => {
      let isValid = true;
      isValid &= Forms.validators.required(fields.nome, 'nome');
      isValid &= Forms.validators.email(fields.email);

      // Valida senha apenas se tentou alterar
      const tryingToChangePass = fields.passNew.value.trim() !== '' || fields.passConfirm.value.trim() !== '';
      
      if (tryingToChangePass) {
        isValid &= Forms.validators.required(fields.passCurrent, 'senha atual');
        isValid &= Forms.validators.password(fields.passNew);
        isValid &= Forms.validators.match(fields.passConfirm, fields.passNew.value, 'Confirmação incorreta.');
      }

      if (!isValid) e.preventDefault();
    });
  };

  // Inicializa tudo quando o DOM estiver pronto
  document.addEventListener('DOMContentLoaded', onDOMLoaded);

})();
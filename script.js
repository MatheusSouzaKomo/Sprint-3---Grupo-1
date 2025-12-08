// Função para aplicar o tema e atualizar os ícones
const applyTheme = (theme) => {
    const htmlElement = document.documentElement;
    const themeToggleButton = document.getElementById('theme-toggle');
    const isDark = theme === 'dark';

    htmlElement.setAttribute('data-theme', theme);
    localStorage.setItem('theme', theme);

    // Atualiza o texto e os ícones do botão de tema
    if (themeToggleButton) {
        const sunIcon = themeToggleButton.querySelector('#theme-toggle-sun');
        const moonIcon = themeToggleButton.querySelector('#theme-toggle-moon');
        if (sunIcon && moonIcon) {
            sunIcon.style.display = isDark ? 'inline-block' : 'none';
            moonIcon.style.display = isDark ? 'none' : 'inline-block';
            // Remove o texto antigo e adiciona o novo
            themeToggleButton.lastChild.textContent = isDark ? ' Modo Claro' : ' Modo Escuro';
        }
    }
};

// Função para aplicar o estado do CSS
const applyCssState = (isDisabled) => {
    const mainStylesheet = document.querySelector('link[href*="style.css"]');
    if (mainStylesheet) {
        mainStylesheet.disabled = isDisabled;
        localStorage.setItem('css-disabled', isDisabled ? 'true' : 'false');
    }
};

// --- CONFIGURAÇÃO INICIAL IMEDIATA ---
// Aplica o tema salvo ou preferencial para evitar FOUC (Flash of Unstyled Content)
const savedTheme = localStorage.getItem('theme');
const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
applyTheme(savedTheme || (prefersDark ? 'dark' : 'light'));

// Aplica o estado do CSS salvo
const savedCssState = localStorage.getItem('css-disabled');
applyCssState(savedCssState === 'true');


// --- EVENT LISTENERS (APÓS O DOM CARREGAR) ---
document.addEventListener('DOMContentLoaded', () => {
    // Lógica do Relógio Digital
    const relogioEl = document.getElementById('relogio');
    if (relogioEl) {
        const atualizarHorario = () => {
            const agora = new Date();
            const options = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };
            relogioEl.textContent = agora.toLocaleTimeString('pt-BR', options);
        };
        setInterval(atualizarHorario, 1000);
        atualizarHorario(); // Chama imediatamente para não haver atraso
    }

    // Lógica do Menu Hambúrguer
    const hamburgerBtn = document.getElementById('hamburger-btn');
    const mobileNav = document.getElementById('mobile-nav');
    const menuOverlay = document.getElementById('menu-overlay');
    
    if (hamburgerBtn && mobileNav && menuOverlay) {
        const toggleMenu = () => {
            const isActive = mobileNav.classList.contains('is-active');
            
            // Adiciona ou remove as classes de todos os elementos relevantes
            hamburgerBtn.classList.toggle('is-active', !isActive);
            mobileNav.classList.toggle('is-active', !isActive);
            menuOverlay.classList.toggle('is-active', !isActive);
            
            // Atualiza o atributo ARIA para acessibilidade
            hamburgerBtn.setAttribute('aria-expanded', !isActive);
            
            // Trava o scroll do body quando o menu está aberto
            document.body.style.overflow = !isActive ? 'hidden' : '';
        };

        // Eventos para abrir/fechar o menu
        hamburgerBtn.addEventListener('click', toggleMenu);
        menuOverlay.addEventListener('click', toggleMenu); // Fecha ao clicar no overlay

        // Fecha o menu ao pressionar a tecla 'Escape'
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && mobileNav.classList.contains('is-active')) {
                toggleMenu();
            }
        });
    }

    // Lógica do botão de alternar tema
    const themeToggleButton = document.getElementById('theme-toggle');
    if (themeToggleButton) {
        themeToggleButton.addEventListener('click', () => {
            const currentTheme = document.documentElement.getAttribute('data-theme');
            applyTheme(currentTheme === 'dark' ? 'light' : 'dark');
        });
    }

    // Lógica do botão de alternar CSS
    const cssToggleButton = document.getElementById('css-toggle');
    if (cssToggleButton) {
        cssToggleButton.addEventListener('click', () => {
            const mainStylesheet = document.querySelector('link[href*="style.css"]');
            if (mainStylesheet) {
                applyCssState(!mainStylesheet.disabled);
            }
        });
    }

    // Lógica do botão "Voltar ao Topo"
    const backToTopBtn = document.getElementById('backToTopBtn');
    if (backToTopBtn) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 200) {
                backToTopBtn.classList.add('c-back-to-top--visible');
            } else {
                backToTopBtn.classList.remove('c-back-to-top--visible');
            }
        });
        backToTopBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // Lógica para o Loading Skeleton
    const skeletonGrid = document.getElementById('skeleton-grid');
    const cardGrid = document.getElementById('card-grid');

    if (skeletonGrid && cardGrid) {
        // Simula um tempo de carregamento (ex: 1 segundo).
        // Em uma aplicação real, isso seria substituído por uma chamada de API (fetch).
        setTimeout(() => {
            skeletonGrid.style.display = 'none';
            cardGrid.style.display = 'grid';
        }, 1000); // 1 segundo de delay
    }

    // Lógica para fechar alertas
    document.querySelectorAll('.c-alert__close-btn').forEach(button => {
        button.addEventListener('click', (e) => {
            const alert = e.target.closest('.c-alert');
            if (alert) {
                alert.style.display = 'none';
            }
        });
    });

    // Impede que o clique nos botões de ação do card navegue na página
    document.querySelectorAll('.c-card__action-btn').forEach(button => {
        button.addEventListener('click', (e) => {
            // Impede a ação padrão do link pai (navegar)
            e.preventDefault();
            // Impede que o evento se propague para elementos pais
            e.stopPropagation();
            // Adicione aqui a ação que o botão deve fazer, ex: abrir um modal
            console.log('Botão de ação do card clicado!');
        });
    });

    // --- LÓGICA DE VALIDAÇÃO DE FORMULÁRIOS ---
    const loginForm = document.getElementById('login-form');
    const cadastroForm = document.getElementById('cadastro-form');

    const setFieldError = (field, message) => {
        const formField = field.parentElement;
        formField.classList.add('c-form-field--error');
        let errorMessage = formField.querySelector('.c-form-field__error-message');
        if (!errorMessage) {
            errorMessage = document.createElement('p');
            errorMessage.className = 'c-form-field__error-message';
            formField.appendChild(errorMessage);
        }
        errorMessage.textContent = message;
    };

    const clearFieldError = (field) => {
        const formField = field.parentElement;
        formField.classList.remove('c-form-field--error');
        const errorMessage = formField.querySelector('.c-form-field__error-message');
        if (errorMessage) {
            errorMessage.remove();
        }
    };

    const validateEmail = (field) => {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (field.value.trim() === '') {
            setFieldError(field, 'O campo de email é obrigatório.');
            return false;
        } else if (!emailRegex.test(field.value)) {
            setFieldError(field, 'Por favor, insira um email válido.');
            return false;
        }
        clearFieldError(field);
        return true;
    };

    const validateRequired = (field, fieldName) => {
        if (field.value.trim() === '') {
            setFieldError(field, `O campo ${fieldName} é obrigatório.`);
            return false;
        }
        clearFieldError(field);
        return true;
    };

    const validatePassword = (field) => {
        if (field.value.trim() === '') {
            setFieldError(field, 'O campo de senha é obrigatório.');
            return false;
        } else if (field.value.length < 6) {
            setFieldError(field, 'A senha deve ter no mínimo 6 caracteres.');
            return false;
        }
        clearFieldError(field);
        return true;
    };

    if (loginForm) {
        const emailField = loginForm.querySelector('#email');
        const senhaField = loginForm.querySelector('#senha');

        loginForm.addEventListener('submit', (e) => {
            const isEmailValid = validateEmail(emailField);
            const isSenhaValid = validateRequired(senhaField, 'senha');
            if (!isEmailValid || !isSenhaValid) {
                e.preventDefault();
            }
        });
    }

    if (cadastroForm) {
        const nomeField = cadastroForm.querySelector('#nome');
        const emailField = cadastroForm.querySelector('#email');
        const senhaField = cadastroForm.querySelector('#senha');

        const addValidationListener = (field, validationFn, ...args) => {
            field.addEventListener('blur', () => validationFn(field, ...args));
            field.addEventListener('input', () => validationFn(field, ...args));
        };

        addValidationListener(nomeField, validateRequired, 'nome');
        addValidationListener(emailField, validateEmail);
        addValidationListener(senhaField, validatePassword);

        cadastroForm.addEventListener('submit', (e) => {
            const isNomeValid = validateRequired(nomeField, 'nome');
            const isEmailValid = validateEmail(emailField);
            const isSenhaValid = validatePassword(senhaField);
            if (!isNomeValid || !isEmailValid || !isSenhaValid) {
                e.preventDefault();
            }
        });
    }

    // --- LÓGICA DE EDIÇÃO DE PERFIL (perfil.php) ---
    const profileEditForm = document.getElementById('profile-edit-form');
    if (profileEditForm) {
        const editProfileBtn = document.getElementById('edit-profile-btn');
        const cancelEditBtn = document.getElementById('cancel-edit-btn');
        const editModeButtons = document.getElementById('edit-mode-buttons');

        const nomeField = profileEditForm.querySelector('#nome');
        const emailField = profileEditForm.querySelector('#email');
        const nivelAcessoField = profileEditForm.querySelector('#nivel_acesso');
        const currentPasswordField = profileEditForm.querySelector('#senha_atual');
        const newPasswordField = profileEditForm.querySelector('#nova_senha');
        const confirmPasswordField = profileEditForm.querySelector('#confirmar_senha');

        const toggleEditMode = (isEditing) => {
            nomeField.readOnly = !isEditing;
            emailField.readOnly = !isEditing;
            // Nível de acesso não é editável pelo usuário
            nivelAcessoField.readOnly = true; 

            currentPasswordField.parentElement.style.display = isEditing ? 'block' : 'none';
            newPasswordField.parentElement.style.display = isEditing ? 'block' : 'none';
            confirmPasswordField.parentElement.style.display = isEditing ? 'block' : 'none';

            editProfileBtn.style.display = isEditing ? 'none' : 'block';
            editModeButtons.style.display = isEditing ? 'flex' : 'none';

            // Limpa campos de senha e erros ao sair do modo edição
            if (!isEditing) {
                currentPasswordField.value = '';
                newPasswordField.value = '';
                confirmPasswordField.value = '';
                clearFieldError(nomeField);
                clearFieldError(emailField);
                clearFieldError(currentPasswordField);
                clearFieldError(newPasswordField);
                clearFieldError(confirmPasswordField);
            }
        };

        // Inicializa em modo de visualização
        toggleEditMode(false);

        editProfileBtn.addEventListener('click', () => toggleEditMode(true));
        cancelEditBtn.addEventListener('click', () => toggleEditMode(false));

        // Adiciona listeners de validação para os campos editáveis
        const addValidationListener = (field, validationFn, ...args) => {
            field.addEventListener('blur', () => { if (!field.readOnly) validationFn(field, ...args); });
            field.addEventListener('input', () => { if (!field.readOnly) validationFn(field, ...args); });
        };

        addValidationListener(nomeField, validateRequired, 'nome');
        addValidationListener(emailField, validateEmail);
        addValidationListener(currentPasswordField, (field) => {
            if (newPasswordField.value.trim() !== '' || confirmPasswordField.value.trim() !== '') {
                return validateRequired(field, 'senha atual');
            }
            clearFieldError(field);
            return true;
        });
        addValidationListener(newPasswordField, (field) => {
            if (field.value.trim() !== '') {
                return validatePassword(field);
            }
            clearFieldError(field);
            return true;
        });
        addValidationListener(confirmPasswordField, (field) => {
            if (newPasswordField.value.trim() !== '') {
                if (field.value.trim() === '') {
                    setFieldError(field, 'Confirme a nova senha.');
                    return false;
                } else if (field.value !== newPasswordField.value) {
                    setFieldError(field, 'As senhas não coincidem.');
                    return false;
                }
            }
            clearFieldError(field);
            return true;
        });

        profileEditForm.addEventListener('submit', (e) => {
            const isNomeValid = validateRequired(nomeField, 'nome');
            const isEmailValid = validateEmail(emailField);
            let isPasswordSectionValid = true;

            // A validação de senha só é necessária se o usuário digitou em qualquer um dos campos de senha
            if (newPasswordField.value.trim() !== '' || confirmPasswordField.value.trim() !== '') {
                const isCurrentPasswordValid = validateRequired(currentPasswordField, 'senha atual');
                const isNewPasswordValid = validatePassword(newPasswordField);
                const isConfirmPasswordValid = confirmPasswordField.value === newPasswordField.value;
                if (!isConfirmPasswordValid) setFieldError(confirmPasswordField, 'As senhas não coincidem.');
                isPasswordSectionValid = isCurrentPasswordValid && isNewPasswordValid && isConfirmPasswordValid;
            }

            if (!isNomeValid || !isEmailValid || !isPasswordSectionValid) {
                e.preventDefault();
            }
        });
    }
});
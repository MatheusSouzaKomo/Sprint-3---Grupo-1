<footer class="sac-footer">
    <div class="container">
        <div class="sac-grid">
            
            <div class="sac-info flow">
                <h2>Fale Conosco</h2>
                <p>Tem alguma dúvida sobre os serviços de saúde, trânsito ou segurança? Envie sua mensagem e nossa equipe responderá em breve.</p>
                
                <ul class="sac-contacts">
                    <li><strong>Email:</strong> <a href="mailto:contato@exemplo.com" class="sac-links">contato@exemplo.com</a></li>
                    <li><strong>Tel:</strong> <a href="tel:08001234567" class="sac-links">0800 123 4567</a></li>
                </ul>
            </div>
            <div class="sac-buttons">
                <a href="avaliacao.php"><button class="sac-btn">Enviar Avaliação</button></a>
                <a href="reclamacao.php"><button class="sac-btn">Enviar Reclamação</button></a>
                <button id="theme-toggle" class="sac-btn">🌙 Modo Noturno</button>
             <?php 

             /* Verifica se o usuário está logado e se é um administrador para exibir o botão de modo desenvolvedor */
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                if (isset($_SESSION['nivel']) && $_SESSION['nivel'] === 'Administração'): 
                ?>
                    <button id="css-toggle" class="sac-btn" style="background: linear-gradient(45deg, #ef4444, #f97316); font-size: 0.85rem;">
                        🔧 Modo Desenvolvedor (CSS Desligado)
                    </button>
                <?php endif; ?>
            </div>

            <?php
            /* Botão Voltar flutuante: aparece em todas as páginas que incluam este footer,
               exceto nas páginas hub.php, login.php e cadastro.php */
            $current = basename($_SERVER['PHP_SELF']);
            $exclude = ['hub.php', 'login.php', 'cadastro.php'];
            if (!in_array($current, $exclude)):
            ?>
                <button onclick="history.back()" class="sac-btn voltar-btn">Voltar</button>
            <?php endif; ?>

        </div>
    </div>
</footer>
<?php
    // Detecta se está em um subdiretório e ajusta o caminho
    $basePath = (strpos($_SERVER['REQUEST_URI'], '/sectors/') !== false) ? '../' : '';
?>
<script src="<?php echo $basePath; ?>script.js"></script>
<script src="<?php echo $basePath; ?>theme.js"></script>
<script>
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
</script>
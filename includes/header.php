<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<header class="c-site-header" role="banner">
    <div class="o-container">
        <div id="relogio" aria-live="polite" aria-atomic="true"></div>

        <h1 class="c-site-header__title">
            <a href="/Sprint-3---Grupo-1/hub.php" class="c-site-header__title-link">Guru's City</a>
        </h1>

        <!-- Botão Hambúrguer -->
        <button
            type="button"
            class="c-hamburger-btn"
            id="hamburger-btn"
            aria-label="Abrir menu"
            aria-controls="mobile-nav"
            aria-expanded="false"
            title="Menu"
        >
            <span class="c-hamburger-btn__bar" aria-hidden="true"></span>
            <span class="c-hamburger-btn__bar" aria-hidden="true"></span>
            <span class="c-hamburger-btn__bar" aria-hidden="true"></span>
        </button>
    </div>
</header>

<!-- Overlay que escurece a página quando o menu está aberto -->
<div class="c-overlay c-overlay--hidden" id="menu-overlay" aria-hidden="true"></div>

<!-- Navegação Mobile (Menu Lateral) -->
<nav
    class="c-site-header__nav"
    id="mobile-nav"
    role="navigation"
    aria-label="Menu principal"
    aria-hidden="true"
    tabindex="-1"
>
    <div class="c-site-header__actions">
        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
            <div class="c-menu-profile" role="region" aria-label="Perfil do usuário">
                <div class="c-menu-profile__avatar" aria-hidden="true">
                    <?php echo strtoupper(substr($_SESSION['nome'], 0, 1)); ?>
                </div>
                <p class="c-menu-profile__greeting">Olá, <strong><?php echo htmlspecialchars($_SESSION['nome']); ?></strong></p>
                <p class="c-menu-profile__level">(<?php echo htmlspecialchars($_SESSION['nivel']); ?>)</p>
            </div>
            <a href="/Sprint-3---Grupo-1/hub.php" class="c-btn c-btn--primary u-w-full">Painel Principal</a>
            <?php if (isset($_SESSION['nivel']) && $_SESSION['nivel'] === 'Administração'): ?>
                <a href="/Sprint-3---Grupo-1/admin_users.php" class="c-btn u-w-full">Gerenciar Usuários</a>
            <?php endif; ?>
            <a href="/Sprint-3---Grupo-1/logout.php" class="c-btn c-btn--danger u-w-full">Sair</a>
        <?php else: ?>
            <a href="/Sprint-3---Grupo-1/login.php" class="c-btn c-btn--primary u-w-full">Entrar</a>
            <a href="/Sprint-3---Grupo-1/register.php" class="c-btn u-w-full">Cadastrar</a>
        <?php endif; ?>

        <hr class="c-menu-divider" role="separator">

        <div class="c-site-header__tools">
            <button id="theme-toggle" class="c-btn u-w-full" type="button" aria-pressed="false">
                <span id="theme-toggle-moon" aria-hidden="true">🌙</span>
                <span id="theme-toggle-text">Modo Escuro</span>
                <span id="theme-toggle-sun" style="display: none;" aria-hidden="true">☀️</span>
            </button>

            <button id="css-toggle-menu" class="c-btn u-w-full" type="button" aria-pressed="false">
                🚫 No CSS
            </button>
        </div>
    </div>
</nav>

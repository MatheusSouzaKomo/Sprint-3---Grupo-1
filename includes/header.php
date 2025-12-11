<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * 
 * @param array 
 */
function generate_breadcrumb($items) {
    echo '<nav aria-label="breadcrumb" class="c-breadcrumb">';
    echo '<ol class="c-breadcrumb__list">';
    
    $count = count($items);
    foreach ($items as $index => $item) {
        $isLast = ($index === $count - 1);
        echo '<li class="c-breadcrumb__item">';
        if ($isLast) {
            echo '<span aria-current="page">' . htmlspecialchars($item['name']) . '</span>';
        } else {
            echo '<a href="' . htmlspecialchars($item['url']) . '">' . htmlspecialchars($item['name']) . '</a>';
        }
        echo '</li>';
    }
    
    echo '</ol>';
    echo '</nav>';
}
?>
<header class="c-site-header" role="banner">
    <div class="o-container">
        <div id="relogio" aria-live="polite" aria-atomic="true"></div>

        <h1 class="c-site-header__title">
            <a href="../main/hub.php" class="c-site-header__title-link">Guru's City</a>
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

<div class="c-overlay c-overlay--hidden" id="menu-overlay" aria-hidden="true"></div>

<nav class="c-site-header__nav" id="mobile-nav" role="navigation" aria-label="Menu principal" aria-hidden="true" tabindex="-1">
    <div class="c-site-header__actions">
        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
            <div class="c-menu-profile" role="region" aria-label="Perfil do usuário">
                <div class="c-menu-profile__avatar" aria-hidden="true">
                    <?php echo strtoupper(substr($_SESSION['nome'], 0, 1)); ?>
                </div>
                <p class="c-menu-profile__greeting">Olá, <strong><?php echo htmlspecialchars($_SESSION['nome']); ?></strong></p>
                <p class="c-menu-profile__level">(<?php echo htmlspecialchars($_SESSION['nivel']); ?>)</p>
            </div>
            <a href="/Sprint-3---Grupo-1/hub.php" class="c-btn c-btn--primary u-w-full">Painel de Serviços</a>
            <a href="../main/profile.php" class="c-btn c-btn--secondary u-w-full">Meu Perfil</a>
            <?php if (isset($_SESSION['nivel']) && $_SESSION['nivel'] === 'Administração'): ?>
                <a href="admin/admin_users.php" class="c-btn c-btn--secondary u-w-full">Painel de Admin</a>
            <?php endif; ?>
            <a href="../../actions/logout.php" class="c-btn c-btn--danger u-w-full">Sair</a>
        <?php else: ?>
            <a href="actions/login.php" class="c-btn c-btn--primary u-w-full">Entrar</a>
            <a href="actions/register.php" class="c-btn u-w-full">Cadastrar</a>
        <?php endif; ?>

        <hr class="c-menu-divider" role="separator">

        <div class="o-grid o-grid--settings">
            <button class="c-settings-item" id="btn-theme-toggle">
                <div class="c-settings-item__content">
                    <span class="c-settings-item__title">Modo Escuro</span>
                </div>
                <div class="c-settings-switch">
                    <div class="c-settings-switch__handle"></div>
                </div>
            </button>

            <button class="c-settings-item" id="btn-no-css">
                <div class="c-settings-item__content">
                    <span class="c-settings-item__title">Modo NoCSS</span>
                </div>
                <div class="c-settings-switch">
                    <div class="c-settings-switch__handle"></div>
                </div>
            </button>
        </div>
    </div>
</nav>
<script src="../main.js"></script>

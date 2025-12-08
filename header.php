<?php
// Garante que a sessão seja iniciada em todas as páginas que incluem este header.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<header class="c-site-header">
    <div class="o-container">
        <!-- O relógio será inserido aqui pelo JavaScript -->
        <div id="relogio"></div>

        <h1 class="c-site-header__title">
            <a href="/Sprint-3---Grupo-1/hub.php" style="color: inherit; text-decoration: none;">Guru's City</a>
        </h1>

        <!-- Botão Hambúrguer -->
        <button class="c-hamburger-btn" id="hamburger-btn" aria-label="Abrir menu" aria-controls="mobile-nav" aria-expanded="false">
            <span class="c-hamburger-btn__bar"></span>
            <span class="c-hamburger-btn__bar"></span>
            <span class="c-hamburger-btn__bar"></span>
        </button>
    </div>
</header>

<!-- Overlay que escurece a página quando o menu está aberto -->
<div class="c-overlay" id="menu-overlay"></div>

<!-- Navegação Mobile (Menu Lateral) -->
<nav class="c-site-header__nav" id="mobile-nav" aria-hidden="true">
    <div class="c-site-header__actions">
        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
            <!-- Seção do Perfil do Usuário Logado -->
            <div class="c-menu-profile">
                <div class="c-menu-profile__avatar">
                    <?php echo strtoupper(substr($_SESSION['nome'], 0, 1)); ?>
                </div>
                <p style="margin-top: var(--space-2); margin-bottom: 0; color: var(--color-neutral-700);">
                    Olá, <strong><?php echo htmlspecialchars($_SESSION['nome']); ?></strong>
                </p>
                <p style="font-size: var(--font-size-sm); color: var(--color-neutral-500); margin-bottom: var(--space-4);">
                    (<?php echo htmlspecialchars($_SESSION['nivel']); ?>)
                </p>
            </div>

            <!-- Links para usuários logados -->
            <a href="/Sprint-3---Grupo-1/hub.php" class="c-btn c-btn--primary u-w-full">Painel Principal</a>
            <?php if ($_SESSION['nivel'] === 'Administração'): ?>
                <a href="/Sprint-3---Grupo-1/admin_users.php" class="c-btn u-w-full">Gerenciar Usuários</a>
            <?php endif; ?>
            <a href="/Sprint-3---Grupo-1/logout.php" class="c-btn c-btn--danger u-w-full">Sair</a>

        <?php else: ?>
            <!-- Links para visitantes -->
            <a href="/Sprint-3---Grupo-1/login.php" class="c-btn c-btn--primary u-w-full">Entrar</a>
            <a href="/Sprint-3---Grupo-1/register.php" class="c-btn u-w-full">Cadastrar</a>
        <?php endif; ?>
    </div>
</nav>
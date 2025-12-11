
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/boilerplate.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <title>Painel Principal</title>
</head>
<body>
    <?php include '../../includes/header.php'; ?>

    <main id="main-content" class="o-container" style="padding-top: var(--space-12); padding-bottom: var(--space-12);">

        <?php if (isset($_GET['status']) && $_GET['status'] === 'loggedin'): ?>
            <div class="c-alert c-alert--success" role="alert" tabindex="-1">
                <p>Login efetuado com sucesso!</p>
                <button class="c-alert__close-btn" aria-label="Fechar">&times;</button>
            </div>
        <?php endif; ?>
        <?php if (isset($_GET['status']) && $_GET['status'] === 'complaint_success'): ?>
            <div class="c-alert c-alert--success" role="alert" tabindex="-1">
                <p>Reclamação enviada com sucesso!</p>
                <button class="c-alert__close-btn" aria-label="Fechar">&times;</button>
            </div>
        <?php endif; ?>

        <?php
        // MOSTRAR o botão somente se o usuário NÃO estiver logado
        if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true): ?>
            <div class="u-text-center" style="margin-bottom: var(--space-8);">
                <a href="login.php" class="c-btn c-btn--primary">Entrar</a>
            </div>
        <?php endif; ?>
        <h1 class="u-text-center" style="margin-bottom: var(--space-2);">Painel Principal</h1>

        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
            <p class="u-text-center" style="font-size: var(--font-size-lg); color: var(--color-neutral-500); margin-top: var(--space-2); margin-bottom: var(--space-8);">
                Bem vindo: <strong><?php echo htmlspecialchars($_SESSION['nome']); ?></strong>
            </p>
        <?php endif; ?>

        <!-- Skeleton Loading Grid -->
        <div id="skeleton-grid" class="o-grid o-grid--3-cols">
            <?php for ($i = 0; $i < 6; $i++): ?>
                <div class="c-card c-card--skeleton">
                    <div class="c-card__content">
                        <div class="c-card__skeleton-line" style="height: 2rem; width: 60%; margin-bottom: 1rem;"></div>
                        <div class="c-card__skeleton-line" style="height: 1rem; width: 90%;"></div>
                        <div class="c-card__skeleton-line" style="height: 1rem; width: 80%; margin-top: 0.5rem;"></div>
                    </div>
                </div>
            <?php endfor; ?>
        </div>

        <div id="card-grid" class="o-grid o-grid--3-cols" style="display: none;">

            <a href="../sectors/setorSaude.php" class="c-card c-card--saude" style="--animation-delay: 0.1s;">
                <div class="c-card__content">
                    <h2 class="c-card__title">Saúde</h2>
                    <p>Explore informações e serviços relacionados à saúde.</p>
                </div>
                <footer class="c-card__footer">
                    <span class="c-card__action-btn">Ver Detalhes</span>
                </footer>
            </a>
            <a href="../sectors/setorSeguranca.php" class="c-card c-card--seguranca" style="--animation-delay: 0.2s;">
                <div class="c-card__content">
                    <h2 class="c-card__title">Segurança</h2>
                    <p>Descubra iniciativas e dados sobre segurança pública.</p>
                </div>
                <footer class="c-card__footer">
                    <span class="c-card__action-btn">Ver Detalhes</span>
                </footer>
            </a>
            <a href="../sectors/setorTransito.php" class="c-card c-card--transito" style="--animation-delay: 0.3s;">
                <div class="c-card__content">
                    <h2 class="c-card__title">Trânsito</h2>
                    <p>Informações sobre mobilidade urbana e trânsito.</p>
                </div>
                <footer class="c-card__footer">
                    <span class="c-card__action-btn">Ver Detalhes</span>
                </footer>
            </a>
            <a href="../sectors/setorEducacao.php" class="c-card c-card--educ" style="--animation-delay: 0.4s;">
                <div class="c-card__content">
                    <h2 class="c-card__title">Educação</h2>
                    <p>Acesse conteúdos e serviços educacionais.</p>
                </div>
                <footer class="c-card__footer">
                    <span class="c-card__action-btn">Ver Detalhes</span>
                </footer>
            </a>
            <a href="../sectors/setorLazer.php" class="c-card c-card--lazer" style="--animation-delay: 0.5s;">
                <div class="c-card__content">
                    <h2 class="c-card__title">Lazer</h2>
                    <p>Encontre opções de lazer e entretenimento.</p>
                </div>
                <footer class="c-card__footer">
                    <span class="c-card__action-btn">Ver Detalhes</span>
                </footer>
            </a>
            <a href="../sectors/setorEconomia.php" class="c-card c-card--economia" style="--animation-delay: 0.6s;">
                <div class="c-card__content">
                    <h2 class="c-card__title">Economia</h2>
                    <p>Saiba mais sobre economia e finanças.</p>
                </div>
                <footer class="c-card__footer">
                    <span class="c-card__action-btn">Ver Detalhes</span>
                </footer>
            </a>
        </div>
        <button id="backToTopBtn" class="c-back-to-top" aria-label="Voltar ao topo" title="Voltar ao topo">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="24" height="24" aria-hidden="true">
                <path d="M11.9999 10.8284L7.05019 15.7782L5.63598 14.364L11.9999 8L18.3639 14.364L16.9497 15.7782L11.9999 10.8284Z"></path>
            </svg>
        </button>

    </main>
    <?php include '../../includes/footer.php';?>
    <script src="../../assets/js/script.js"></script>
</body>
</html>

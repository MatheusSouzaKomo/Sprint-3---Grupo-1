<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="theme.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/boilerplate.css">
    <title>Painel Principal</title>
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <main>

        <?php
        // MOSTRAR o botão somente se o usuário NÃO estiver logado
        if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true): ?>
            <div class="login-button-container">
                <a href="login.php" class="login-btn">Entrar</a>
            </div>
        <?php endif; ?>
        <h1>Painel Principal</h1>

        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
            <p style="text-align: center; font-size: 1.2rem; color: var(--color-text-secondary); margin-bottom: 2rem;">
                Bem vindo: <strong><?php echo htmlspecialchars($_SESSION['nome']); ?></strong>
            </p>
        <?php endif; ?>

            <section class="container-card">
            <!-- Cards aqui (sem alterações) -->
            <div class="card card-saude" onclick="location.href='sectors/setorSaude.php';" style="cursor: pointer;">
                <div class="card-content">
                    <h2>Saúde</h2>
                    <p>Explore informações e serviços relacionados à saúde.</p>
                </div>
            </div>

            <div class="card card-seguranca" onclick="location.href='sectors/setorSeguranca.php';" style="cursor: pointer;">
                <div class="card-content">
                    <h2>Segurança</h2>
                    <p>Descubra iniciativas e dados sobre segurança pública.</p>
                </div>
            </div>

            <div class="card card-transito" onclick="location.href='sectors/setorTransito.php';" style="cursor: pointer;">
                <div class="card-content">
                    <h2>Trânsito</h2>
                    <p>Informações sobre mobilidade urbana e trânsito.</p>
                </div>
            </div>

            <div class="card card-educ" onclick="location.href='sectors/setorEducacao.php';" style="cursor: pointer;">
                <div class="card-content">
                    <h2>Educação</h2>
                    <p>Acesse conteúdos e serviços educacionais.</p>
                </div>
            </div>

            <div class="card card-lazer" onclick="location.href='sectors/setorLazer.php';" style="cursor: pointer;">
                <div class="card-content">
                    <h2>Lazer</h2>
                    <p>Encontre opções de lazer e entretenimento.</p>
                </div>
            </div>

            <div class="card card-economia" onclick="location.href='sectors/setorEconomia.php';" style="cursor: pointer;">
                <div class="card-content">
                    <h2>Economia</h2>
                    <p>Saiba mais sobre economia e finanças.</p>
                </div>
            </div>
        </section>

        <button id="backToTopBtn" class="back-to-top-btn" title="Voltar ao topo">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="24" height="24">
                <path d="M11.9999 10.8284L7.05019 15.7782L5.63598 14.364L11.9999 8L18.3639 14.364L16.9497 15.7782L11.9999 10.8284Z"></path>
            </svg>
        </button>

    </main>

    <?php include 'includes/footer.php'; ?>

    <script src="script.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="../assets/css/boilerplate.css">
    </head>
    <body class="o-page-container">
        <div class="c-login-box">
            <h2 class="c-login-box__title">Login</h2>

            <?php if (isset($_GET['status']) && $_GET['status'] === 'loggedout'): ?>
                <div class="c-alert c-alert--success">
                    <span>Você saiu com sucesso.</span>
                    <button class="c-alert__close-btn" aria-label="Fechar">&times;</button>
                </div>
            <?php endif; ?>

            <form action="auth_login.php" method="POST" id="login-form" class="c-login-box__form" novalidate>
                <div class="c-form-field">
                    <label for="email" class="c-form-field__label">Email:</label>
                    <input type="email" id="email" name="email" class="c-form-field__input" required>
                </div>
                <div class="c-form-field">
                    <label for="senha" class="c-form-field__label">Senha:</label>
                    <input type="password" id="senha" name="senha" class="c-form-field__input" required>
                </div>
                <button type="submit" class="c-btn c-btn--primary" style="width: 100%; margin-top: var(--space-4);">Entrar</button>
                <p class="c-login-box__signup-link">Não tem conta? <a href="register.php">Cadastre-se</a></p>
            </form> 
        </div>
        <script src="../assets/js/script.js"></script>
    </body>
</html>
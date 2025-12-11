<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/boilerplate.css">
   <link rel="stylesheet" href="../assets/css/style.css">
   <title>Página de Cadastro Guru's Services</title>
</head>
    <body class="o-page-container">
        <div class="c-login-box">
            <h2 class="c-login-box__title">Cadastro</h2>
            <form action="auth_register.php" method="POST" id="cadastro-form" class="c-login-box__form" novalidate>
                <div class="c-form-field">
                    <label for="nome" class="c-form-field__label">Nome:</label>
                    <input type="text" id="nome" name="nome" class="c-form-field__input" required>
               </div>
                <div class="c-form-field">
                    <label for="email" class="c-form-field__label">Email:</label>
                    <input type="email" id="email" name="email" class="c-form-field__input" required>
               </div>
                <div class="c-form-field">
                    <label for="senha" class="c-form-field__label">Senha:</label>
                    <input type="password" id="senha" name="senha" class="c-form-field__input" required>
               </div>
                <div class="c-form-field">
                    <label for="nivel_acesso" class="c-form-field__label">Nível de acesso (temporário):</label>
                    <select name="nivel_acesso" id="nivel_acesso" class="c-form-field__input" required>
                       <option value="Cidadão">Cidadão</option>
                       <option value="Associado">Associado</option>
                       <option value="Administração">Administração</option>
                   </select>
               </div>
                <button type="submit" class="c-btn c-btn--primary" style="width: 100%; margin-top: var(--space-4);">Cadastrar</button>
           </form>
       </div>
       <script src="../assets/js/script.js"></script>
   </body>
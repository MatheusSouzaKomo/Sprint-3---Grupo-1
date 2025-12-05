<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="theme.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>Cadastro</title>
</head>
    <body class="login-page">
        <div class="login-container">
            <h2>Cadastro</h2>
            <form action="processa_cadastro.php" method="POST">
                <div class="input-group">
                    <label>Nome:</label>
                    <input type="text" name="nome" required> 
                </div>
                <div class="input-group">
                    <label>Email:</label>
                    <input type="email" name="email" required>
                </div>
                <div class="input-group">
                    <label>Senha:</label>
                    <input type="password" name="senha" required>
                </div>
                <div class="select-group">
                    <label>Nível de acesso (temporário):</label>
                    <select name="nivel_acesso" required>
                        <option value="Cidadão">Cidadão</option>
                        <option value="Associado">Associado</option>
                        <option value="Administração">Administração</option>
                    </select>
                </div>
                <button type="submit" class="login-btn">Cadastrar</button>
            </form>
        </div>
    </body>
</html>
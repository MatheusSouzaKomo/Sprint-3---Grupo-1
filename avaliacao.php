<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Avaliação</title>
    <script src="theme.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="login-page">
    <div class="login-container">
        <form action="processa_avaliacao.php" method="POST" class="login-form">
            <h2>Deixe sua Avaliação</h2>
            <div class="input-group">
                <label for="msg_avaliacao">Mensagem de avaliação:</label>
                <input type="text" id="msg_avaliacao" name="msg_avaliacao" required>
            </div>
            <div class="select-group">
                <label for="setor_avaliacao">Setor:</label>
                <select id="setor_avaliacao" name="setor_avaliacao" required>
                    <option value="1">Saúde</option>
                    <option value="2">Educação</option>
                    <option value="3">Economia</option>
                    <option value="4">Lazer</option>
                    <option value="5">Segurança</option>
                    <option value="6">Trânsito</option>
                </select>
            </div>
            <div class="select-group">
                <label for="nota_avaliacao">Nota (1 a 5):</label>
                <select id="nota_avaliacao" name="nota_avaliacao" required>
                    <option value="1">1 - Péssimo</option>
                    <option value="2">2 - Ruim</option>
                    <option value="3">3 - Regular</option>
                    <option value="4">4 - Bom</option>
                    <option value="5">5 - Excelente</option>
                </select>
            </div>
            <button type="submit" class="login-btn">Enviar Avaliação</button><p></p><p></p>
               <button onclick="history.back()" class="sac-btn voltar-btn">Voltar</button>
        </form>
    </div>
</body>
</html>